<html>
<head>
</head>
<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';
$cookie = new Cookie();
$cookie->logout();
header("Location: http://localhost/AddressBook/User/Login.php");
?>
<head>

</body>
</html>