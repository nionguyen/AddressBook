<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
require_once '../User/issetLogin.php';

$phoneErr = "";
$havingErr = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../Config.php';

    $firstName          = $_POST["firstName"];
    $lastName           = $_POST["lastName"];
    $company            = $_POST["company"];
    $phone              = $_POST["phone"];
    if(!empty($phone) && preg_match("/^[0-9]+$/",$phone) != 1) {
        $phoneErr = " Phone number must be numeric";
        $havingErr = true;
    }
    $email              = $_POST["email"];
    $url                = $_POST["url"];
    $address            = $_POST["address"];
    $birthday           = $_POST["birthday"];
    $date               = $_POST["date"];
    $related            = $_POST["related"];
    $socialProfile      = $_POST["socialProfile"];
    $instantMessage     = $_POST["instantMessage"];
    
    if(!$havingErr) {
        try {
            
            $query = "INSERT INTO contact
                      VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param("sssissssssss", $firstName, $lastName,$company,$phone,$email,$url,$address,$birthday,$date,$related,$socialProfile,$instantMessage);
            $result = $stmt->execute();
            $stmt->close();
            if($result) {
                echo "Contact added successfully<br>";
                $contactID = $db->insert_id();
                
                $query = "INSERT INTO contact_user (contactID,userID)
                          VALUES (?,?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param("ii", $contactID, $userID);
                $result = $stmt->execute();
                $stmt->close();
                
                if(!$result) {
                    throw new UnexpectedValueException('Query result has a error');
                }
            } else {
                throw new UnexpectedValueException('Query result has a error');
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
    }
}


?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
First:              <input type="text" name="firstName"><br><br>
Last:               <input type="text" name="lastName"><br><br>
Company:            <input type="text" name="company"><br><br>
Phone:              <input type="text" name="phone"><span class="error"><?php echo $phoneErr;?></span><br><br>
Email:              <input type="text" name="email"><br><br>
Url:                <input type="text" name="url"><br><br>
Address:            <input type="text" name="address"><br><br>
Birthday:           <input type="text" name="birthday"><br><br>
Date:               <input type="text" name="date"><br><br>
Related:            <input type="text" name="related"><br><br>
Social Profile:     <input type="text" name="socialProfile"><br><br>
Instant Message :   <input type="text" name="instantMessage"><br><br>
<input type="submit" value="Done">
</form>

</body>
</html>