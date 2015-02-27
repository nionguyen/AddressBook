<html>
<body>
<?php
require_once '../Config.php';
$contactID = $_POST["contactID"];

try
{
	$query = "SELECT `ContactID`, `FirstName`, `LastName`, `Company`, `Phone`, `Email`, `Url`, `Address`, `Birthday`, `Date`, `Related`, `SocialProfile`, `InstantMessage` FROM `contact` WHERE `ContactID` = '".$contactID."'";
	$result = $db->query($query);
	if(!$result){
		throw new UnexpectedValueException('Query result has a error');
	}
	$row = $result->fetch_assoc();
}
catch (Exception $e)
{
	echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
	exit;
}
?>
<form action="EditComplete.php" method="post">
First: 				<input type="text" value="<?php echo $row['FirstName']; ?>" 	 name="firstName"><br><br>
Last: 				<input type="text" value="<?php echo $row['LastName']; ?>" 		 name="lastName"><br><br>
Company: 			<input type="text" value="<?php echo $row['Company']; ?>" 		 name="company"><br><br>
Phone: 				<input type="text" value="<?php echo $row['Phone']; ?>" 		 name="phone"><br><br>
Email: 				<input type="text" value="<?php echo $row['Email']; ?>" 		 name="email"><br><br>
Url: 				<input type="text" value="<?php echo $row['Url']; ?>" 			 name="url"><br><br>
Address: 			<input type="text" value="<?php echo $row['Address']; ?>" 		 name="address"><br><br>
Birthday: 			<input type="text" value="<?php echo $row['Birthday']; ?>" 		 name="birthday"><br><br>
Date: 				<input type="text" value="<?php echo $row['Date']; ?>" 			 name="date"><br><br>
Related: 			<input type="text" value="<?php echo $row['Related']; ?>" 		 name="related"><br><br>
Social Profile: 	<input type="text" value="<?php echo $row['SocialProfile']; ?>"  name="socialProfile"><br><br>
Instant Message : 	<input type="text" value="<?php echo $row['InstantMessage']; ?>" name="instantMessage"><br><br>
<input type="hidden" name="contactID"  value="<?php echo $contactID; ?>" >
<input type="submit" value="Done">
</form>
</body>
</html>