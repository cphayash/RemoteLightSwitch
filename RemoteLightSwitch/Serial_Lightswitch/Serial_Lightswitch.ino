const int ledPin = 8;

void setup()
{
  pinMode(ledPin, OUTPUT);
  Serial.begin(9600);
}

void loop()
{
  Serial.println("Hello Pi");
  if (Serial.available())
  {
     lightSwitch(Serial.read() - '0');
  }
  delay(100);
}

void lightSwitch(int n)
{
  if(n == 1)
  {
    digitalWrite(ledPin, HIGH);
  }
  else
  {
    digitalWrite(ledPin, LOW);
  }
}


