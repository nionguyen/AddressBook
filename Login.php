<html>
<head>
</head>
<body>
<?php

function formLogin()
{
	echo
		'<form method="post" action="" >
		Username: 				<input type="text" name="user_root"><br><br>
		Password: 				<input type="text" name="pass_root"><br><br>
		<input type="submit" value="Login">
		</form>';
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
			$query = "select count(*) from user where UserName = '".$user_root."' and Password = sha1('".$pass_root."')";
			$result = $db->query($query);
			if(!$result)
			{
				throw new UnexpectedValueException('Query result has a error');
				exit;
			}
			$row = mysqli_fetch_row($result);
			$count = $row[0];
			if ($count > 0)
			{
				echo "Login Successfully!";
			}
			else
			{
				formLogin();
				if (!empty($user_root) || !empty($pass_root))
				{
					echo "Login fail";
				}
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
		formLogin();
		if (!empty($user_root) || !empty($pass_root))
		{
			echo "Login fail";
		}
	}
}
else
{
	formLogin();
}
?>


</body>
</html>