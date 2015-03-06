<html>
<head>
</head>
<body>
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
            } else {
                throw new UnexpectedValueException('Query result has a error');
            }
        } catch (RuntimeException $e) {
			echo "<table border=\"1\"><tr><td>".
				 "RuntimeException: ".$e->getMessage()."<br />".
				 " in ".$e->getFile()." on line ".$e->getLine().
				 "</td></tr></table><br />" ;
			exit;
		} catch (InvalidArgumentException $e) {
			echo "<table border=\"1\"><tr><td>".
				 "InvalidArgumentException: ".$e->getMessage()."<br />".
				 " in ".$e->getFile()." on line ".$e->getLine().
				 "</td></tr></table><br />" ;
			exit;
		} catch (Exception $e) {
			echo "<table border=\"1\"><tr><td>".
				 "Exception: ".$e->getMessage()."<br />".
				 " in ".$e->getFile()." on line ".$e->getLine().
				 "</td></tr></table><br />" ;
			exit;
		}
    } else {
        formRegister();
        if (!empty($myusername) || !empty($mypassword)) {
            echo "Register fail";
        }
    }
} else {
    formRegister();
}
?>
</body>
</html>