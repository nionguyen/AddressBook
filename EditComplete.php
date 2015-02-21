<html>
<body>
<?php
require 'Config.php';
$contactID = $_POST["contactID"];
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
$query = "UPDATE `contact` SET `ContactID`='".$contactID."'".",`FirstName`='".$firstName."'".",`LastName`='".$lastName."'".",`Company`='".$company."'".",`Phone`='".$phone."'".",`Email`='".$email."'".",`Url`='".$url."'".",`Address`='".$address."'".",`Birthday`='".$birthday."'".",`Date`='".$date."'".",`Related`='".$related."'".",`SocialProfile`='".$socialProfile."'".",`InstantMessage`='".$instantMessage."'"." WHERE `ContactID` = '".$contactID."'";
$result = $db->query($query);
if($result)
	echo "Edited Sucessfully";
else 
	echo "Something Error";
?>
</body>
</html>