<?php
    session_start();

    include "includes/search.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Search</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/profile.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/friends.css"/>
    <script src="js/main.js"></script>
</head>
<body>
    <div>
        <?php
            include("includes/header.inc.php");
        ?>
        <main class="friendlist">
            <h2>Search</h2>
            <div class="usercontainer">
                <?php
                    if($allUsers){
                        foreach($allUsers as $row){
                            $getFriendProfileImage = $friend->getFriendProfileImage($row->users_id);
                            echo '<div class="profile">
                            <div class="user"><img src="'.$getFriendProfileImage.'" alt="Profile image"></div>
                            <div><span>'.$row->users_username.'</span>
                            <span class="viewprofile"><a href="userProfile.php?id='.$row->users_id.'">View profile</a></span></div>
                            </div>';
                        }
                    }else{
                        echo '<h4>User has not been found!</h4>'; 
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