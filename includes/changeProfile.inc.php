<?php
    if (isset($_POST["submit"])) {
        // Grabbing data
        $picture = $_POST["profilepic"];
        $description = $_POST["description"];
        $message = "Your profile has been updated.";

        // Instantiate UserProfile class
        include "../classes/dbh.classes.php";
        include "../classes/profile.classes.php";
        include "../classes/notification.classes.php";
        $profile = new UserProfile();
        $notification = new Notifications();

        // Running error handlers and user profile
        $profile->setProfileDescription($description);
        $profile->saveProfile();
        $notification->sendNotification($_SESSION['userid'], $message);

        // Logging into profile page
        header("location: ../myProfile.php?error=none");
    }
?>