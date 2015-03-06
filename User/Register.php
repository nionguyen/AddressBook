<html>
<head>
</head>
<body>
<a href="http://localhost/AddressBook/User/Login.php"> Login</a>
<?php

function formRegister() {
    echo
        '<form method="post" action="" >
        Username:               <input type="text" name="myusername"><br><br>
        Password:               <input type="password" name="mypassword"><br><br>
        <input type="submit" value="Register">
        </form>'
        ;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["myusername"]) && isset($_POST["mypassword"])) {
    $myusername = $_POST["myusername"];
    $mypassword = $_POST["mypassword"];
    if(!empty($myusername) && !empty($mypassword)) {
        try {
            require_once '../Config.php';
            
            $query = "SELECT * 
                      FROM `user`
                      WHERE `username` = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $myusername);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows() > 0) {
                echo "This account already registered";
                formRegister();
                exit;
            }
            $stmt->close();
            
            $query = "INSERT INTO user (userID,
                                        username,
                                        password) 
                      VALUES (null, ? , sha1(?) )";
            $stmt = $db->prepare($query);
            $stmt->bind_param("ss", $myusername, $mypassword);
            $result = $stmt->execute();
            $stmt->close();
            
            if($result) {
                echo "Register Successfully!";
                header("Location: http://localhost/AddressBook/User/Login.php");
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
    } else {
        if (!empty($myusername) || !empty($mypassword)) {
            echo "Register fail";
        }
        formRegister();
    }
} else {
    formRegister();
}
?>
</body>
</html>