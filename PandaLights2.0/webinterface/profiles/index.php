<?php
  error_reporting( E_ALL );
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,1];
  $page = "Profiles";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");
 ?>
 <div class="content">
   <h1>Hello World!</h1>
 </div>
