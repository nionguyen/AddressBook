<html>
<body>
<form>
</form>
<?php
require_once '../User/issetLogin.php';
echo '<input type=button onClick="location.href=\'ListContact.php\'" value="List Contact">';
echo '<input type=button onClick="location.href=\'AddContact.php\'" value="Add Contact">';

//http://stackoverflow.com/questions/11211710/how-do-i-send-data-from-one-php-file-to-another
require_once '../Config.php';
try
{
	$query = "SELECT * FROM `contact_user` WHERE `UserID` = '".$userid."'";
	$contactUsers = $db->query($query);
	if(!$contactUsers){
		throw new UnexpectedValueException('Query contactUsers has a error');
	}
	
	$num_ContactUsers = $db->num_rows($contactUsers);
	echo "<br> All Contacts <br>";
	for ($i = 0; $i < $num_ContactUsers; $i++)
	{
		$contactUser = $db->fetch_assoc($contactUsers);
		$contactID = $contactUser['ContactID'];
		
		$query = "SELECT * FROM `contact` WHERE `ContactID` = ?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("i", $contactID);
		$stmt->execute();
		$contacts = $stmt->get_result();
		$stmt->close();
		$contact = $db->fetch_assoc($contacts);
		
		$name = $contact['FirstName']." ".$contact['LastName'];
		if(empty($contact['FirstName']) && empty($contact['LastName']))
		{
			$name = "#noname";
		}
		$contactID = $contact['ContactID'];
		?><html>
		<a href="ViewContact.php?contactID=<?php echo $contactID; ?>"> <?php echo $name ?></a>
		</html> <?php
		echo "<br>";
	}
}
catch (Exception $e)
{
	echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
	exit;
}
?>
</body>
</html>