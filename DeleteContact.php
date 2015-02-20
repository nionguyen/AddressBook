<html>
<body>
<?php
require 'Config.php';
$contactID = $_POST["contactID"];

@ $db = new mysqli($server, $username, $password, $dbName);

if (mysqli_connect_errno())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}

$query = "DELETE FROM `contact` WHERE `ContactID` = '".$contactID."'";
$result = $db->query($query);

echo "Deleted Successfully";
?>
</body>
</html>