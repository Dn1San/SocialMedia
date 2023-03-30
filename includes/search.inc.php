<?php

    //Instantiate Friend class
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    include "classes/search.classes.php";
    $friend = new Friend();
    $search = new Search();

    // Retrieve total requests
    $get_req_num = $friend->request_notification($_SESSION['userid'], false);
    // Retrieve total friends
    $get_frnd_num = $friend->get_all_friends($_SESSION['userid'], false);
    // Retrive all friends
    $get_all_friends = $friend->get_all_friends($_SESSION['userid'], true);
    // Retrive all users
    $all_users = $search->all_users($_SESSION['userid'])
?>