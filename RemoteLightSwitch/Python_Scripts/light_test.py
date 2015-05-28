import RPi.GPIO
import time

RPi.GPIO.setmode(RPi.GPIO.BCM)

RPi.GPIO.setup(2, RPi.GPIO.OUT)

def on():
	RPi.GPIO.output(2, True)
	print "Light on!"

def off():
	RPi.GPIO.output(2, False)
	print "Light off!"

def blink():
	on()
	time.sleep(0.25)
	off()
	time.sleep(0.25)

for x in range(0,5):
	blink()


