<?php
    session_start();

    include "includes/notifications.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/notification.css"/>
    <script src="js/main.js"></script>
</head>
<body>
    <?php
        include("includes/header.inc.php");
    ?>
    <main>
        <h2>Notifications</h2>
        <div class="notifications">
            <ul>
                <?php
                    if ($getNotiNum > 0) {
                        foreach($getAllNotis as $row){
                            echo '<li>'.$row->noti_message.'</li>';
                        }
                    }else{
                        echo 'No notifications!';
                    }
                ?>
            </ul>
        </div>
    </main>
    <?php
        include("includes/footer.inc.php");
    ?>
</body>
</html>