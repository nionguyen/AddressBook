<html>
<body>
<?php
require 'Config.php';
$contactID = $_POST["contactID"];
$query = "DELETE FROM `contact` WHERE `ContactID` = '".$contactID."'";
$result = $db->query($query);

if($result)
	echo "Deleted Sucessfully";
else 
	echo "Something Error";
?>
</body>
</html>