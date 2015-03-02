<?php
//http://php.net/manual/en/function.parse-ini-file.php
require_once $_SERVER['DOCUMENT_ROOT']."/AddressBook/".'AutoLoad.php';

$ini_array = parse_ini_file("Database/database.ini");

$server    = $ini_array["server"];
$username  = $ini_array["username"];
$password  = $ini_array["password"];
$dbName = $ini_array["dbName"];
$dbType = $ini_array["dbType"];

try
{
	$db = new Database\DBclass($dbType,new Database\Adapter\MySqlConn($server, $username, $password, $dbName));
}
catch (Exception $e)
{
	echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
	exit;
}

if($db->error())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}
?>