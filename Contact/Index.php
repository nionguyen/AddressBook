<html>
<body>
<form>
</form>
<a href="http://localhost/AddressBook/User/Logout.php"> Logout</a><br><br>

<?php

require_once '../User/issetLogin.php';
require_once '../Config.php';

echo '<input type=button onClick="location.href=\'ListContact.php\'" value="List Contact">';
echo '<input type=button onClick="location.href=\'AddContact.php\'" value="Add Contact">';

//http://stackoverflow.com/questions/11211710/how-do-i-send-data-from-one-php-file-to-another
try {
    $query = "SELECT * 
              FROM `contact_user`
              WHERE `userID` = '".$userID."'";
    $contactUsers = $db->query($query);
    if(!$contactUsers) {
        throw new UnexpectedValueException('Query contactUsers has a error');
    }
    echo "<br> All Contacts <br>";
    $ctCount = $contactUsers->num_rows();
    for ($i = 0; $i < $ctCount; $i++) {
        $contactUser = $contactUsers->fetch_assoc();
        $contactID = $contactUser['contactID'];
        
        $query = "SELECT * 
                  FROM `contact`
                  WHERE `contactID` = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $contactID);
        $stmt->execute();
        $contacts = $stmt->get_result();
        $stmt->close();
        $contact = $contacts->fetch_assoc();
        $name = $contact['firstName']." ".$contact['lastName'];
        if(empty($contact['firstName']) && empty($contact['lastName'])) {
            $name = "#noname";
        }
        $contactID = $contact['contactID'];
        
        ?><html>
        <a href="ViewContact.php?contactID=<?php echo $contactID; ?>"> <?php echo $name ?></a>
        </html><br><?php
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
?>
</body>
</html>