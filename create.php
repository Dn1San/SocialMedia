<?php
    session_start();

    include "classes/dbh.classes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/create.css"/>
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
            <div class="createpost">
                <h2>Create Post</h2>
                <form class="postform" action="includes/createPost.inc.php" method="POST" enctype="multipart/form-data">
                    <label for="userpost">Upload Post: </label>
                    <input type="file" name="userpost">
                    <label for="postdescription">Post Description: </label>
                    <textarea name="postdescription"></textarea>
                    <button type="submit" name="submit">Done</button>
                </form>
            </div>
        </main>
        <?php
            include("includes/footer.inc.php");
        ?>
    </div>
</body>
</html>