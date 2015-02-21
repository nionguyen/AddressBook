<html>
<body>
<?php
require 'Config.php';

$contactID = $_GET["contactID"];

@ $db = new mysqli($server, $username, $password, $dbName);

if (mysqli_connect_errno())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}

$query = "SELECT `ContactID`, `FirstName`, `LastName`, `Company`, `Phone`, `Email`, `Url`, `Address`, `Birthday`, `Date`, `Related`, `SocialProfile`, `InstantMessage` FROM `contact` WHERE `ContactID` = '".$contactID."'";
$result = $db->query($query);
$row = $result->fetch_assoc();

echo "FirstName:"			.$row['FirstName']."<br>";
echo "LastName:"			.$row['LastName']."<br>";
echo "Company:"				.$row['Company']."<br>";
echo "Phone:"				.$row['Phone']."<br>";
echo "Email:"				.$row['Email']."<br>";
echo "Url:"					.$row['Url']."<br>";
echo "Address:"				.$row['Address']."<br>";
echo "Birthday:"			.$row['Birthday']."<br>";
echo "Date:"				.$row['Date']."<br>";
echo "Related:"				.$row['Related']."<br>";
echo "Social Profile:"		.$row['SocialProfile']."<br>";
echo "Instant Message:"		.$row['InstantMessage']."<br>";
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