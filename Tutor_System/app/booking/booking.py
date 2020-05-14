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

#used for HTTP invocations
@app.route("/booking")
def get_all():
    return jsonify({"Bookings": [booking.json() for booking in Booking.query.all()]})

@app.route("/booking/tutee/<string:tutee_id>")
def get_all_bookings_for_tutee(tutee_id):
    # print('getting')
    # print(tutee_id)
    bookings = Booking.query.filter_by(tutee_id=tutee_id).all()
    # print(bookings)
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
    print('finding')
    booking = Booking.query.filter_by(booking_id=booking_id).first()
    print(booking)
    if booking:
        print (booking)
        return jsonify(booking.json()), 200
    return jsonify({"message": "Booking ID not found."}), 404
    # return jsonify({"message": "Booking ID not found."})


@app.route("/booking/create/<string:booking_id>", methods=['POST'])
def create_booking(booking_id):
    if Booking.query.filter_by(booking_id=booking_id).first():
        return jsonify({"message": "A booking with ID '{}' already exists.".format(booking_id)}), 400

    data = request.get_json()
    booking = Booking(**data)

    try:
        db.session.add(booking)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the booking."}), 500

    return jsonify({"message": "Your booking has been successfully created"}), 201

@app.route("/booking/accept/<string:booking_id>", methods=['POST'])
def accept_booking(booking_id):
    print("accepting...")
    if not (Booking.query.filter_by(booking_id=booking_id).first()):
        return jsonify({"message": "A booking with ID '{}' is not found.".format(booking_id)}), 400  

    update = Booking.query.filter_by(booking_id=booking_id).first()

    try:
        update.status = 'Accepted'
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred updating the booking status."}), 500

    return jsonify({"message": "Your booking has been accepted."}), 201


@app.route("/booking/updatepayment/<string:booking_id>", methods=['POST'])
def update_payment_status(booking_id):
    booking = Booking.query.filter_by(booking_id=booking_id).first()
    if booking:
        booking.status = 'success'
        db.session.commit()
        return jasonify({"message": "Payment status has been updated"}),201
    else:
        return jasonify({"message": "An error occurred updating payment status"}),500


@app.route("/booking/reject/<string:booking_id>", methods=['POST'])
def reject_booking(booking_id):
    print("rejecting...")
    if not (Booking.query.filter_by(booking_id=booking_id).first()):
        return jsonify({"message": "A booking with ID '{}' is not found.".format(booking_id)}), 400  

    update = Booking.query.filter_by(booking_id=booking_id).first()

    try:
        update.status = 'Rejected'
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred updating the booking status."}), 500

    return jsonify({"message": "Your booking has been rejected."}), 201


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
    app.run(port = 5002, debug = True)