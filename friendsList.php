<?php
    session_start();

    include "includes/friendsList.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || *username* Friends List</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/profile.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/friends.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter"/>
    <style>
      #logo h1{
        font-family: Inter;
        font-weight: 700;
        font-size: 60px;
        font-style: italic;
      }
    </style>
    <script src="js/main.js"></script>
</head>
<body>
    <?php
        include("includes/header.inc.php");
    ?>
    <main class="friendlist">
        <h2>Friends List</h2>
        <div>
            <span><?php echo $getReqNum; ?> :requests</span>
            <?php
                if($getReqNum > 0){
                    foreach($getReqNoti as $row){
                        $getFriendProfileImage = $friend->getFriendProfileImage($row->users_id);
                        echo '<div class="profile">
                                <div class="user"><img src="'.$getFriendProfileImage.'" alt="Profile image"></div>
                                <div><span>'.$row->users_username.'</span>
                                <span class="viewprofile"><a href="userProfile.php?id='.$row->request_sender.'">View profile</a></span></div>
                                <form method="post">
                                    <button name="addfriend" id="add_friend">Accept</button>
                                    <button name="ignorefriend" id="remove_friend">Reject</button>
                                </form>
                            </div>';
                        if(array_key_exists('addfriend', $_POST)) {
                            $notification->sendNotification($_SESSION['userid'], "You and ".$row->users_username." are now friends.");
                            $notification->sendNotification($row->users_id, "You and ".$_SESSION['userusername']." are now friends.");
                            $friend->makeFriends($_SESSION['userid'], $row->request_sender);
                        }
                        if(array_key_exists('ignorefriend', $_POST)) {
                            $notification->sendNotification($_SESSION['userid'], "You have ignored ".$row->users_username."'s friend request.");
                            $friend->cancelOrIgnoreFriendRequest($_SESSION['userid'], $row->request_sender);
                        }
                    }
                }
                else{
                    echo '<h4>You have no friend requests!</h4>';
                }
            ?>
            <span><?php echo $getFrndNum; ?> :friends</span>
            <?php
                if($getFrndNum > 0){
                    foreach($getAllFriends as $row){
                        $getFriendProfileImage = $friend->getFriendProfileImage($row->users_id);
                        echo '<div class="profile">
                                <div class="user"><img src="'.$getFriendProfileImage.'" alt="Profile image"></div>
                                <div><span>'.$row->users_username.'</span>
                                <span class="viewprofile"><a href="userProfile.php?id='.$row->users_id.'">View profile</a></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>You have no friends!</h4>';
                }
            ?>
        </div>
    </main>
    <?php
        include("includes/footer.inc.php");
    ?>
</body>
</html>