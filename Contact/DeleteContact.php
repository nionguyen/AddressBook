<html>
<body>
<?php
//SET FOREIGN_KEY_CHECKS=0;
//SET FOREIGN_KEY_CHECKS=1;
require_once '../User/issetLogin.php';
require_once '../Config.php';

$contactID = isset($_POST['contactID']) ? (int)$_POST['contactID'] : false;
$contactID = str_replace('/[^0-9]/', '', $contactID);
try
{
	$query1 = "DELETE FROM `contact_user` WHERE `ContactID` = ? and `UserID` = ?";
	$stmt = $db->prepare($query1);
	$stmt->bind_param("ii", $contactID, $userid);
	$result1 = $stmt->execute();
	$stmt->close();
	
	$query2 = "DELETE FROM `contact` WHERE `ContactID` = ?";
	$stmt = $db->prepare($query2);
	$stmt->bind_param("i", $contactID);
	$result2 = $stmt->execute();
	$stmt->close();
	
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