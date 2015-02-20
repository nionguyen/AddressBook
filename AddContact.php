<html>
<body>
<?php
require 'Config.php';

$firstName			= $_POST["firstName"];
$lastName 			= $_POST["lastName"];
$company 			= $_POST["company"];
$phone 				= $_POST["phone"];
$email 				= $_POST["email"];
$url 				= $_POST["url"];
$address 			= $_POST["address"];
$birthday 			= $_POST["birthday"];
$date 				= $_POST["date"];
$related 			= $_POST["related"];
$socialProfile 		= $_POST["socialProfile"];
$instantMessage 	= $_POST["instantMessage"];

@ $db = new mysqli($server, $username, $password, $dbName);

if (mysqli_connect_errno())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}

$query = "insert into contact values (NULL,'".$firstName."', '".$lastName."', '".$company."', '".$phone."', '".$email."', '".$url."', '".$address."', '".$birthday."', '".$date."', '".$related."', '".$socialProfile."', '".$instantMessage."')";
$result = $db->query($query);

if($result)
{
	echo $db->affected_rows." contact added successfully<br>";
}
else
{
	echo "Error<br>";
}
$db->close();

?>
</body>
</html>