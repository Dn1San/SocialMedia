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
        echo "You cannot upload files of this type!";
      }
    }
  
    public function setProfileDescription($description) {
      $this->profileDescription = $description;
    }

    public function saveProfile() {
      session_start();
      if (isset($_SESSION['userid'])){
        $this->setProfilePicture();

        $stmt = $this->connect()->prepare('SELECT * FROM userprofile WHERE user_id=?');

        if(!$stmt->execute(array($_SESSION['userid']))) {
          $stmt = null;
          header("location: ../editProfile.php?error=stmtfailed");
          exit();
        }
        $userProfile = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($stmt->rowCount() > 0){
          $delete_stmt = $this->connect()->prepare('DELETE FROM userprofile WHERE user_id=?');

          if(!$delete_stmt->execute(array($_SESSION['userid']))) {
            $delete_stmt = null;
            header("location: ../editProfile.php?error=stmtfailed");
            exit();
          }

          unlink($userProfile->post_picture);
        }

        $stmt = $this->connect()->prepare('INSERT INTO userprofile(user_id, userprofile_picture, userprofile_description) VALUES (?, ?,?)');

        if(!$stmt->execute(array($_SESSION['userid'], $this->profilePicture, $this->profileDescription))) {
          $stmt = null;
          header("location: ../editProfile.php?error=stmtfailed");
          exit();
        }

        $stmt = null;
      }
    }

    public function getUserProfile($id) {
      $stmt = $this->connect()->prepare('SELECT * FROM userprofile WHERE user_id = ?;');

      if(!$stmt->execute(array($id))) {
        $stmt = null;
        header("location: ../myProfile.php?error=stmtfailed");
        exit();
      }

      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      if ($users == null) {
        $_SESSION["userprofilepicture"] = "uploads/defualtProfile.jpg";
        $_SESSION["userprofiledescription"] = "";
      }
      else if ($users[0]["userprofile_status"] == 0){
        $_SESSION["userprofilepicture"] = $users[0]["userprofile_picture"];
        $_SESSION["userprofiledescription"] = $users[0]["userprofile_description"];
      }

      $stmt = null;
    }
  }

?>
