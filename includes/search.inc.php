<?php

    //Instantiate Friend class
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    $friend = new Friend();

    // Retrieve total requests
    $get_req_num = $friend->request_notification($_SESSION['userid'], false);
    // Retrieve total friends
    $get_frnd_num = $friend->get_all_friends($_SESSION['userid'], false);
    // Retrive all friends
    $get_all_friends = $friend->get_all_friends($_SESSION['userid'], true);
?>