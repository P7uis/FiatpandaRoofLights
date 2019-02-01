<?php
//error reporting
ini_set('display_errors', '1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('BROKER', 'mqtt.p7uis.nl');
define('PORT', 1883);
define('CLIENT_ID', "pubclient_" + getmypid());

$client = new Mosquitto\Client(CLIENT_ID);
$client->connect(BROKER, PORT, 60);

for($i =0; $i < 60; $i++)
{
	$message = "Loop 2";
	$client->publish('test3', $message, 0, false);
  sleep("1");
}
echo "succes!";
