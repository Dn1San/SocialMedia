<?php

    class SignupContr extends Signup{

        private $fullName;
        private $username;
        private $email;
        private $phoneNumber;
        private $password;
        private $dateOfBirth;

        public function __construct($fullName, $username, $email, $phoneNumber, $password, $dateOfBirth){
            $this->fullName = $fullName;
            $this->username = $username;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->password = $password;
            $this->dateOfBirth = $dateOfBirth;
        }

        public function signupUser() {
            if($this->emptyInput() == false){
                header("location: ../signup.php?error=emptyinput");
                exit();
            }
            if($this->invalidUsername() == false){
                header("location: ../signup.php?error=username");
                exit();
            }
            if($this->invalidEmail() == false){
                header("location: ../signup.php?error=email");
                exit();
            }
            if($this->usernameOrEmailTakenCheck() == false){
                header("location: ../signup.php?error=usernameoremailtaken");
                exit();
            }

            $this->setUser($this->username, $this->fullName, $this->password, $this->email, $this->phoneNumber, $this->dateOfBirth);
        }

        private function emptyInput() {
            $result;
            if(empty($this->fullName) || empty($this->username) || empty($this->email) || 
            empty($this->phoneNumber) || empty($this->password) || empty($this->dateOfBirth)) {
                $result = false;
            }
            else{
                $result = true;
            }
            return $result;
        }

        private function invalidUsername() {
            $result;
            if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
                $result = false;
            }
            else{
                $result = true;
            }
            return $result;
        }

        private function invalidEmail() {
            $result;
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $result = false;
            }
            else{
                $result = true;
            }
            return $result;
        }

        private function usernameOrEmailTakenCheck() {
            $result;
            if(!$this->checkUser($this->username, $this->email)){
                $result = false;
            }
            else{
                $result = true;
            }
            return $result;
        }

    }
?>
