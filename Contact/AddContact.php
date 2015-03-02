<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
require_once '../User/issetLogin.php';

$phoneErr = "";
$havingErr = FALSE;
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	require_once '../Config.php';

	$firstName			= $_POST["firstName"];
	$lastName 			= $_POST["lastName"];
	$company 			= $_POST["company"];
	$phone 				= $_POST["phone"];
	if(!empty($phone) && preg_match("/^[0-9]+$/",$phone) != 1)
	{
		$phoneErr = " Phone number must be numeric";
		$havingErr = TRUE;
	}
	$email 				= $_POST["email"];
	$url 				= $_POST["url"];
	$address 			= $_POST["address"];
	$birthday 			= $_POST["birthday"];
	$date 				= $_POST["date"];
	$related 			= $_POST["related"];
	$socialProfile 		= $_POST["socialProfile"];
	$instantMessage 	= $_POST["instantMessage"];
	
	if(!$havingErr)
	{
		try
		{
			$firstName = $db->real_escape_string($firstName);
			$lastName = $db->real_escape_string($lastName);
			$company = $db->real_escape_string($company);
			$email = $db->real_escape_string($email);
			$url = $db->real_escape_string($url);
			$address = $db->real_escape_string($address);
			$birthday = $db->real_escape_string($birthday);
			$date = $db->real_escape_string($date);
			$related = $db->real_escape_string($related);
			$socialProfile = $db->real_escape_string($socialProfile);
			$instantMessage = $db->real_escape_string($instantMessage);
			
			$query = "insert into contact values (NULL,'".$firstName."', '".$lastName."', '".$company."', '".$phone."', '".$email."', '".$url."', '".$address."', '".$birthday."', '".$date."', '".$related."', '".$socialProfile."', '".$instantMessage."')";
			$result = $db->query($query);
			if($result)
			{
				echo $db->affected_rows()." contact added successfully<br>";
				$newID = $db->insert_id();
				$query = "insert into contact_user values ('".$newID."', '".$userid."')";
				$result = $db->query($query);
			}
			else
			{
				throw new UnexpectedValueException('Query result has a error');
			}
		}
		catch (Exception $e)
		{
			echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
			exit;
		}
	}
}


?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
First: 				<input type="text" name="firstName"><br><br>
Last: 				<input type="text" name="lastName"><br><br>
Company: 			<input type="text" name="company"><br><br>
Phone: 				<input type="text" name="phone"><span class="error"><?php echo $phoneErr;?></span><br><br>
Email: 				<input type="text" name="email"><br><br>
Url: 				<input type="text" name="url"><br><br>
Address: 			<input type="text" name="address"><br><br>
Birthday: 			<input type="text" name="birthday"><br><br>
Date: 				<input type="text" name="date"><br><br>
Related: 			<input type="text" name="related"><br><br>
Social Profile: 	<input type="text" name="socialProfile"><br><br>
Instant Message : 	<input type="text" name="instantMessage"><br><br>
<input type="submit" value="Done">
</form>

</body>
</html>