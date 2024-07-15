<?php
$host = 'localhost';
$db = 'vkas_esewa';
$user = 'vkas_esewa'; // Your database user
$password ='#tz~-RWG9+7%'; // Your Database password

$conn = new mysqli($host, $user, $password, $db);
if( $conn ->connect_error)
{
	echo "Failed to connect to MySQL". $conn->connect_error;
	exit;
}