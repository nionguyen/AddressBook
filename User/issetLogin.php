<html>
<head>
</head>
<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';

try {
    $cookie = new Cookie();
    $cookie->validate();
    $userID = $cookie->userid;
} catch (AuthException $e) {
    header("Location: http://localhost/AddressBook/user/login.php?originating_uri=".$_SERVER['REQUEST_URI']);
    exit;
}

?>
<head>
</body>
</html>