<html>
<body>
<?php
require_once '../Config.php';
$contactID = $_POST["contactID"];

try {
    $query = "SELECT `contactID`,
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
              WHERE `contactID` = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $contactID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
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
?>
<form action="EditComplete.php" method="post">
First:              <input type="text" value="<?php echo $row['firstName']; ?>"      name="firstName"><br><br>
Last:               <input type="text" value="<?php echo $row['lastName']; ?>"       name="lastName"><br><br>
Company:            <input type="text" value="<?php echo $row['company']; ?>"        name="company"><br><br>
Phone:              <input type="text" value="<?php echo $row['phone']; ?>"          name="phone"><br><br>
Email:              <input type="text" value="<?php echo $row['email']; ?>"          name="email"><br><br>
Url:                <input type="text" value="<?php echo $row['url']; ?>"            name="url"><br><br>
Address:            <input type="text" value="<?php echo $row['address']; ?>"        name="address"><br><br>
Birthday:           <input type="text" value="<?php echo $row['birthday']; ?>"       name="birthday"><br><br>
Date:               <input type="text" value="<?php echo $row['date']; ?>"           name="date"><br><br>
Related:            <input type="text" value="<?php echo $row['related']; ?>"        name="related"><br><br>
Social Profile:     <input type="text" value="<?php echo $row['socialProfile']; ?>"  name="socialProfile"><br><br>
Instant Message :   <input type="text" value="<?php echo $row['instantMessage']; ?>" name="instantMessage"><br><br>
<input type="hidden" name="contactID"  value="<?php echo $contactID; ?>" >
<input type="submit" value="Done">
</form>
</body>
</html>