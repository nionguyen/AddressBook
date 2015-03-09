<html>
<head>
</head>
<body>
<a href="http://localhost/AddressBook/User/Register.php"> Register</a>
<?php

function formLogin() {
    echo
        '<form method="post" action="" >
        Username:               <input type="text" name="myusername"><br><br>
        Password:               <input type="password" name="mypassword"><br><br>
        <input type="submit" value="Login">
        </form>';
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["myusername"]) && isset($_POST["mypassword"])) {
    $myusername = $_POST["myusername"];
    $mypassword = $_POST["mypassword"];
    $uri = $_REQUEST['originating_uri'];

    if(!empty($myusername) && !empty($mypassword)) {
        try {
            require_once '../Config.php';
            
    
            $query = "SELECT `userID`,
                             `username`,
                             `password` 
                      FROM `user`
                      WHERE `username` = ? 
                      AND `password` = sha1(?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param("ss", $myusername, $mypassword);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            
            $numResults = $result->num_rows();
            if ($numResults > 0) {
                echo 'Login Successfully!';
                
                $row = $result->fetch_assoc();                      
                $userid = $row['userID'];
                $cookie = new Cookie($userid);
                $cookie->set();
                
                if(empty($uri))
                {
                    header("Location: http://localhost/AddressBook/Contact/index.php");
                }
                else
                {
                    $filePath = 'http://localhost'.$uri;
                    header('Location: '.$filePath) and exit;
                }
                
            } else {
                formLogin();
                if (!empty($myusername) || !empty($mypassword)) {
                    echo 'Login fail';
                }
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
        formLogin();
        if (!empty($myusername) || !empty($mypassword)) {
            echo "Login fail";
        }
    }
} else {
    formLogin();
}
?>
<head>
</body>
</html>