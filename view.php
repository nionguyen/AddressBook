<html>
<body>


<?php
$firstName	= $_POST["firstName"];
$lastName 	= $_POST["lastName"];
$company 	= $_POST["company"];
$phone 		= $_POST["phone"];
$email 		= $_POST["email"];
$url 		= $_POST["url"];
$address 	= $_POST["address"];
$birthday 	= $_POST["birthday"];
$date 		= $_POST["date"];
$related 	= $_POST["related"];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$outputString = "";

function doString($value, $content,&$output)
{
	if(!empty($value))
	{
		echo $content.":".$value."<br>";
		$output .= $value."\t";
	}
	else
		$output .= "NULL"."\t";
}

doString($firstName,"First",$outputString);
doString($lastName,"Last",$outputString);
doString($company,"Company",$outputString);
doString($phone,"Phone",$outputString);
doString($email,"Email",$outputString);
doString($url,"Url",$outputString);
doString($address,"Address",$outputString);
doString($birthday,"Birthday",$outputString);
doString($date,"Date",$outputString);
doString($related,"Related",$outputString);

if(!empty($outputString))
{
	$outputString .= "\n";
}

@ $fp = fopen("$DOCUMENT_ROOT/contact.txt", 'ab');
if(!$fp)
{
	echo "Something Error!";
	exit;
}

flock($fp,LOCK_EX);
fwrite($fp,$outputString,strlen($outputString));
flock($fp,LOCK_UN);
fclose($fp);

echo "Add contact complete";
?>

</body>
</html>