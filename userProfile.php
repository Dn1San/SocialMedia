<?php
    session_start();

    include "includes/userProfile.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || *username* Profile</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/profile.css"/>
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
                        <?php
                            if($isAlreadyFriends){
                                echo '<form method="post"><button name="removefriend" class="profilebtns">Remove Friend</button></form>';
                            }else if($checkReqSender){
                                echo '<form method="post"><button name="cancelreq" class="profilebtns">Cancel Request</button></form>';
                            }else{
                                echo '<form method="post"><button name="addfriend" class="profilebtns">Add Friend</button></form>';
                            }
                        ?>
                    </div>
                    <div class="description">
                        <div class="stats">
                            <p><?php echo $getPostNum; ?> Posts</p>
                            <p><?php echo $getFrndNum; ?> Friends</p>
                        </div>
                        <p>User Description: <?php echo $_SESSION["userprofiledescription"]; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="profilePosts">
                <?php
                    if ($getPostNum > 0) {
                        foreach($getAllPosts as $row){
                            echo '<div class="post"><img src="'.$row->post_picture.'" alt="User Post">
                            '.$row->post_description.'</div>';
                        }
                    }else{
                        echo 'No user posts!';
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