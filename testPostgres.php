<html>
<body>
<?php
//Test Database Adapter with Postgres Database//

require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';

$iniArray  = parse_ini_file("Database/database.ini");
$dbhost    = 'localhost';
$user      = 'postgres';
$pass      = 'root';
$dbname    = 'postgres';
$dbtype    = 1;

try {
    $db = new Database\DBClass($dbtype,new Database\Adapter\Conn\MySqlConn($dbhost, $user, $pass, $dbname));
} catch (Exception $e) {
    echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
    exit;
}
/////QUERY
$query = "SELECT * FROM company";
$result = $db->query($query);

if (!$result) {
	echo "An error occurred.\n";
	exit;
}
$num_results = $result->num_rows();
for ($i=0; $i <$num_results; $i++)
{
	$row = $result->fetch_assoc();
	echo $row['address'] . "<br>";
}

///////EXECUTE
$query = 'SELECT * FROM company WHERE address = $1';
$stmt = $db->prepare($query);
$stmt->bind_param(null,"Norway");
$stmt->execute();
$result = $stmt->get_result();
for ($i=0; $i <$num_results; $i++)
{
	$row = $result->fetch_assoc();
	echo $row['address'] . "<br>";
}

?>

<form>
</form>
</body>
</html>