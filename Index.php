<html>
<body>
<form>
<input type=button onClick="location.href='ListContact.php'" value="List Contact">
<input type=button onClick="location.href='AddContact.php'" value="Add Contact">
</form>
<?php
//http://stackoverflow.com/questions/11211710/how-do-i-send-data-from-one-php-file-to-another
require_once 'Config.php';
$query = "SELECT * FROM `contact` WHERE 1";
$result = $db->query($query);

$num_results = $result->num_rows;
//echo $num_results." contact<br>";
echo "All Contacts <br>";
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
	<a href="ViewContact.php?contactID=<?php echo $contactID; ?>"> <?php echo $name ?></a>
	</html> <?php
}
?>
</body>
</html>