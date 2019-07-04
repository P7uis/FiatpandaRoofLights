import time
import os
import re

shutdowntoggle = False

try:
    import paho.mqtt.client as mqttClient
    import time
    import os
    import re

    while True:
        with open('/home/pi/panda/current.enabled.conf', 'r') as enabled:
            for enable in enabled:
                if "True" in enable:
                    shutdowntoggle = False
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
                                            os.system("mosquitto_pub -h 10.0.0.1 -p 1883 -t PandaLights -m \""+ cycle + "\"")
                                        i += 1
                else:

                    if shutdowntoggle == False:
                        for i in range(5):
                            os.system("clear")
                            cycle = "0,0,0,0,0"
                            print("turning off lights attempt ", i)
                            print("array:  " + cycle)
                            os.system("mosquitto_pub -h 10.0.0.1 -p 1883 -t PandaLights -m \""+ cycle + "\"")
                            #time.sleep(1)
                        shutdowntoggle = True
                    os.system("clear")
                    print("Lights: disabled")
                    time.sleep(2)
except KeyboardInterrupt:
    quit()
