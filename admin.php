<?php
    session_start();

    include "classes/dbh.classes.php";
    include "classes/admin.classes.php";

    $admin = new Admin();

    $get_post_num = $admin->reviewPosts(false);
    $reviewPosts = $admin->reviewPosts(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Admin Control</title>
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
        <main class="admin">
            <h2>Admin</h2>
            <h4>Create New Admin</h3>
            <form action="includes/addNewAdmin.inc.php" method="post">
                <input type="text" placeholder="Username" name="username"/>
                <button class="registerbtn2" type="submit" name="submit">Set New Admin</button>
            </form>
            <h4>New Posts</h3>
            <span>Review new posts.</span>
            <?php
                if($get_post_num > 0){
                    foreach ($reviewPosts as $row) {
                        echo '<div class="profile">
                        <span>'.$row->user_id.'</span>
                        <div><img src="'.$row->post_picture.'" alt="Profile image"></div>
                        <span>'.$row->post_description.'</span>
                        <form method="post">
                            <button name="acceptpost" id="add_friend">Accept</button>
                            <button name="rejectpost" id="remove_friend">Reject</button>
                        </form>
                        </div>';
                        if(array_key_exists('acceptpost', $_POST)) {
                            $admin->acceptPost($row->post_id);
                        }
                        if(array_key_exists('rejectpost', $_POST)) {
                            $admin->rejectPost($row->post_id);
                        }
                    }
                }else{
                    echo "no current posts for review!";
                }
            ?>
        </main>
        <?php
            include("includes/footer.inc.php");
        ?>
    </div>
</body>
</html>