<?php
    include "classes/dbh.classes.php";
    include "classes/notification.classes.php";

    $notification = new Notifications;

    $getNotiNum = $notification->retriveNotifications($_SESSION['userid'], false);
    $getAllNotis = $notification->retriveNotifications($_SESSION['userid'], true);
?>