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
    $get_req_num = $friend->request_notification($_SESSION['userid'], false);
    // Retrieve total friends
    $get_frnd_num = $friend->get_all_friends($_SESSION['userid'], false);
    // Retrieve total friend requests
    $get_req_num = $friend->request_notification($_SESSION['userid'], false);
    // Retrive request notification
    $get_req_noti = $friend->request_notification($_SESSION['userid'], true);
    // Retrive all friends
    $get_all_friends = $friend->get_all_friends($_SESSION['userid'], true);
?>