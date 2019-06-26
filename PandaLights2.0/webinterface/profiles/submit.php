<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,0];
  $page = "Settings";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");

$i = 0;
if(isset($_POST['name']) && isset($_POST['id'])){
  $id = "ID-".$_POST['id'];
  $name = "NAME-".$_POST['name'];
  $cycles= "CYCLES";
  while (True){
    if(isset($_POST['delay'.$i])){
      $delay = $_POST['delay'.$i];
      $cycles = $cycles."-";
      for($j = 0; $j <= 4; $j++) {
        if(isset($_POST['profile'.$i.$j]))$cycles = $cycles."1";
        else $cycles = $cycles."0";
        if($j == '4'){}
          else $cycles = $cycles.",";
      }
      $i++;
      $cycles = $cycles."-[$delay]";
    }
    else break;
  }
}
ProfileEditor($id, $name, $cycles);
header("location: ../profiles");
 ?>
