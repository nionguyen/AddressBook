<html>
<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/user/issetLogin.php';
require_once '../Config.php';

function writeString($string,$value) {
    if($value) {
        echo $string.":".$value."<br>";
    }
}

$contactID = $_GET["contactID"];

try
{
    $query = "SELECT *
              FROM `contact_user`
              WHERE `ContactID` = ?
              AND `userID` = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $contactID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if($result->num_rows() == 0) {
        echo "You don't have permission to view this contact";
        exit;
    }
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

try
{
    $query = "SELECT `ContactID`,
                     `firstName`,
                     `lastName`,
                     `company`,
                     `phone`,
                     `email`,
                     `url`,
                     `address`,
                     `birthday`,
                     `date`,
                     `related`,
                     `socialProfile`,
                     `instantMessage`
              FROM `contact`
              WHERE `ContactID` = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $contactID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if(!$result) {
        throw new UnexpectedValueException('Query result has a error');
    }
    $row = $result->fetch_assoc();
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

$firstName          = $row['firstName'];
$lastName           = $row['lastName'];
$company            = $row['company'];
$phone              = $row['phone'];
$email              = $row['email'];
$url                = $row['url'];
$address            = $row['address'];
$birthday           = $row['birthday'];
$date               = $row['date'];
$related            = $row['related'];
$socialProfile      = $row['socialProfile'];
$instantMessage     = $row['instantMessage'];

if(empty($firstName) && empty($lastName)) {
    $firstName = "#noname";
    $lastName = "#noname";
}

writeString("First",$firstName);
writeString("Last",$lastName);
writeString("Company",$company);
writeString("Phone",$phone);
writeString("Email",$email);
writeString("Url",$url);
writeString("Address",$address);
writeString("Birthday",$birthday);
writeString("Date",$date);
writeString("Related",$related);
writeString("Social Profile",$socialProfile);
writeString("Instant Message",$instantMessage);
?>

<form action="DeleteContact.php" method="post">
<input type="hidden" name="contactID" value="<?php echo $contactID; ?>" >
<input type="submit" value="Delete">
</form>

<form action="EditContact.php" method="post">
<input type="hidden" name="contactID" value="<?php echo $contactID; ?>" >
<input type="submit" value="Edit">
</form>

</body>
</html>