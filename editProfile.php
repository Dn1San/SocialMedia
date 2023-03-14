<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Edit Profile</title>
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
                    <input type="file" name="profilepic">
                    <label for="description">Profile Description</label>
                    <textarea name="description"></textarea>
                    <button type="submit" name="submit">Done</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>