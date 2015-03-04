<html>
<head>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["userID"])) {
    echo "Plz login first";
    echo '
        <input type=button onClick="location.href=\'../User/Login.php\'" value="Add Contact">
    ';
    exit;
}
$userID = (int)$_SESSION["userID"];
?>
<head>
</body>
</html>