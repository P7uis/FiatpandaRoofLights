<?php
$start = [1,1,0];
$page = "Profiles";
$docroot = $_SERVER["DOCUMENT_ROOT"];
//include start file which in turn includes functions, head and nav file
include("$docroot/files/php/start.php");
ProfileLister();
 ?>
