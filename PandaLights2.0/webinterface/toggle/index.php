<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,0];
  $page = "Settings";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");
  $link = $_SERVER['SERVER_ADDR'];
  if(isset($_GET['page']) && $_GET['page'] != "Home")$page = "http://".$link."/".strtolower($_GET['page']);
  else $page = "http://".$link."/";
  LightsToggle();
  header("location: ".$page);

 ?>
