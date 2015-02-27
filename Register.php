<html>
<head>
</head>
<body>
<?php

function formRegister()
{
	echo
		'<form method="post" action="" >
		Username: 				<input type="text" name="user_root"><br><br>
		Password: 				<input type="text" name="pass_root"><br><br>
		<input type="submit" value="Register">
		</form>'
		;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_root"]) && isset($_POST["pass_root"]))
{
	$user_root			= $_POST["user_root"];
	$pass_root 			= $_POST["pass_root"];
	if(!empty($user_root) && !empty($pass_root))
	{

		try
		{
			require_once 'Config.php';
			$query = "insert into user values (NULL,'".$user_root."', sha1('".$pass_root."'))";
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
		if (!empty($user_root) || !empty($pass_root))
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