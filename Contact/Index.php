<html>
<body>
<form>
<input type=button onClick="location.href='ListContact.php'" value="List Contact">
<input type=button onClick="location.href='AddContact.php'" value="Add Contact">
</form>
<?php
//http://stackoverflow.com/questions/11211710/how-do-i-send-data-from-one-php-file-to-another
require_once '../Config.php';
try
{
	$query = "SELECT * FROM `contact` WHERE 1";
	$result = $db->query($query);
	if(!$result){
		throw new UnexpectedValueException('Query result has a error');
	}
	
	$num_results = $result->num_rows;
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
}
catch (Exception $e)
{
	echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
	exit;
}
?>
</body>
</html>