<?php
$server    = 'localhost';
$username  = 'root';
$password  = '';
$dbName = 'addressbook';
@ $db = new mysqli($server, $username, $password, $dbName);
if (mysqli_connect_errno())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}
?>