<html>
<body>
<?php
require 'Config.php';

$contactID = $_POST["contactID"];

@ $db = new mysqli($server, $username, $password, $dbName);

if (mysqli_connect_errno())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}

$query = "SELECT `ContactID`, `FirstName`, `LastName`, `Company`, `Phone`, `Email`, `Url`, `Address`, `Birthday`, `Date`, `Related`, `SocialProfile`, `InstantMessage` FROM `contact` WHERE `ContactID` = '".$contactID."'";
$result = $db->query($query);
$row = $result->fetch_assoc();
?>
<form action="EditComplete.php" method="post">
FirstName: 			<input type="text" value="<?php echo $row['FirstName']; ?>" 	 name="firstName"><br>
LastName: 			<input type="text" value="<?php echo $row['LastName']; ?>" 		 name="lastName"><br>
Company: 			<input type="text" value="<?php echo $row['Company']; ?>" 		 name="company"><br>
Phone: 				<input type="text" value="<?php echo $row['Phone']; ?>" 		 name="phone"><br>
Email: 				<input type="text" value="<?php echo $row['Email']; ?>" 		 name="email"><br>
Url: 				<input type="text" value="<?php echo $row['Url']; ?>" 			 name="url"><br>
Address: 			<input type="text" value="<?php echo $row['Address']; ?>" 		 name="address"><br>
Birthday: 			<input type="text" value="<?php echo $row['Birthday']; ?>" 		 name="birthday"><br>
Date: 				<input type="text" value="<?php echo $row['Date']; ?>" 			 name="date"><br>
Related: 			<input type="text" value="<?php echo $row['Related']; ?>" 		 name="related"><br>
Social Profile: 	<input type="text" value="<?php echo $row['SocialProfile']; ?>"  name="socialProfile"><br>
Instant Message : 	<input type="text" value="<?php echo $row['InstantMessage']; ?>" name="instantMessage"><br>
<input type="hidden" name="contactID"  value="<?php echo $contactID; ?>" >
<input type="submit" value="Done">
</form>
</body>
</html>