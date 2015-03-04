<html>
<body>
<?php
require_once '../Config.php';

$contactID          = $_POST["contactID"];
$firstName          = $_POST["firstName"];
$lastName           = $_POST["lastName"];
$company            = $_POST["company"];
$phone              = (int)$_POST["phone"];
$email              = $_POST["email"];
$url                = $_POST["url"];
$address            = $_POST["address"];
$birthday           = $_POST["birthday"];
$date               = $_POST["date"];
$related            = $_POST["related"];
$socialProfile      = $_POST["socialProfile"];
$instantMessage     = $_POST["instantMessage"];

try { 
    $query = "UPDATE `contact`
	          SET `contactID`= ?,
			      `firstName`= ?,
				  `lastName`= ?,
				  `company`= ?,
				  `phone`= ?,
				  `email`= ?,
				  `url`= ?,
				  `address`= ?,
				  `birthday`= ?,
				  `date`= ?,
				  `related`= ?,
				  `socialProfile`= ?,
				  `instantMessage`= ?
			  WHERE `contactID` = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("isssissssssssi", $contactID,$firstName,$lastName,$company,$phone,$email,$url,$address,$birthday,$date,$related,$socialProfile,$instantMessage,$contactID);
    $result = $stmt->execute();
    $stmt->close();
	
    if($result)
        echo "Edited Sucessfully";
    else
        throw new UnexpectedValueException('Query result has a error');
} catch (Exception $e) {
    echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
    exit;
}
?>
</body>
</html>