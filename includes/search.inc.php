<?php

    //Instantiate Friend class
    include "classes/dbh.classes.php";
    include "classes/friends.classes.php";
    include "classes/search.classes.php";
    $search = new Search();
    
    // Retrive all users
    $all_users = $search->all_users($_SESSION['userid'])
?>