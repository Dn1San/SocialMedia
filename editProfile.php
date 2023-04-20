<?php
    session_start();

    include("classes/dbh.classes.php");
    include "classes/notification.classes.php";

    $notification= new Notifications();

    $getNotiNum = $notification->retriveNotifications($_SESSION["userid"], false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/edit.css"/>
    <script src="js/main.js"></script>
</head>
<body>
    <div>
        <?php
            include("includes/header.inc.php");
        ?>
        <main>
            <div class="editprofile">
                <h2>Edit Profile</h2>
                <form class="profileform" action="includes/changeProfile.inc.php" method="POST" enctype="multipart/form-data">
                    <label for="profilepic">Upload profile picture</label>
                    <input type="file" name="profilepic" required>
                    <label for="description">Profile Description</label>
                    <textarea name="description" maxlength="250"></textarea>
                    <button type="submit" name="submit">Done</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>