<?php
//http://php.net/manual/en/function.parse-ini-file.php
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';

$iniArray  = parse_ini_file("Database/database.ini");
$dbhost    = $iniArray["dbhost"];
$user      = $iniArray["user"];
$pass      = $iniArray["pass"];
$dbname    = $iniArray["dbname"];
$dbtype    = $iniArray["dbtype"];

try {
    $db = new Database\DBClass($dbtype,new Database\Adapter\Conn\MySqlConn($dbhost, $user, $pass, $dbname));
} catch (RuntimeException $e) {
    echo "<table border=\"1\"><tr><td>".
		 "RuntimeException: ".$e->getMessage()."<br />".
		 " in ".$e->getFile()." on line ".$e->getLine().
		 "</td></tr></table><br />";
    exit;
} catch (InvalidArgumentException $e) {
	echo "<table border=\"1\"><tr><td>".
		 "InvalidArgumentException: ".$e->getMessage()."<br />".
		 " in ".$e->getFile()." on line ".$e->getLine().
		 "</td></tr></table><br />";
	exit;
} catch (Exception $e) {
	echo "<table border=\"1\"><tr><td>".
		 "Exception: ".$e->getMessage()."<br />".
		 " in ".$e->getFile()." on line ".$e->getLine().
		 "</td></tr></table><br />";
	exit;
}

?>