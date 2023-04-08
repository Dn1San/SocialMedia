<?php
    if (isset($_POST["submit"])) {
        // Grabbing data
        $picture = $_POST["userpost"];
        $description = $_POST["postdescription"];
        $message = "Your post has been posted and is now under review.";

        // Instantiate UserProfile class
        include "../classes/dbh.classes.php";
        include "../classes/post.classes.php";
        include "../classes/notification.classes.php";
        $post = new Post();
        $notification = new Notifications();

        // Running error handlers and user profile
        $post->setPostDescription($description);
        $post->savePost();
        $notification->sendNotification($_SESSION['userid'], $message);

        // Logging into profile page
        header("location: ../myProfile.php?error=none");
    }
?>