<?php
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    include "classes/profile.classes.php";
    include "classes/post.classes.php";
    include "classes/notification.classes.php";

    $friend = new Friend();
    $profile = new UserProfile();
    $post = new Post();
    $notification = new Notifications();

    $profile->getUserProfile($_SESSION['userid']);
    $getFrndNum = $friend->getAllFriends($_SESSION['userid'], false);
    $getPostNum = $post->getUserPosts($_SESSION['userid'], false);
    $getAllPosts = $post->getUserPosts($_SESSION['userid'], true);
    $getNotiNum = $notification->retriveNotifications($_SESSION["userid"], false);
?>