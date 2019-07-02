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
    ProfileEnabler($id);
    header("location: ../profiles");
  }


else if(isset($_POST['name']) && isset($_POST['create'])){
  $i = 0;
  $profile = 0;
  $id = "ID-".round($salt = uniqid(mt_rand(), true));
  $name = "NAME-".$_POST['name'];
  $cycles= "CYCLES";
  while (True){
    if(isset($_POST['delay'.$i])){
      $delay = $_POST['delay'.$i];
      $cycles = $cycles."-";
      for($j = 0; $j <= 4; $j++) {
        if(isset($_POST['profile'.$profile.$i.$j]))$cycles = $cycles."1";
        else $cycles = $cycles."0";
        if($j == '4'){}
          else $cycles = $cycles.",";
      }
      $i++;
      $cycles = $cycles."-[$delay]";
    }
    else break;
  }
  ProfileCreater($id, $name, $cycles);
  header("location: ../profiles");
}

else if(isset($_POST['name']) && isset($_POST['edit']) && isset($_POST['profiles'])){
  $i = 0;
  $profile = $_POST['profiles'];
  $id = "ID-".$_POST['edit'];
  $name = "NAME-".$_POST['name'];
  $cycles= "CYCLES";
  while (True){
    if(isset($_POST['delay'.$i])){
      $delay = $_POST['delay'.$i];
      $cycles = $cycles."-";
      for($j = 0; $j <= 4; $j++) {
        if(isset($_POST['profile'.$profile.$i.$j]))$cycles = $cycles."1";
        else $cycles = $cycles."0";
        if($j == '4'){}
          else $cycles = $cycles.",";
      }
      $i++;
      $cycles = $cycles."-[$delay]";
    }
    else break;
  }
  ProfileEditor($id, $name, $cycles);
  header("location: ../profiles");
}

else if(isset($_POST['delete'])){
  $id = "ID-".$_POST['delete'];
  ProfileDeleter($id);
  header("location: ../profiles");
}
 ?>
