<?php
//http://php.net/manual/en/function.parse-ini-file.php
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';

abstract class LogMod
{
    const File   = 0;
    const Screen = 1;
}
$logMod = LogMod::Screen;

function writeLog($content)
{
    $file = $_SERVER['DOCUMENT_ROOT']."/AddressBook/log.txt";
    file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
}
function writeError($userID, $error)
{
    global $logMod;
    if($logMod == LogMod::File)
        writeLog("UserID : ".$userID."\n".$error."\n=====================\n");
    else
        echo "<table border=\"1\"><tr><td>".$error."</td></tr></table><br />";
}

$iniArray  = parse_ini_file("Database/database.ini");
$dbhost    = $iniArray["dbhost"];
$user      = $iniArray["user"];
$pass      = $iniArray["pass"];
$dbname    = $iniArray["dbname"];
$dbtype    = $iniArray["dbtype"];

try {
    $db = new Database\DBClass();
    $db->setTypeDB($dbtype);
    $db->setConnData(new Database\Adapter\Conn\MySqlConn($dbhost, $user, $pass, $dbname));
    $db->connect();
} catch (RuntimeException $e) {
    $error = "RuntimeException: ".$e->getMessage()."<br />".
             " in ".$e->getFile()." on line ".$e->getLine();
    writeError($userID, $error);
    exit;
} catch (InvalidArgumentException $e) {
    $error = "InvalidArgumentException: ".$e->getMessage()."<br />".
             " in ".$e->getFile()." on line ".$e->getLine();
    writeError($userID, $error);
    exit;
} catch (Exception $e) {
    $error = "Exception: ".$e->getMessage()."<br />".
             " in ".$e->getFile()." on line ".$e->getLine();
    writeError($userID, $error);
    exit;
}

?>