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
} catch (RuntimeException $e) {
    $error = "RuntimeException: ".$e->getMessage()."<br />".
             " in ".$e->getFile()." on line ".$e->getLine();
    writeError($userID, $error);
    exit;
} catch (InvalidArgumentException $e) {
    $error = "InvalidArgumentException: ".$e->getMessage()."<br />".
             " in ".$e->getFile()." on line ".$e->getLine();
    writeError($userID, $error);
    exit;
} catch (Exception $e) {
    $error = "Exception: ".$e->getMessage()."<br />".
             " in ".$e->getFile()." on line ".$e->getLine();
    writeError($userID, $error);
    exit;
}
?>
</body>
</html>