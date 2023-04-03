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
                            <p><?php echo $get_post_num; ?> Posts</p>
                            <p><?php echo $get_frnd_num; ?> Friends</p>
                        </div>
                        <p>User Description: <?php echo $_SESSION["userprofiledescription"]; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="profilePosts">
                <?php
                    if ($get_post_num > 0) {
                        foreach($get_all_posts as $row){
                            echo '<ul>
                                <li><img src="'.$row->post_picture.'" alt="User Post"></li>
                                <p>'.$row->post_description.'</p>
                            </ul>';
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