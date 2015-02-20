<html>
<body>
<?php
//http://stackoverflow.com/questions/11211710/how-do-i-send-data-from-one-php-file-to-another
require 'Config.php';

@ $db = new mysqli($server, $username, $password, $dbName);

if (mysqli_connect_errno())
{
	echo "Error: Could not connect to database. Please try again later.<br>";
	exit;include 'Config.php';
}

$query = "SELECT * FROM `contact` WHERE 1";
$result = $db->query($query);

$num_results = $result->num_rows;
echo $num_results." contact<br>";

for ($i=0; $i <$num_results; $i++)
{
	$row = $result->fetch_assoc();
	echo "<br>";
	$name = $row['FirstName']." ".$row['LastName'];
	if(empty($row['FirstName']) && empty($row['LastName']))
	{
		$name = "#noname";
	}
	$contactID = $row['ContactID'];
	?><html>
	<a href="Contact.php?contactID=<?php echo $contactID;?>"> <?php echo $name ?></a>
	</html> <?php
}
echo "<br>";
?>

<form action="ListView.php" method="post">
<input type="submit" value="View All">
</form>

<form action="AddContact.html" method="post">
<input type="submit" value="Add Contact">
</form>

</body>
</html>