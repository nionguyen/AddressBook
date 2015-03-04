<html>
<body>
<?php
require_once '../User/issetLogin.php';

function writeString($string,$value) {
    if($value) {
        echo $string.":".$value."<br>";
    }
}
$firstName;
$lastName;
$company;
$phone;
$email;
$url;
$address;
$birthday;
$date;
$related;
$socialProfile;
$instantMessage;

require_once '../Config.php';
try {
    $query = "SELECT * 
	          FROM `contact_user`
			  WHERE `userID` = '".$userID."'";
    $contactUsers = $db->query($query);
    if(!$contactUsers) {
        throw new UnexpectedValueException('Query contactUsers has a error');
    }
    
    $ctCount = $db->num_rows($contactUsers);
    for ($i = 0; $i < $ctCount; $i++) {
        $contactUser = $db->fetch_assoc($contactUsers);
        $contactID = $contactUser['contactID'];
		
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
        $contact = $db->fetch_assoc($result);
        
        $firstName          = $contact['firstName'];
		$lastName           = $contact['lastName'];
		$company            = $contact['company'];
		$phone              = $contact['phone'];
		$email              = $contact['email'];
		$url                = $contact['url'];
		$address            = $contact['address'];
		$birthday           = $contact['birthday'];
		$date               = $contact['date'];
		$related            = $contact['related'];
		$socialProfile      = $contact['socialProfile'];
		$instantMessage     = $contact['instantMessage'];
		
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
        echo "<br>";
    }
} catch (Exception $e) {
    echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
    exit;
}
?>
</body>
</html>