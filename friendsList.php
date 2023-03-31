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
    <div>
        <?php
            include("includes/header.inc.php");
        ?>
        <main class="friendlist">
            <h2>Friends List</h2>
            <span><?php echo $get_frnd_num; ?> :friends</span>
            <span><?php echo $get_req_num; ?> :requests</span>
            <div class="usercontainer">
            <?php
                if($get_req_num > 0){
                    foreach($get_req_noti as $row){
                        echo '<div class="profile">
                                <div><img src="uploads/defualtProfile.jpg" alt="Profile image"></div>
                                <div><span>'.$row->users_username.'</span>
                                <span><a href="userProfile.php?id='.$row->request_sender.'">View profile</a></div>
                                <form method="post">
                                    <button name="addfriend" id="add_friend">Accept</button>
                                    <button name="ignorefriend" id="remove_friend">Reject</button>
                                </form>
                            </div>';
                        if(array_key_exists('addfriend', $_POST)) {
                            $friend->make_friends($_SESSION['userid'], $row->request_sender);
                        }
                        if(array_key_exists('ignorefriend', $_POST)) {
                            $friend->cancel_or_ignore_friend_request($_SESSION['userid'], $row->request_sender);
                        }
                    }
                }
                else{
                    echo '<h4>You have no friend requests!</h4>';
                }
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="profile">
                                <div><img src="uploads/defualtProfile.jpg" alt="Profile image"></div>
                                <div><span>'.$row->users_username.'</span>
                                <span><a href="userProfile.php?id='.$row->users_id.'">View profile</a></div>
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
    </div>
</body>
</html>