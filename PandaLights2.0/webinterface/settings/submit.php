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

 ?>
