<html>
<body>


<?php
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$listview= file("$DOCUMENT_ROOT/contact.txt");
$number_of_listview = count($listview);
if($number_of_listview == 0)
{
	echo "No Contact";
	exit;
}

for($i = 0; $i < $number_of_listview; $i++)
{	
	$line = explode("\t",$listview[$i]);
	if(strcmp($line[0],"NULL"))
		echo "First:".$line[0]."<br>";
	if(strcmp($line[1],"NULL"))
		echo "Last:".$line[1]."<br>";
	if(strcmp($line[2],"NULL"))
		echo "Company:".$line[2]."<br>";
	if(strcmp($line[3],"NULL"))
		echo "Phone:".$line[3]."<br>";
	if(strcmp($line[4],"NULL"))
		echo "Email:".$line[4]."<br>";
	if(strcmp($line[5],"NULL"))
		echo "Url:".$line[5]."<br>";
	if(strcmp($line[6],"NULL"))
		echo "Address:".$line[6]."<br>";
	if(strcmp($line[7],"NULL"))
		echo "Birthday:".$line[7]."<br>";
	if(strcmp($line[8],"NULL"))
		echo "Date:".$line[8]."<br>";
	if(strcmp($line[9],"NULL"))
		echo "Related:".$line[9]."<br>";
	echo "<br/>";
}

?>


</body>
</html>