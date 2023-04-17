<?php
    include "classes/dbh.classes.php";
    include "classes/admin.classes.php";
    include "classes/notification.classes.php";

    $notification = new Notifications();
    $admin = new Admin();

    $getPostNum = $admin->reviewPosts(false);
    $reviewPosts = $admin->reviewPosts(true);
    $getNotiNum = $notification->retriveNotifications($_SESSION["userid"], false);
?>