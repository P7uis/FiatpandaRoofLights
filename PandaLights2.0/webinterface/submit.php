<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,0];
  $page = "Settings";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");

  if(isset($_POST['enable'])){
    $id = "ID-".$_POST['enable'];
    echo "$id";
    ProfileEnabler($id);
    header("location: ../");
  }
  ?>
