import MySQLdb
import RPi.GPIO as Pi
import sys
from threading import Timer
import time
import os
from Queue import Queue
import serial

def PiSetup():
	Pi.setmode(Pi.BCM)
	Pi.setup(2, Pi.OUT)
	ser = serial.Serial('/dev/ttyUSB0', 9600)
	return ser

def on(ser):
	Pi.output(2,False)	#Turn LED OFF (turn on only when main light OFF)
	ser.write('0')		#Relay is normally disengaged (so turning it OFF turns main light ON)
#	print "Light on!"


def off(ser):
	Pi.output(2,True)	#Turn LED ON (turn off only when main light ON)
	ser.write('1')		#Relay is normally disengaged (so turning it ON turns main light OFF)
#	print "Light off!"


def getStatus():
	db_conn = MySQLdb.connect('localhost', 'root', 'R34d0nly', 'home_automation');

	try:
		cur = db_conn.cursor();

		try:
			cur.execute("SELECT status FROM home_automation.lights ORDER BY update_sys_time DESC LIMIT 1")

		except Exception, e:
			print "Error executing query: " + str(e)
			sys.exit(2)
	
		try:
			data = cur.fetchall()
		except Exception, e:
			print "Error reading result set: " + str(e)
			sys.exit(2)
	except Exception, e:
		print "Error running function getStatus(): " + str(e)
		sys.exit(2)

	return data



def main():
	ser = PiSetup()
	#ser = serial.Serial('/dev/ttyUSB0', 9600)
	start_time = time.time()
	elapsed_time = 0.0
	shutdown_time = 65.0

	while elapsed_time < shutdown_time:
		status = int(getStatus()[0][0])
	
		print status
	
		if status == 1:
			on(ser)
		elif status == 0:
			off(ser)
		else:
			print "In else:"
			off()
		
		time.sleep(0.25)

		elapsed_time = time.time() - start_time

	print "Finished checking light. Shutting down..."

if __name__ == '__main__':
	main()
