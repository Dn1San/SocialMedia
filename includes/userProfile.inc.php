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

    $userData = $search->find_user_by_id($_GET['id']);
    $profile->getUserProfile($_GET['id']);
    $is_already_friends = $friend->is_already_friends($_SESSION['userid'], $userData->users_id);
    $check_req_sender = $friend->am_i_the_req_sender($_SESSION['userid'], $userData->users_id);
    $check_req_sent = $friend->is_request_already_sent($_SESSION['userid'], $userData->users_id);
    $get_frnd_num = $friend->get_all_friends($userData->users_id, false);
    $get_post_num = $post->getUserPosts($userData->users_id, false);
    $get_all_posts = $post->getUserPosts($userData->users_id, true);
    
    if(array_key_exists('addfriend', $_POST)) {
        if($check_req_sent === true){
            header("location: userProfile.php?id=".$userData->users_id."&error=reqsent");
        }else{
            $notification->sendNotification($_SESSION['userid'], "Friend request has been sent to ".$userData->users_username.".");
            $notification->sendNotification($_GET['id'], "You recieved a friend request from ".$_SESSION['userusername'].".");
            $friend->make_pending_friends($_SESSION['userid'], $_GET['id']);
        }
    }
    if(array_key_exists('removefriend', $_POST)) {
        $notification->sendNotification($_SESSION['userid'], "Friend ".$userData->users_username." has been removed from your friends list.");
        $friend->delete_friends($_SESSION['userid'], $_GET['id']);
    }
    if(array_key_exists('cancelreq', $_POST)) {
        $notification->sendNotification($_SESSION['userid'], "Friend ".$userData->users_username." request has been canceled.");
        $friend->cancel_or_ignore_friend_request($_SESSION['userid'], $_GET['id']);
    }
?>