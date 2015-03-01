<html>
<body>
<?php
//SET FOREIGN_KEY_CHECKS=0;
//SET FOREIGN_KEY_CHECKS=1;
require_once '../User/issetLogin.php';
require_once '../Config.php';

$contactID = $_POST["contactID"];

try
{
	//$query = "DELETE FROM `contact_user` WHERE `ContactID` = '".$contactID."'"."and `UserID` = '".$userid."';";
	//$query .= "DELETE FROM `contact` WHERE `ContactID` = '".$contactID."'";
	//$db->multi_query($query);
	
	$query1 = "DELETE FROM `contact_user` WHERE `ContactID` = '".$contactID."'"."and `UserID` = '".$userid."';";
	$query2 = "DELETE FROM `contact` WHERE `ContactID` = '".$contactID."'";
	$result1 = $db->query($query1);
	$result2 = $db->query($query2);
	
	if($result1 && $result2)
		echo "Deleted Sucessfully";
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