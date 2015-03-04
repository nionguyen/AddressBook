<html>
<head>
</head>
<body>
<?php
session_start();

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
            
            if(!$result) {
                throw new UnexpectedValueException('Query result has a error');
                exit;
            }
			
            $numResults = $db->num_rows($result);
            if ($numResults > 0) {
                echo 'Login Successfully!';
                $row = $db->fetch_assoc($result);       
                $_SESSION['userID'] = $row['userID'];
                $filePath = '../Contact/index.php';
                header('Location: '.$filePath) and exit;
            } else {
                formLogin();
                if (!empty($myusername) || !empty($mypassword)) {
                    echo 'Login fail';
                }
            }
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine()."<br />" ;
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