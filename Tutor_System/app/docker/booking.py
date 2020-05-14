import json
import sys
import os
import pika

from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ


import requests

# create flask application
app = Flask(__name__)
CORS(app)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/booking'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

#create database for booking
# create flask application
app = Flask(__name__)
CORS(app)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/booking'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Booking(db.Model):
    __tablename__ = 'booking'

    booking_id = db.Column(db.String(13), primary_key=True)
    tutee_id = db.Column(db.String(64), nullable=False) 
    tutor_id = db.Column(db.String(64), nullable=False)
    payment = db.Column(db.String(64), nullable=False)
    status = db.Column(db.String(64), nullable=False)
    subject = db.Column(db.String(64), nullable=False)

    def __init__(self, booking_id, tutee_id, tutor_id, payment, status, subject):
        self.booking_id = booking_id
        self.tutee_id = tutee_id
        self.tutor_id = tutor_id
        self.payment = payment
        self.status = status
        self.subject = subject

    def json(self):
        return {"booking_id": self.booking_id, "tutee_id": self.tutee_id, "tutor_id": self.tutor_id, "payment": self.payment, "status": self.status, "subject": self.subject}

# set up for AMQP messaging
hostname = "localhost" # default host
port = 5672 # default port
# connect to the broker and set up a communication channel in the connection
connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
channel = connection.channel()

# set up the exchange if the exchange doesn't exist
exchangename="tutee_topic"
channel.exchange_declare(exchange=exchangename, exchange_type='topic')

def receiveRequest():
    print ("receiving requests...")
    # prepare a queue for receiving messages
    channelqueue = channel.queue_declare(queue='', exclusive = True) # '' indicates a random unique queue name; 'exclusive' indicates the queue is used only by this receiver and will be deleted if the receiver disconnects.
        # If no need durability of the messages, no need durable queues, and can use such temp random queues.
    queue_name = channelqueue.method.queue
    channel.queue_bind(exchange=exchangename, queue=queue_name, routing_key='#') # bind the queue to the exchange via the key
        # any routing_key would be matched

    # set up a consumer and start to wait for coming messages
    channel.basic_consume(queue=queue_name, on_message_callback=callback, auto_ack=True)
    channel.start_consuming() # an implicit loop waiting to receive messages; it doesn't exit by default. Use Ctrl+C in the command window to terminate it.

def callback(channel, method, properties, body): # required signature for the callback; no return
    print("Received a booking request by " + __file__)
    request = json.loads(body)
    print (request)

    booking_id = request["booking_id"]
    #JOSE
    if Booking.query.filter_by(booking_id=booking_id).first():
        if "status" in request:
            if request["status"] == "accept":
                accept_booking(request)
            elif request["status"] == "reject":
                reject_booking(request)
        else:
            print ("Request is already sent before. Status is pending now.")
    else:
        print (create_booking(request))
    print() # print a new line feed

def create_booking(request):
    # if (Booking.query.filter_by(booking_id=booking_id).first()):
    #     return jsonify({"message": "A booking with ID '{}' already exists.".format(booking_id)}), 400
    request["payment"] = "Pending"
    request["status"] = "Pending"
    booking = Booking(**request)

    try:
        db.session.add(booking)
        db.session.commit()
    except:
        # return jsonify({"message": "An error occurred creating the booking."}), 500
        return "An error occurred creating the booking."

    return "Request successfully created and added to Booking table"
    # return jsonify(booking.json()), 201
    # return ""

def accept_booking(booking_id):
    if not (Booking.query.filter_by(booking_id=booking_id).first()):
        return jsonify({"message": "A booking with ID '{}' is not found.".format(booking_id)}), 400  

    update = Booking.query.filter_by(booking_id=booking_id).first()

    try:
        update.status = 'Accepted'
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred updating the booking status."}), 500

    return jsonify({"message": "Your booking has been accepted."}), 201

def reject_booking(booking_id):
    if not (Booking.query.filter_by(booking_id=booking_id).first()):
        return jsonify({"message": "A booking with ID '{}' is not found.".format(booking_id)}), 400  

    update = Booking.query.filter_by(booking_id=booking_id).first()

    try:
        update.status = 'Rejected'
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred updating the booking status."}), 500

    return jsonify({"message": "Your booking has been rejected."}), 201

#used for HTTP invocations
@app.route("/booking")
def get_all():
    return jsonify({"Bookings": [booking.json() for booking in Booking.query.all()]})

@app.route("/booking/tutee/<string:tutee_id>")
def get_all_bookings_for_tutee(tutee_id):
    bookings = Booking.query.filter_by(tutee_id=tutee_id).all()
    if bookings:
        return jsonify({"Bookings": [booking.json() for booking in Booking.query.filter_by(tutee_id=tutee_id).all()]}), 200
    return jsonify({"message": "Tutor ID not found"}), 404

@app.route("/booking/tutor/<string:tutor_id>")
def get_all_bookings_for_tutor(tutor_id):
    bookings = Booking.query.filter_by(tutor_id=tutor_id).all()
    if bookings:
        return jsonify({"Bookings": [booking.json() for booking in Booking.query.filter_by(tutor_id=tutor_id).all()]}), 200
    return jsonify({"message": "Tutor ID not found"}), 404

@app.route("/booking/status/<string:status>/tutor/<tutor_id>")
def get_all_bookings_based_status(status, tutor_id):
    bookings = Booking.query.filter_by(status=status, tutor_id=tutor_id)
    if bookings:
        return jsonify({"Bookings": [status.json() for status in Booking.query.filter_by(status=status, tutor_id=tutor_id)]})
    return jsonify({"message": "Status not found"}), 404

@app.route("/booking/status/<string:status>/tutee/<tutee_id>")
def get_all_bookings_based_status_tutee(status, tutee_id):
    bookings = Booking.query.filter_by(status=status, tutee_id=tutee_id)
    if bookings:
        return jsonify({"Bookings": [status.json() for status in Booking.query.filter_by(status=status, tutee_id=tutee_id)]})
    return jsonify({"message": "Status not found"}), 404
    
@app.route("/booking/<string:booking_id>")
def find_by_booking_id(booking_id):
    booking_id = Booking.query.filter_by(booking_id=booking_id).first()
    if booking_id:
        return jsonify(booking_id.json()), 200
    return jsonify({"message": "Booking ID not found."}), 404


@app.route("/booking/delete/<string:booking_id>", methods=['DELETE'])
def delete_booking(booking_id):
    if not (Booking.query.filter_by(booking_id=booking_id).first()):
        return jsonify({"message": "A booking with ID '{}' does not exist.".format(booking_id)}), 400

    booking = Booking.query.filter_by(booking_id=booking_id).first()

    try:
        db.session.delete(booking)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred deleting the booking."}), 500

    return jsonify({"message": "Your booking has been successfully deleted"}), 201


if __name__ == '__main__':
    print("This is " + os.path.basename(__file__) + ": waiting for requests...")
    # app.run(port = 5002, debug = True)
    receiveRequest()