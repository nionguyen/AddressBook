<html>
<body>
<?php
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

require 'Config.php';

$query = "SELECT * FROM `contact` WHERE 1";
$result = $db->query($query);

$num_results = $result->num_rows;
echo $num_results." contact<br>";

for ($i=0; $i <$num_results; $i++)
{
	echo "<br>";
	$row = $result->fetch_assoc();
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
}
?>
</body>
</html>