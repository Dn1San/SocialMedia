<?php
    if (isset($_POST["submit"])) {
        // Grabbing data
        $picture = $_POST["profilepic"];
        $description = $_POST["description"];

        // Instantiate UserProfile class
        include "../classes/dbh.classes.php";
        include "../classes/profile.classes.php";
        $profile = new UserProfile();

        // Running error handlers and user profile
        $profile->setProfileDescription($description);
        $profile->saveProfile();

        // Logging into profile page
        header("location: ../myProfile.php?error=none");
    }
?>