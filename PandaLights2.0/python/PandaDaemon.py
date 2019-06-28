import paho.mqtt.client as mqttClient
import time
import os
import re


def on_connect(client, userdata, flags, rc):

    if rc == 0:

        print("Connected to broker")

        global Connected
        Connected = True

    else:

        print("Connection failed")


Connected = False

broker_address = "10.0.0.1"
port = 1883
user = "yourUser"
password = "yourPassword"

client = mqttClient.Client("Python")
client.username_pw_set(user, password=password)
client.on_connect = on_connect
client.connect(broker_address, port=port)

client.loop_start()

while Connected != True:
    time.sleep(0.1)

try:
    import paho.mqtt.client as mqttClient
    import time
    import os
    import re

    while True:
        with open('/home/pi/panda/current.enabled.conf', 'r') as enabled:
            for enable in enabled:
                if "True" in enable:
                    with open('/home/pi/panda/current.profile.conf', 'r') as output:
                        for line in output:
                            if "ID" in line:
                                IDline = line.split('-')
                                id = IDline[1]
                            elif "NAME" in line:
                                NAMEline = line.split('-')
                                name = NAMEline[1]
                            elif "CYCLES" in line:
                                CYCLESline = line.split('-')
                                ii = len(CYCLESline)
                                i = 0
                                for cycle in CYCLESline:
                                    if i == ii - 2 and cycle == "0,0,0,0,0":
                                        break
                                    else:
                                        if "CYCLES" in cycle:
                                            userlessvar = ""
                                        elif "[" in cycle or "]" in cycle:
                                            delay = cycle[cycle.find(
                                                '[') + len('['):cycle.rfind(']')]
                                            time.sleep(float(delay))
                                        else:
                                            os.system("clear")
                                            print("Lights: enabled\n")
                                            print("id:     " + id)
                                            print("name:   " + name)
                                            print("array:  " + cycle)
                                            client.publish("PandaLights", cycle)
                                        i += 1
                else:
                    os.system("clear")
                    print("Lights: disabled")
                    time.sleep(2)
except KeyboardInterrupt:
    client.disconnect()
    client.loop_stop()
