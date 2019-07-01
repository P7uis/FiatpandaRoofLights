int Relay = 0;
#include <ESP8266WiFi.h>
#include <PubSubClient.h>
WiFiClient espClient;
PubSubClient client(espClient);
const char* ssid = "xxxxxxxx";      //replace "xxxxxxxx" with your wifi SSID
const char* password = "yyyyyyyy";  //replace "yyyyyyyy" with your Wifi password
const char* mqtt_server = "xxx.xxx.xxx.xxx";  //replace "xxx.xxx.xxx.xxx" with your broker IP
const char* outTopic = "Ready"; //define esp mqtt outgoing topic
const char* inTopic = "Lights"; //define esp mqtt incoming topic

void setup_wifi() {

  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  randomSeed(micros());

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void callback(char* inTopic, byte* payload, unsigned int length) {
  Serial.print("Message arrived [");
  Serial.print(inTopic);
  Serial.print("] ");
  for (int i = 0; i < length; i++) {
    Serial.print((char)payload[i]);
  }
  Serial.println();
  //Check if second index is true
  //NOTE on this relay, LOW is on and HIGH is off
  if ((char)payload[0] == '1') {        //edit the number in "payload[0]" to change the checked position of the array 
    digitalWrite(Relay, LOW);
  } 
  else {
    digitalWrite(Relay, HIGH);
  }
}

void reconnect() {
  // Loop until we're reconnected
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    // Create a random client ID
    String clientId = "ESP8266Client-";
    clientId += String(random(0xffff), HEX);
    // Attempt to connect
    if (client.connect(clientId.c_str())) {
      Serial.println("connected");
      // Once connected, publish an announcement...
      client.publish(outTopic, "L3 Ready");   
      // ... and resubscribe
      client.subscribe(inTopic);
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      delay(5000);
    }
  }
}

void setup() {
  pinMode(Relay, OUTPUT);     // Initialize the BUILTIN_LED pin as an output
  digitalWrite(Relay, HIGH);
  Serial.begin(115200);
  setup_wifi();
  client.setServer(mqtt_server, 1883);
  client.setCallback(callback);
}


void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop(); //place your sensor readings here
}
