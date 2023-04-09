<?php

    //Instantiate UserProfile class
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    include "classes/profile.classes.php";
    include "classes/notification.classes.php";

    $notification = new Notifications();
    $friend = new Friend();
    $profile = new UserProfile();

    // Retrieve total requests
    $getReqNum = $friend->requestNotification($_SESSION['userid'], false);
    // Retrieve total friends
    $getFrndNum = $friend->getAllFriends($_SESSION['userid'], false);
    // Retrieve total friend requests
    $getReqNum = $friend->requestNotification($_SESSION['userid'], false);
    // Retrive request notification
    $getReqNoti = $friend->requestNotification($_SESSION['userid'], true);
    // Retrive all friends
    $getAllFriends = $friend->getAllFriends($_SESSION['userid'], true);
?>