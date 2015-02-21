<html>
<body>
<?php
require 'Config.php';

@ $db = new mysqli($server, $username, $password, $dbName);

if (mysqli_connect_errno())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;
}

$query = "SELECT * FROM `contact` WHERE 1";
$result = $db->query($query);

$num_results = $result->num_rows;
echo $num_results." contact<br>";

for ($i=0; $i <$num_results; $i++)
{
	$row = $result->fetch_assoc();
	echo "<br>";
	echo "First:"				.$row['FirstName']."<br>";
	echo "Last:"				.$row['LastName']."<br>";
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
}
?>
</body>
</html>