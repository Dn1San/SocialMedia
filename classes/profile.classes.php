<?php
  class UserProfile extends Dbh{

    private $profilePicture;
    private $profileDescription;
  
    public function __construct() {
      $this->profilePicture = "";
      $this->profileDescription = "";
    }
  
    public function setProfilePicture($picture) {
      // get the file extension
      $extension = pathinfo($picture['name'], PATHINFO_EXTENSION);
  
      // generate a unique filename
      $filename = uniqid() . '.' . $extension;
  
      // save the file to the server
      move_uploaded_file($picture['tmp_name'], 'uploads/' . $filename);
  
      // set the profile picture path
      $this->profilePicture = 'uploads/' . $filename;
    }
  
    public function setProfileDescription($description) {
      $this->profileDescription = $description;
    }
  
    public function saveProfile($userId) {
      // save the profile data to the database
      $connection = new mysqli("localhost", "root", "", "ooplogin");
  
      // check for errors
      if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
      }
  
      // prepare the SQL statement
      $sql = "UPDATE userprofile SET userprofile_description=? WHERE id=?";
  
      // create a prepared statement
      $stmt = $connection->prepare($sql);
  
      // check for errors
      if (!$stmt) {
        die("Error: " . $connection->error);
      }
  
      // bind the parameters to the statement
      $stmt->bind_param("si", $this->profileDescription, $userId);
  
      // execute the statement
      $stmt->execute();
  
      // close the statement and the connection
      $stmt->close();
      $connection->close();
    }
  
    public function loadProfile($userId) {
      // load the user's profile data from the database
      $connection = new mysqli("localhost", "root", "", "ooplogin");
  
      // check for errors
      if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
      }
  
      // prepare the SQL statement
      $sql = "SELECT profile_picture, profile_description FROM userprofile WHERE id=?";
  
      // create a prepared statement
      $stmt = $connection->prepare($sql);
  
      // check for errors
      if (!$stmt) {
        die("Error: " . $connection->error);
      }
  
      // bind the parameter to the statement
      $stmt->bind_param("i", $userId);
  
      // execute the statement
      $stmt->execute();
  
      // bind the results to variables
      $stmt->bind_result($profilePicture, $profileDescription);
  
      // fetch the results
      if ($stmt->fetch()) {
        $this->profilePicture = $profilePicture;
        $this->profileDescription = $profileDescription;
      }
  
      // close the statement and the connection
      $stmt->close();
      $connection->close();
    }
  }
  
  // usage for later
  $userProfile = new UserProfile();
  $userProfile->loadProfile(1);
  echo "Profile picture: " . $userProfile->getProfilePicture() . "<br>";
  echo "Profile description: " . $userProfile->getProfileDescription() . "<br>";
  
?>
