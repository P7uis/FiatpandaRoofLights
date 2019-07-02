
<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,0,0];
  $page = "Settings";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");

//error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

SSIDcheck();
?>
