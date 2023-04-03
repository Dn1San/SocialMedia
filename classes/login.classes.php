<?php

    class Login extends Dbh{

        protected function getUser($username, $password) {
            $stmt = $this->connect()->prepare('SELECT users_password FROM users WHERE users_username = ? OR users_email = ?;');

            if(!$stmt->execute(array($username, $Password))) {
                $stmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../login.php?error=usernotfound");
                exit();
            }

            $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkPassword = password_verify($password, $passwordHashed[0]["users_password"]); 

            if($checkPassword == false){
                $stmt = null;
                header("location: ../login.php?error=wrongpassword");
                exit();
            }
            elseif($checkPassword == true){
                $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_username = ? OR users_email = ? AND users_password = ?;');

                if(!$stmt->execute(array($username, $username, $Password))) {
                    $stmt = null;
                    header("location: ../login.php?error=stmtfailed");
                    exit();
                }

                if($stmt->rowCount() == 0){
                    $stmt = null;
                    header("location: ../login.php?error=usernotfound");
                    exit();
                }

                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION["userid"] = $user[0]["users_id"];
                $_SESSION["userusername"] = $user[0]["users_username"];

                $stmt = null;
            }

            $stmt = null;
        }

        protected function checkUser($username, $email) {
            $stmt = $this->connect()->prepare('SELECT users_username FROM users WHERE users_username = ? OR users_email = ?;');

            if(!$stmt->execute(array($username, $email))) {
                $stmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
            }

            $resultCheck;
            if($stmt->rowCount() > 0) {
                $resultCheck = false;
            }
            else{
                $resultCheck = true;
            }

            return $resultCheck;
        }

        public function checkIfUserIsAdmin(){
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_id=?');

            if(!$stmt->execute(array($_SESSION['userid']))) {
                $stmt = null;
                header("location: ../friendsList.php?error=stmtfailed");
                exit();
            }
            
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if($user->users_role === 'user'){
                return false;
            }else if($user->users_role === 'admin'){
                return true;
            }
        }

    }
?>