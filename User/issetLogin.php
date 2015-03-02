<html>
<head>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["userid"]))
{
	echo "Plz login first";
	echo '
		<input type=button onClick="location.href=\'../User/Login.php\'" value="Add Contact">
	';
	exit;
}
$userid = (int)$_SESSION["userid"];
?>
<head>

</body>
</html>