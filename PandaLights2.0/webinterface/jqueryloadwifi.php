<?php

//some startup variables
//select options [functions, head, nav] true or false for the start file
$start = [1,0,0];
$page = "Settings";
$docroot = $_SERVER["DOCUMENT_ROOT"];
//include start file which in turn includes functions, head and nav file
include("$docroot/files/php/start.php");

 ?>
<a class="nav-link active"><?php SSIDcheck();?></a>
