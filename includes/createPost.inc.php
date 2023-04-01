<?php
    if (isset($_POST["submit"])) {
        // Grabbing data
        $picture = $_POST["userpost"];
        $description = $_POST["postdescription"];

        // Instantiate UserProfile class
        include "../classes/dbh.classes.php";
        include "../classes/post.classes.php";
        $post = new Post();

        // Running error handlers and user profile
        $post->setPostDescription($description);
        $post->savePost();

        // Logging into profile page
        header("location: ../myProfile.php?error=none");
    }
?>