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
    $db = new Database\DBClass($dbtype,new Database\Adapter\MySqlConn($dbhost, $user, $pass, $dbname));
} catch (Exception $e) {
    echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
    exit;
}

if($db->error()) {
    echo "Error: Could not connect to database. Please try again later.<br>";
    exit;
}
?>