<?php
require_once 'Database/DBclass.php';
$ini_array = parse_ini_file("Database/database.ini");

$server    = $ini_array["server"];
$username  = $ini_array["username"];
$password  = $ini_array["password"];
$dbName = $ini_array["dbName"];
$dbType = $TypeDB[$ini_array["dbType"]];


$db = new DBclass($dbType,new MySqlConn($server, $username, $password, $dbName));

if($db->error())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}
?>