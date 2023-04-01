<?php
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    include "classes/profile.classes.php";
    include "classes/post.classes.php";

    $friend = new Friend();
    $profile = new UserProfile();
    $post = new Post();

    $profile->getUserProfile($_SESSION['userid']);
    $get_frnd_num = $friend->get_all_friends($_SESSION['userid'], false);
    $get_post_num = $post->getUserPosts($_SESSION['userid'], false);
    $get_all_posts = $post->getUserPosts($_SESSION['userid'], true);
?>