<?php
//error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
//unclude all other selected start files
if(!isset($start))die("start hasn't been set!");
else{
if($start[0])include("$docroot/files/php/functions.php");
if($start[1])include("$docroot/files/php/head.php");
if($start[2])include("$docroot/files/php/nav.php");
}
