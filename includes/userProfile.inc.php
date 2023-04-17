<?php
    include "classes/dbh.classes.php";
    include "classes/profile.classes.php";
    include "classes/search.classes.php";
    include "classes/friends.classes.php";
    include "classes/post.classes.php";
    include "classes/notification.classes.php";

    $profile = new UserProfile();
    $search = new Search();
    $friend = new Friend();
    $post = new Post();
    $notification = new Notifications();

    $userData = $search->findUserById($_GET['id']);
    $profile->getUserProfile($_GET['id']);
    $isAlreadyFriends = $friend->isAlreadyFriends($_SESSION['userid'], $userData->users_id);
    $checkReqSender = $friend->amITheReqSender($_SESSION['userid'], $userData->users_id);
    $checkReqSent = $friend->isRequestAlreadySent($_SESSION['userid'], $userData->users_id);
    $getFrndNum = $friend->getAllFriends($userData->users_id, false);
    $getPostNum = $post->getUserPosts($userData->users_id, false);
    $getAllPosts = $post->getUserPosts($userData->users_id, true);
    $getNotiNum = $notification->retriveNotifications($_SESSION["userid"], false);
    
    if(array_key_exists('addfriend', $_POST)) {
        if($checkReqSent === true){
            header("location: userProfile.php?id=".$userData->users_id."&error=reqsent");
        }else{
            $notification->sendNotification($_SESSION['userid'], "Friend request has been sent to ".$userData->users_username.".");
            $notification->sendNotification($_GET['id'], "You recieved a friend request from ".$_SESSION['userusername'].".");
            $friend->makePendingFriends($_SESSION['userid'], $_GET['id']);
        }
    }
    if(array_key_exists('removefriend', $_POST)) {
        $notification->sendNotification($_SESSION['userid'], "Friend ".$userData->users_username." has been removed from your friends list.");
        $friend->deleteFriends($_SESSION['userid'], $_GET['id']);
    }
    if(array_key_exists('cancelreq', $_POST)) {
        $notification->sendNotification($_SESSION['userid'], "Friend ".$userData->users_username." request has been canceled.");
        $friend->cancelOrIgnoreFriendRequest($_SESSION['userid'], $_GET['id']);
    }
?>