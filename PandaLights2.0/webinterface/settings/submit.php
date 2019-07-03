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
  else if (isset($_FILES["wpaconf"])) {
      echo basename($_FILES["wpaconf"]["name"]);
      $target_dir = "/etc/wpa_supplicant/";
      $target_file = $target_dir . basename($_FILES["wpaconf"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $target_file = $target_dir . "wpa_supplicant-wlan1.conf";

      // Allow certain file formats
      if ($imageFileType != "conf") {
          $videomsg =  "Only .conf files are allowed";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $videomsg =  "Sorry! The file wasn't uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["wpaconf"]["tmp_name"], $target_file)) {
              $videomsg = "The file <b>". basename($_FILES["wpaconf"]["name"]). "</b> is succesfully uploaded.";
          } else {
              $videomsg = "Sorry! The file wasn't uploaded.";
          }
      }
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
