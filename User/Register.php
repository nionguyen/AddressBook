<html>
<head>
</head>
<body>
<?php

function formRegister()
{
	echo
		'<form method="post" action="" >
		Username: 				<input type="text" name="myusername"><br><br>
		Password: 				<input type="password" name="mypassword"><br><br>
		<input type="submit" value="Register">
		</form>'
		;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["myusername"]) && isset($_POST["mypassword"]))
{
	$myusername				= $_POST["myusername"];
	$mypassword 			= $_POST["mypassword"];
	//$myusername = stripslashes($myusername);
	//$mypassword = stripslashes($mypassword);
	if(!empty($myusername) && !empty($mypassword))
	{

		try
		{
			require_once '../Config.php';
			$myusername = $db->real_escape_string($myusername);
			$mypassword = $db->real_escape_string($mypassword);
			$query = "insert into user values (NULL,'".$myusername."', sha1('".$mypassword."'))";
			$result = $db->query($query);
			if($result)
			{
				echo "Register Successfully!";
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
	else
	{
		formRegister();
		if (!empty($myusername) || !empty($mypassword))
		{
			echo "Register fail";
		}
	}
}
else
{
	formRegister();
}
?>


</body>
</html>