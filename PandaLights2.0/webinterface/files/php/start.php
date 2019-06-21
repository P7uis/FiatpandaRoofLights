<?php
  if(!isset($start)){
    echo "start hasn't been set!";
    die("start hasn't been set!");
  }
  else{
      if($startselection[0])include("/var/www/html/files/php/functions.php");
      if($startselection[1])include("/var/www/html/files/php/head.php");
      if($startselection[2])include("/var/www/html/files/php/nav.php");
  }
