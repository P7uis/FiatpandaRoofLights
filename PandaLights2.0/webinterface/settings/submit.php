<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,0];
  $page = "Settings";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");

  //change theme
  if(isset($_POST['theme'])){
    $option = $_POST['theme'];
    ThemeWrite($option);
    header("location: ../settings");
  }

  else if(isset($_POST['wpa-ssid-c']) && isset($_POST['wpa-psk-c'])){
    $ssid = $_POST['wpa-ssid-c'];
    $psk = $_POST['wpa-psk-c'];
    WPAconfAdd($ssid, $psk);
    header("location: ../settings");
  }

  else if(isset($_POST['wpa-ssid']) && isset($_POST['wpa-ssid-old']) && isset($_POST['wpa-psk']) && isset($_POST['wpa-psk-old'])){
    $ssid = $_POST['wpa-ssid'];
    $ssidold = $_POST['wpa-ssid-old'];
    $psk = $_POST['wpa-psk'];
    $pskold = $_POST['wpa-psk-old'];
    WPAconfWrite($ssid, $ssidold, $psk, $pskold);
    header("location: ../settings");
  }

  else if(isset($_POST['wpa-ssid-del']) && isset($_POST['wpa-psk-del'])){
    $ssid = $_POST['wpa-ssid-del'];
    $psk = $_POST['wpa-psk-del'];

    $wpaconflist = explode(PHP_EOL, WPAconfDelete($ssid, $psk));
    header("location: ../settings");
  }

 ?>
