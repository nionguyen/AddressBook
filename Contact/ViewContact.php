<html>
<body>
<?php

function writeString($string,$value) {
    if($value)
	{
		echo $string.":".$value."<br>";
	}
}

require_once '../Config.php';

$contactID = $_GET["contactID"];

try
{
	$query = "SELECT `ContactID`, `FirstName`, `LastName`, `Company`, `Phone`, `Email`, `Url`, `Address`, `Birthday`, `Date`, `Related`, `SocialProfile`, `InstantMessage` FROM `contact` WHERE `ContactID` = '".$contactID."'";
	$result = $db->query($query);
	if(!$result){
		throw new UnexpectedValueException('Query result has a error');
	}
	$row = $db->fetch_assoc($result);
}
catch (Exception $e)
{
	echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
	exit;
}

$firstName			= $row['FirstName'];
$lastName 			= $row['LastName'];
$company 			= $row['Company'];
$phone 				= $row['Phone'];
$email 				= $row['Email'];
$url 				= $row['Url'];
$address 			= $row['Address'];
$birthday 			= $row['Birthday'];
$date 				= $row['Date'];
$related 			= $row['Related'];
$socialProfile 		= $row['SocialProfile'];
$instantMessage 	= $row['InstantMessage'];
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
?>

<form action="DeleteContact.php" method="post">
<input type="hidden" name="contactID" value="<?php echo $contactID; ?>" >
<input type="submit" value="Delete">
</form>

<form action="EditContact.php" method="post">
<input type="hidden" name="contactID" value="<?php echo $contactID; ?>" >
<input type="submit" value="Edit">
</form>

</body>
</html>