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
    
    $ctCount = $contactUsers->num_rows();
    for ($i = 0; $i < $ctCount; $i++) {
        $contactUser = $contactUsers->fetch_assoc();
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
        $contact = $result->fetch_assoc();
        
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
} catch (RuntimeException $e) {
    echo "<table border=\"1\"><tr><td>".
		 "RuntimeException: ".$e->getMessage()."<br />".
		 " in ".$e->getFile()." on line ".$e->getLine().
		 "</td></tr></table><br />";
    exit;
} catch (InvalidArgumentException $e) {
	echo "<table border=\"1\"><tr><td>".
		 "InvalidArgumentException: ".$e->getMessage()."<br />".
		 " in ".$e->getFile()." on line ".$e->getLine().
		 "</td></tr></table><br />";
	exit;
} catch (Exception $e) {
	echo "<table border=\"1\"><tr><td>".
		 "Exception: ".$e->getMessage()."<br />".
		 " in ".$e->getFile()." on line ".$e->getLine().
		 "</td></tr></table><br />";
	exit;
}
?>
</body>
</html>