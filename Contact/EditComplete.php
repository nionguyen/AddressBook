<html>
<body>
<?php
require_once '../Config.php';
$contactID 			= $_POST["contactID"];
$firstName			= $_POST["firstName"];
$lastName 			= $_POST["lastName"];
$company 			= $_POST["company"];
$phone 				= (int)$_POST["phone"];
$email 				= $_POST["email"];
$url 				= $_POST["url"];
$address 			= $_POST["address"];
$birthday 			= $_POST["birthday"];
$date 				= $_POST["date"];
$related 			= $_POST["related"];
$socialProfile 		= $_POST["socialProfile"];
$instantMessage 	= $_POST["instantMessage"];

try
{
	$contactID = isset($_POST['contactID']) ? (int)$_POST['contactID'] : false;
	$contactID = str_replace('/[^0-9]/', '', $contactID);
	
	$firstName = $db->real_escape_string($firstName);
	$lastName = $db->real_escape_string($lastName);
	$company = $db->real_escape_string($company);
	$email = $db->real_escape_string($email);
	$url = $db->real_escape_string($url);
	$address = $db->real_escape_string($address);
	$birthday = $db->real_escape_string($birthday);
	$date = $db->real_escape_string($date);
	$related = $db->real_escape_string($related);
	$socialProfile = $db->real_escape_string($socialProfile);
	$instantMessage = $db->real_escape_string($instantMessage);
			
	$query = "UPDATE `contact` SET `ContactID`='".$contactID."'".",`FirstName`='".$firstName."'".",`LastName`='".$lastName."'".",`Company`='".$company."'".",`Phone`='".$phone."'".",`Email`='".$email."'".",`Url`='".$url."'".",`Address`='".$address."'".",`Birthday`='".$birthday."'".",`Date`='".$date."'".",`Related`='".$related."'".",`SocialProfile`='".$socialProfile."'".",`InstantMessage`='".$instantMessage."'"." WHERE `ContactID` = '".$contactID."'";
	$result = $db->query($query);
	if($result)
		echo "Edited Sucessfully";
	else
		throw new UnexpectedValueException('Query result has a error');
}
catch (Exception $e)
{
	echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
	exit;
}
?>
</body>
</html>