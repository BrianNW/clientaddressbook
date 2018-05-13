<?php

$server         = "localhost";
$username       = "root";
$password       = "";
$db             = "db_clientaddressbook";

// create connection
$conn = mysqli_connect();

// check connection
if (!$conn) {
  // code...
  die( "Connection failed: " . mysqli_connect_error() );
}

 ?>
