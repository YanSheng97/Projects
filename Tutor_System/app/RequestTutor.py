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


# create flask application
app = Flask(__name__)
CORS(app)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/booking'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)


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
    # print (request)

    booking_id = request["booking_id"]
    
    booking = requests.get("http://127.0.0.1:5002/booking/{}".format(booking_id))
    data = booking.json()
    # print ("data=", data)

    if "message" in data:
        print (create_booking(request))
    else:
        if "status" in request:
            if request["status"] == "accept":
                accept_booking(request)
            elif request["status"] == "reject":
                reject_booking(request)
        else:
            print ("Request is already sent before. Status is pending now.")

    # if Booking.query.filter_by(booking_id=booking_id).first():
        
    print()


def create_booking(request):
    booking_id = request["booking_id"]
    request["payment"] = "Pending"
    request["status"] = "Pending"

    create_status = requests.post("http://127.0.0.1:5002/booking/create/{}".format(booking_id), json = request)

    return create_status


def accept_booking(request):
    booking_id = request["booking_id"]
    # request["payment"] = "Pending"
    # request["status"] = "Pending"

    accept_status = requests.post("http://127.0.0.1:5002/booking/accept/{}".format(booking_id), json = request)

    return accept_status


def reject_booking(request): 
    booking_id = request["booking_id"]
    # request["payment"] = "Pending"
    # request["status"] = "Pending"

    reject_status = requests.post("http://127.0.0.1:5002/booking/reject/{}".format(booking_id), json = request)

    return reject_status


if __name__ == '__main__':
    receiveRequest()