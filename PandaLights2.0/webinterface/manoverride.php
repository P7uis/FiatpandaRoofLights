<?php
//some startup variables
//select options [functions, head, nav] true or false for the start file
$start = [1,1,0];
$page = "Home";
$docroot = $_SERVER["DOCUMENT_ROOT"];
//include start file which in turn includes functions, head and nav file
include("$docroot/files/php/start.php");

if(isset($_POST['manoverride'])){

  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/current.enabled.conf", "r");
  if (filesize("/home/$user/panda/current.enabled.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $toggle = explode(' ', fread($profiles, filesize("/home/$user/panda/current.enabled.conf")));
    if($toggle[0] == "True")$enabled = "True";
    else $enabled = "False";
  }
  fclose($profiles);
  $profilesW = fopen("/home/$user/panda/current.enabled.conf", "w");
  $overwrite = "False";
  fwrite($profilesW, $overwrite);
  fclose($profilesW);


  if($enabled == "True")sleep(2);
  if (isset($_POST['Light1']))$l1 = 1; else $l1 = 0;
  if (isset($_POST['Light2']))$l2 = 1; else $l2 = 0;
  if (isset($_POST['Light3']))$l3 = 1; else $l3 = 0;
  if (isset($_POST['Light4']))$l4 = 1; else $l4 = 0;
  if (isset($_POST['Light5']))$l5 = 1; else $l5 = 0;
  $lights = $l1.','.$l2.','.$l3.','.$l4.','.$l5;
  echo 'mosquitto_pub -h 10.0.0.1 -p 1883 -t PandaLights -m "'.$lights.'"';
  exec('mosquitto_pub -h 10.0.0.1 -p 1883 -t PandaLights -m "'.$lights.'"');
  header("location: /index.php");
}

//header("location: /index.php");
 ?>
