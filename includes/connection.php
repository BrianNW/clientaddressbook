<?php

$server         = "localhost";
$db_username     = "root";
$password       = "123";
$db             = "db_clientaddressbook";

// create connection
$conn = mysqli_connect( $server, $db_username, $password, $db );

// check connection
// if (!$conn) {
//   // code...
//   die( "Connection failed: " . mysqli_connect_error() );
// }

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";

 ?>
