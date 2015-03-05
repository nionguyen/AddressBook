<html>
<body>

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';

function check_auth()
{
	try {
		$cookie = new Cookie();
		$cookie->validate();
		$filePath = 'Contact/index.php';
        header('Location: '.$filePath) and exit;
	} catch (AuthException $e) {
		header("Location: /AddressBook/user/login.php?originating_uri=".$_SERVER['REQUEST_URI']);
		//header("Location: /login.php?originating_uri=".$_SERVER['REQUEST_URI']);
		exit;
	}
}

check_auth();
?>

<form>
</form>
<a href="User/Register.php">    Register</a>
<a href="User/Login.php">       Login</a>
<a href="User/Logout.php">      Logout</a>
</body>
</html>