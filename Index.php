<html>
<body>

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/user/issetLogin.php';

$filePath = 'Contact/index.php';
header('Location: '.$filePath) and exit;
?>

<form>
</form>
<a href="User/Register.php">    Register</a>
<a href="User/Login.php">       Login</a>
<a href="User/Logout.php">      Logout</a>
</body>
</html>