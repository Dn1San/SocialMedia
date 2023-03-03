<?php

    class Signup extends Dbh{

        protected function setUser($username, $fullName, $password, $email, $phoneNumber, $dateOfBirth) {
            $stmt = $this->connect()->prepare('INSERT INTO users(users_username, users_fullname, users_password, users_email, users_phone_number, users_date_of_birth) VALUES (?, ?, ?, ?, ?, ?);');

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if(!$stmt->execute(array($username, $fullName, $hashedPassword, $email, $phoneNumber, $dateOfBirth))) {
                $stmt = null;
                header("location: ../login.php?error=stmtfailed");
                exit();
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

    }
?>