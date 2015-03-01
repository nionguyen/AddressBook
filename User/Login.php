<html>
<head>
</head>
<body>
<?php
session_start();

function formLogin()
{
	echo
		'<form method="post" action="" >
		Username: 				<input type="text" name="myusername"><br><br>
		Password: 				<input type="password" name="mypassword"><br><br>
		<input type="submit" value="Login">
		</form>';
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["myusername"]) && isset($_POST["mypassword"]))
{
	$myusername				= $_POST["myusername"];
	$mypassword 			= $_POST["mypassword"];
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	if(!empty($myusername) && !empty($mypassword))
	{
		try
		{
			require_once '../Config.php';
			$query = "SELECT `UserID`, `UserName`, `Password` FROM `user` WHERE `UserName` = '".$myusername."'"." and `Password` = sha1('".$mypassword."')";
			$result = $db->query($query);
			if(!$result)
			{
				throw new UnexpectedValueException('Query result has a error');
				exit;
			}
			$num_results = $db->num_rows($result);
			if ($num_results > 0)
			{
				echo "Login Successfully!";
				$row = $db->fetch_assoc($result);		
				$_SESSION["userid"] = $row['UserID'];
				$pdf_file_path = "../Contact/index.php";
				header('Location: '.$pdf_file_path) and exit;
			}
			else
			{
				formLogin();
				if (!empty($myusername) || !empty($mypassword))
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
		if (!empty($myusername) || !empty($mypassword))
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
<head>

</body>
</html>