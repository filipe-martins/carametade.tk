<?php 

/* Credentials */
$servername = "localhost";
$username = "root";
$password = "";
$database = "membership";


/* Connection */
$conn = new mysqli($servername, $username, $password, $database);

/* If connection fails for some reason */
if ($conn->connect_error) {
	die("Database connection failed: ". $conn->connect_error);
}

?>