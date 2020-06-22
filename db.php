<?php
$con = mysqli_connect("192.186.204.166","apdegypt","?U9Pylv4x-.e","apdegypt1");
    if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
date_default_timezone_set('Africa/Cairo');
$error="";
?>