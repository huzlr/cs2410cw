<?php

$dbhost = 'localhost';
$dbuser = 'u-ibrahih6';
$dbpass = 'AUt4b6XaBtHEWMz';
$db     = 'u_ibrahih6_db';

//set up database connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

//hide sql warning/errors for security
error_reporting(0);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	// if statement to check if the connection to the DB was succesful
	}
?>