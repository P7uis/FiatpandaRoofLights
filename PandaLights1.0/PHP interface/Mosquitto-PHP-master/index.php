<?php
//error reporting
ini_set('display_errors', '1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('BROKER', '172.10.0.60');
define('PORT', 1883);
define('CLIENT_ID', "pubclient_" + getmypid());

$client = new Mosquitto\Client(CLIENT_ID);
$client->connect(BROKER, PORT, 60);

for($i =0; $i < 5; $i++)
{
	$message = $i." wat moet er versuutd worden";	
	$client->publish('test3', $message, 0, false);
}
echo "succes!";
