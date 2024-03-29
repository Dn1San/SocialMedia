<?php
    session_start();

    include "includes/admin.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Admin Control</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/admin.css"/>
    <script src="js/main.js"></script>
</head>
<body>
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
        <p>Review new posts.</p>
        <?php
            if($getPostNum > 0){
                foreach ($reviewPosts as $row) {
                    echo '<div class="post">
                    <span class="userid">'.$row->user_id.'</span>
                    <div><img src="'.$row->post_picture.'" alt="Profile image"></div>
                    <span>'.$row->post_description.'</span>
                    <form method="post">
                        <button name="acceptpost" id="add_post">Accept</button>
                        <button name="rejectpost" id="reject_post">Reject</button>
                    </form>
                    </div>';
                    if(array_key_exists('acceptpost', $_POST)) {
                        $notification->sendNotification($row->user_id, "Your post has been accepted and can now be viewed on your profile.");
                        $admin->acceptPost($row->post_id);
                    }
                    if(array_key_exists('rejectpost', $_POST)) {
                        $notification->sendNotification($row->user_id, "Your post has been rejected due to inappropiate content.");
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
</body>
</html>