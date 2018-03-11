<?php
$server = "localhost";
$username = "root";
$password = "Kristingk7";
$db = "db_clientaddressbook";

//create a connection
$conn = mysql_connect( $server, $username, $password, $db);

//check connections
if (!conn) {
  die("Connection failed: " . mysqli_connect_error() );
}
 ?>
