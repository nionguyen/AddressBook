<html>
<body>
<?php
require_once '../User/issetLogin.php';

function writeString($string,$value) {
    if($value)
	{
		echo $string.":".$value."<br>";
	}
}
$firstName;
$lastName;
$company;
$phone;
$email;
$url;
$address;
$birthday;
$date;
$related;
$socialProfile;
$instantMessage;

require_once '../Config.php';
try
{
	$query = "SELECT * FROM `contact_user` WHERE `UserID` = '".$userid."'";
	$contactUsers = $db->query($query);
	if(!$contactUsers){
		throw new UnexpectedValueException('Query contactUsers has a error');
	}
	
	$num_ContactUsers = $db->num_rows($contactUsers);
	
	for ($i = 0; $i < $num_ContactUsers; $i++)
	{
		$contactUser = $db->fetch_assoc($contactUsers);
		$contactID = $contactUser['ContactID'];
		$query = "SELECT * FROM `contact` WHERE `ContactID` = '".$contactID."'";
		$contacts = $db->query($query);
		$contact = $db->fetch_assoc($contacts);
		
		$firstName			= $contact['FirstName'];
		$lastName 			= $contact['LastName'];
		$company 			= $contact['Company'];
		$phone 				= $contact['Phone'];
		$email 				= $contact['Email'];
		$url 				= $contact['Url'];
		$address 			= $contact['Address'];
		$birthday 			= $contact['Birthday'];
		$date 				= $contact['Date'];
		$related 			= $contact['Related'];
		$socialProfile 		= $contact['SocialProfile'];
		$instantMessage 	= $contact['InstantMessage'];
		if(empty($firstName) && empty($lastName))
		{
			$firstName = "#noname";
			$lastName = "#noname";
		}
		writeString("First",$firstName);
		writeString("Last",$lastName);
		writeString("Company",$company);
		writeString("Phone",$phone);
		writeString("Email",$email);
		writeString("Url",$url);
		writeString("Address",$address);
		writeString("Birthday",$birthday);
		writeString("Date",$date);
		writeString("Related",$related);
		writeString("Social Profile",$socialProfile);
		writeString("Instant Message",$instantMessage);
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