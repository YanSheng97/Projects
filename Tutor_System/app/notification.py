import json
import sys
import os
import random
import mysql.connector
import requests
from flask import Flask
from flask_mail import Mail, Message

import pika

app = Flask(__name__)


app.config.update(
    MAIL_SERVER = 'smtp.gmail.com',
    MAIL_PORT = 465,
    MAIL_USE_SSL = True,
    MAIL_USERNAME = 'g6t7tuition@gmail.com',
    MAIL_PASSWORD = 'is213g6t7asdfgh'
)


mail = Mail(app)



def receiveRequest():
    # prepare a queue for receiving messages
    channelqueue = channel.queue_declare(queue="notification", durable=True) # 'durable' makes the queue survive broker restarts so that the messages in it survive broker restarts too
    queue_name = channelqueue.method.queue
    channel.queue_bind(exchange=exchangename, queue=queue_name, routing_key='*.request') # bind the queue to the exchange via the key
        # any routing_key with two words and ending with '.order' will be matched

    # set up a consumer and start to wait for coming messages
    channel.basic_qos(prefetch_count=1) # The "Quality of Service" setting makes the broker distribute only one message to a consumer if the consumer is available (i.e., having finished processing and acknowledged all previous messages that it receives)
    channel.basic_consume(queue=queue_name, on_message_callback=callback, auto_ack=True) # 'auto_ack=True' acknowledges the reception of a message to the broker automatically, so that the broker can assume the message is received and processed and remove it from the queue
    channel.start_consuming() # an implicit loop waiting to receive messages; it doesn't exit by default. Use Ctrl+C in the command window to terminate it.

def callback(channel, method, properties, body): # required signature for the callback; no return
    print("Received a request by " + __file__)
    result = processRequest(json.loads(body))
    # print processing result; not really needed
    #json.dump(result, sys.stdout, default=str) # convert the JSON object to a string and print out on screen
    if result == 'Message Sent!':
        print("Notification email sent.")
    else:
        print("Failed to send notification email.")
    print() # print a new line feed to the previous json dump
    print() # print another new line as a separator

def processRequest(request):
    print("Processing a request:")
    print(request)
    # Can do anything here. E.g., publish a message to the error handler when processing fails.

    # resultstatus = bool(random.getrandbits(1)) # simulate success/failure with a random True or False
    # result = {'status': resultstatus, 'message': 'Simulated random  result.', 'reservation': reservation}
    # resultmessage = json.dumps(result, default=str) # convert the JSON object to a string


# ---------------------------need to be confirmed------------------------------------
    tutor_id = request['tutor_id']
    tutee_id = request['tutee_id']
    booking_id = request['booking_id']
    print(request)
# ---------------------------need to be confirmed------------------------------------
    if 'status' in list(request.keys()) and request['status']=='accept':
        hostname = "localhost" # default hostname
        port = 5672 # default port
        # connect to the broker and set up a communication channel in the connection
        connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
            # Note: various network firewalls, filters, gateways (e.g., SMU VPN on wifi), may hinder the connections;
            # If "pika.exceptions.AMQPConnectionError" happens, may try again after disconnecting the wifi and/or disabling firewalls
        channel = connection.channel()
        # set up the exchange if the exchange doesn't exist
        exchangename="tutee_topic"
        channel.exchange_declare(exchange=exchangename, exchange_type='topic')


        email = tutee_id
        text = "Your request with booking id " + str(booking_id) +" has been accepted!"

    elif 'status' in list(request.keys()) and request['status']=='reject':
        hostname = "localhost" # default hostname
        port = 5672 # default port
        # connect to the broker and set up a communication channel in the connection
        connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
            # Note: various network firewalls, filters, gateways (e.g., SMU VPN on wifi), may hinder the connections;
            # If "pika.exceptions.AMQPConnectionError" happens, may try again after disconnecting the wifi and/or disabling firewalls
        channel = connection.channel()
        # set up the exchange if the exchange doesn't exist
        exchangename="tutee_topic"
        channel.exchange_declare(exchange=exchangename, exchange_type='topic')


        email = tutee_id
        text = "Your request with booking id " + str(booking_id) +" has been rejected!"
    else:
        hostname = "localhost" # default hostname
        port = 5672 # default port
        # connect to the broker and set up a communication channel in the connection
        connection = pika.BlockingConnection(pika.ConnectionParameters(host=hostname, port=port))
            # Note: various network firewalls, filters, gateways (e.g., SMU VPN on wifi), may hinder the connections;
            # If "pika.exceptions.AMQPConnectionError" happens, may try again after disconnecting the wifi and/or disabling firewalls
        channel = connection.channel()
        # set up the exchange if the exchange doesn't exist
        exchangename="tutor_topic"
        channel.exchange_declare(exchange=exchangename, exchange_type='topic')


        email = tutor_id
        text = "You have received a request with booking id " + str(booking_id) +" !"

    with app.app_context():  #enable application context to access global variable
        msg = Message('['+booking_id+'] Tuition request update from Tutor Labs',
                        sender='g6t7tuition@gmail.com',
                        recipients=[email], body="Dear user,\n\n\t"+text+"\n\nBest wishes,\nTutor Labs")
        mail.send(msg)
        result = 'Message Sent!'
    return result



# @app.route('/')
# def index():
#     msg = Message('Request sent successfully!',
#                     sender='g6t7tuition@gmail.com',
#                     recipients=['zyfyang.2018@sis.smu.edu.sg'])
#     msg.body = 'Your request for the tutor has been confirmed!'
#     mail.send(msg)
#     return 'Message sent!'


if __name__ == '__main__':
    print("This is " + os.path.basename(__file__) + ": notifying for a request..")
    receiveRequest()
    app.run(port = 5004, debug=True)