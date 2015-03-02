<?php
//http://php.net/manual/en/function.parse-ini-file.php
//define("AP_SITE", "localhost/AddressBook/");

spl_autoload_register(function ($class_name) {
	//List all the class directories in the array.
    $array_paths = array(
		'Contact/',
        'Database/',
		'Database/Adapter/',
		'User/'
    );

	$file_name = ($class_name).'.php';

    for ($i = 0; $i < count($array_paths); $i++) 
    {
		//$path = AP_SITE.$array_paths[$i].$file_name;
		$path = $_SERVER['DOCUMENT_ROOT']."/AddressBook/".$array_paths[$i].$file_name;
        if(file_exists($path)) 
        {
            require_once $path;
        }
    }
});

$ini_array = parse_ini_file("Database/database.ini");

$server    = $ini_array["server"];
$username  = $ini_array["username"];
$password  = $ini_array["password"];
$dbName = $ini_array["dbName"];
$dbType = $ini_array["dbType"];

try
{
	$db = new DBclass($dbType,new MySqlConn($server, $username, $password, $dbName));
}
catch (InvalidArgumentException $e)
{
	echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
	exit;
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