<html>
<body>
<?php
require_once 'Config.php';
$contactID = $_POST["contactID"];

try
{
	$query = "DELETE FROM `contact` WHERE `ContactID` = '".$contactID."'";
	$result = $db->query($query);
	if($result)
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