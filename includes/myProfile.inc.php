<?php
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    include "classes/profile.classes.php";
    include "classes/post.classes.php";

    $friend = new Friend();
    $profile = new UserProfile();
    $post = new Post();

    $profile->getUserProfile($_SESSION['userid']);
    $getFrndNum = $friend->getAllFriends($_SESSION['userid'], false);
    $getPostNum = $post->getUserPosts($_SESSION['userid'], false);
    $getAllPosts = $post->getUserPosts($_SESSION['userid'], true);
?>