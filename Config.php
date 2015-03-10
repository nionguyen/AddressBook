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
//$location  = $iniArray["location"];

try {

    switch ($dbtype) {
        case Database\Adapter\TypeDB::MYSQL: {
            $connData = new Database\Adapter\Conn\MySqlConn($dbhost, $user, $pass, $dbname);
            $connData->validate();
            $mysqli = new mysqli($connData->dbhost, $connData->user, $connData->pass, $connData->dbname);
            if (mysqli_connect_error()) {
                throw new \RuntimeException("Mysql Connect failed: ".mysqli_connect_error());
            }
            $dbd = new Database\Adapter\MySqlDB($mysqli);
            break;
        }
        case Database\Adapter\TypeDB::POSTGRES: {
            $connData = new Database\Adapter\Conn\PostgresConn($dbhost, $user, $pass, $dbname);
            $connData->validate();
            if(!$postgresDB = @pg_connect($connData->connString))
            {
                throw new \RuntimeException("Postgres Connect failed ");
            }
            $dbd = new Database\Adapter\PostgresDB($postgresDB);
            break;
        }
        case Database\Adapter\TypeDB::SQLITE: {
            //$connData = new Database\Adapter\Conn\SqliteConn($location);
            //$connData->validate();
            //$sqliteDB = new SQLite3($location);
            //$dbd = new Database\Adapter\SqliteDB($sqliteDB);
            break;
        }
        default: {
            throw new InvalidArgumentException('$dbtype is not appropriate');
            break;
        }
    }

    $db = new Database\DBClass($dbd, $dbtype);
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