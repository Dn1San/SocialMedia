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
                        <h2><?php echo $_SESSION["userusername"];?></h2>
                        <button class="editprofilebtn" onclick="window.location.href='editProfile.php'">Edit Profile <i class="fa-solid fa-gear"></i></button>
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