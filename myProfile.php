<?php
    session_start();

    include "includes/myProfile.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || <?php echo $_SESSION["userusername"];?> Profile</title>
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
    <?php
        include("includes/header.inc.php");
    ?>
    <main>
        <div class="profile">
            <img src="<?php echo $_SESSION["userprofilepicture"]; ?>" alt="User Profile Image">
            <div class="details">
                <div class="profileHeader">
                    <h2><?php echo $_SESSION["userusername"];?></h2>
                    <button class="profilebtns" onclick="window.location.href='editProfile.php'">Edit Profile <i class="fa-solid fa-gear"></i></button>
                </div>
                <div class="description">
                    <div class="stats">
                        <p><?php echo $getPostNum; ?> Posts</p>
                        <p><?php echo $getFrndNum; ?> Friends</p>
                    </div>
                    <p>User Description: <?php echo $_SESSION["userprofiledescription"]; ?></p>
                </div>
            </div>
        </div>
        <div class="profileposts">
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
</body>
</html>