<html>
<body>
<?php
//SET FOREIGN_KEY_CHECKS=0;
//SET FOREIGN_KEY_CHECKS=1;
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/user/issetLogin.php';
require_once '../Config.php';

$contactID = isset($_POST['contactID']) ? (int)$_POST['contactID'] : false;
$contactID = str_replace('/[^0-9]/', '', $contactID);

try {
    $query1 = "DELETE FROM `contact_user` 
               WHERE `contactID` = ?
               AND `userID` = ?";
    $stmt = $db->prepare($query1);
    $stmt->bind_param("ii", $contactID, $userID);
    $result1 = $stmt->execute();
    $stmt->close();
    
    $query2 = "DELETE FROM `contact` 
               WHERE `contactID` = ?";
    $stmt = $db->prepare($query2);
    $stmt->bind_param("i", $contactID);
    $result2 = $stmt->execute();
    $stmt->close();
    
    if($result1 && $result2)
        echo "Deleted Sucessfully";
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