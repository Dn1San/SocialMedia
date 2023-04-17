<?php

    //Instantiate Friend class
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    include "classes/search.classes.php";
    include "classes/notification.classes.php";
    
    $search = new Search();
    $friend = new Friend();
    $notification = new Notifications();
    
    // Retrive all users
    $allUsers = $search->allUsers($_SESSION['userid']);
    $getNotiNum = $notification->retriveNotifications($_SESSION["userid"], false);
    
?>