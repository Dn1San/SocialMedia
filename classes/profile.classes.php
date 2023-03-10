<?php
  class UserProfile extends Dbh{

    private $profilePicture;
    private $profileDescription;
  
    private function setProfilePicture() {
      $file = $_FILES['profilepic'];

      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];

      $fileEXT = explode('.', $fileName);
      $fileActualEXT = strtolower(end($fileEXT));

      $allowed = array('jpg', 'jpeg', 'png');

      if(in_array($fileActualEXT, $allowed)){
        if($fileError === 0){
          if($fileSize < 1000000){
            $fileNameNew = uniqid('', true).".".$fileActualEXT;
            $fileDestination = '../uploads/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $this->profilePicture = 'uploads/' . $fileNameNew;
          }else{
            echo "File size needs to be less than 1MB!";
          }
        }else{
          echo "There was an error uploading the file!";
        }
      }else {
        echo "You cannout upload files of this type!";
      }
    }
  
    public function setProfileDescription($description) {
      $this->profileDescription = $description;
    }

    public function saveProfile() {
      session_start();
      if (isset($_SESSION['userid'])){
        $this->setProfilePicture();

        $stmt = $this->connect()->prepare('INSERT INTO userprofile(user_id, userprofile_picture, userprofile_description) VALUES (?, ?,?)');

        if(!$stmt->execute(array($_SESSION['userid'], $this->profilePicture, $this->profileDescription))) {
          $stmt = null;
          header("location: ../editProfile.php?error=stmtfailed");
          exit();
        }
      }

      $stmt = null;
    }

  }

?>
