<?php
    session_start();

    include "classes/dbh.classes.php";
    include "classes/profile.classes.php";
    include "classes/search.classes.php";
    include "classes/friends.classes.php";
    $profile = new UserProfile();
    $search = new Search();
    $friend = new Friend();

    $userData = $search->find_user_by_id($_GET['id']);
    $profile->getUserProfile($_GET['id']);
    $is_already_friends = $friend->is_already_friends($_SESSION['userid'], $userData->users_id);
    $check_req_sender = $friend->am_i_the_req_sender($_SESSION['userid'], $userData->users_id);
    $check_req_sent = $friend->is_request_already_sent($_SESSION['userid'], $userData->users_id);
    if(array_key_exists('addfriend', $_POST)) {
        if($check_req_sent === true){
            header("location: userProfile.php?id=".$userData->users_id."&error=reqsent");
        }else{
            $friend->make_pending_friends($_SESSION['userid'], $_GET['id']);
        }
    }
    if(array_key_exists('removefriend', $_POST)) {
        $friend->delete_friends($_SESSION['userid'], $_GET['id']);
    }
    if(array_key_exists('cancelreq', $_POST)) {
        $friend->cancel_or_ignore_friend_request($_SESSION['userid'], $_GET['id']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || *username* Profile</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
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
    <script src="https://kit.fontawesome.com/2bd3308741.js" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        <?php
            include("includes/header.inc.php");
        ?>
        <main>
            <div class="profile">
                <img src="<?php echo $_SESSION["userprofilepicture"]; ?>" alt="User Profile Image">
                <div class="details">
                    <div class="profileHeader">
                        <h2><?php echo $userData->users_username;?></h2>
                        <button class="editprofilebtn" onclick="window.location.href='editProfile.php'">Edit Profile <i class="fa-solid fa-gear"></i></button>
                        <?php
                            if($is_already_friends){
                                echo '<form method="post"><button name="removefriend">Remove Friend</button></form>';
                            }else if($check_req_sender){
                                echo '<form method="post"><button name="cancelreq">Cancel Request</button></form>';
                            }else{
                                echo '<form method="post"><button name="addfriend">Add Friend</button></form>';
                            }
                        ?>
                    </div>
                    <div class="description">
                        <div class="stats">
                            <p>15 Posts</p>
                            <p>24 Friends</p>
                        </div>
                        <p>User Description: <?php echo $_SESSION["userprofiledescription"]; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="profilePosts">
                <ul>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                </ul>
            </div>
        </main>
        <?php
            include("includes/footer.inc.php");
        ?>
    </div>
</body>
</html>