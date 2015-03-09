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
	$db = new Database\DBClass();
    $db->setTypeDB($dbtype);
    $db->setConnData(new Database\Adapter\Conn\PostgresConn($dbhost, $user, $pass, $dbname));
    $db->connect();
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
/////QUERY

try {
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

///////EXECUTE
try {
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

<form>
</form>
</body>
</html>