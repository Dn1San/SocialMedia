<?php
    if (isset($_POST["submit"])) {
        // Grabbing data
        $picture = $_POST["profilepic"];
        $description = $_POST["description"];

        // Instantiate SignupContr class
        include "../classes/dbh.classes.php";
        include "../classes/profile.classes.php";
        $profile = new UserProfile($picture, $description);

        // Running error handlers and user signup
        $profile->setProfilePicture();
        $profile->setProfileDescription();
        $profile->saveProfile();

        // Logging into profile page
        header("location: ../profile.php?error=none");
    }
?>