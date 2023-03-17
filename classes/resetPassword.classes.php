<?php
    class ResetPassword extends Dbh{
        public function resetPasswordRequest(){
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            // url will be changed when website is online and not on local host
            $url = "http://localhost/SocialMedia/resetPassword.php?selector=" . $selector . "&validator=" . bin2hex($token);
            $expires = date("U") + 1800;
            $userEmail =  $_POST["email"];

            $stmt = $this->connect()->prepare('DELETE FROM passwordreset WHERE passwordReset_email=?;');
            if(!$stmt->execute(array($userEmail))) {
                $stmt = null;
                header("location: ../forgottenPassword.php?error=stmtfailed");
                exit();
            }
            $stmt = null;

            $hashedToken = password_hash($token, PASSWORD_DEFAULT);

            $stmt = $this->connect()->prepare('INSERT INTO passwordreset (passwordReset_email, passwordReset_selector, passwordReset_token, passwordReset_expires) VALUES (?, ?, ?, ?);');
            if(!$stmt->execute(array($userEmail, $selector, $hashedToken, $expires))) {
                $stmt = null;
                header("location: ../forgottenPassword.php?error=stmtfailed");
                exit();
            }
            $stmt = null;

            $to = $userEmail;

            $subject = "Password Reset For Name Media";

            $message = "<p>We heard that you lost your Name Media password. Sorry about that! </p><p>But do not worry! You can use the following link to reset your password: </br>";
            $message .= "<a href='" . $url ."'>" . $url . "</a></p>";

            $headers = "From: NameMedia <dmozafari12@gmail.com>\r\n";
            $headers .= "Reply-To: dmozafari12@gmail.com\r\n";
            $headers .= "Content-type: text/html\r\n";

            mail($to, $subject, $message, $headers);
        }

        public function resetPassword(){
            $selector = $_POST["selector"];
            $valdidator = $_POST["validator"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["passwordconfirm"];

            if (empty($password) || empty($passwordRepeat)){
                header("Location: ../resetPassword.php?newpassword=empty");
                exit();
            }else if($password != $passwordRepeat ){
                header("Location: ../resetPassword.php?newpassword=passwordnotsame");
            }

            $currentDate = date("U");

            $stmt = $this->connect()->prepare('SELECT * FROM passwordReset WHERE passwordReset_Selector=? AND passwordReset_expires>=?;');
            if(!$stmt->execute(array($selector, $currentDate))) {
                $stmt = null;
                header("location: ../resetPassword.php?error=stmtfailed");
                exit();
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;
            if($result == null){
                echo "you need to resubmit your request.";
                exit();
            }else {
                $tokenBin = hex2bin($valdidator);
                $tokenCheck = password_verify($tokenBin, $result["passwordReset_token"]);

                if($tokenCheck === false){
                    echo "you need to resubmit your request.";
                    exit();
                }else if($tokenCheck === true){
                    $tokenEmail = $result["passwordReset_email"];

                    $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_email=?;');
                    if(!$stmt->execute(array($tokenEmail))) {
                        $stmt = null;
                        header("location: ../resetPassword.php?error=stmtfailed");
                        exit();
                    }

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $stmt = null;

                    $newPasswordHashed = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $this->connect()->prepare('UPDATE users SET users_password=? WHERE users_email=?;');
                    if(!$stmt->execute(array($newPasswordHashed, $tokenEmail))) {
                        $stmt = null;
                        header("location: ../resetPassword.php?error=stmtfailed");
                        exit();
                    }
                    $stmt=null;

                    $stmt = $this->connect()->prepare('DELETE FROM passwordReset WHERE passwordReset_email=?;');
                    if(!$stmt->execute(array($tokenEmail))) {
                        $stmt = null;
                        header("location: ../resetPassword.php?error=stmtfailed");
                        exit();
                    }
                    $stmt=null;
                }
            }
        }

    }
?>