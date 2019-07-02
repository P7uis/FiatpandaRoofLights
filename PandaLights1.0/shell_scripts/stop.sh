#!/bin/bash
set -x
	mosquitto_pub -t L1I -m "0"
	mosquitto_pub -t L2I -m "0"
	mosquitto_pub -t L3I -m "0"
	mosquitto_pub -t L4I -m "0"
	mosquitto_pub -t L5I -m "0"
sleep 2
