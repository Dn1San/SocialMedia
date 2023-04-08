<?php
    session_start();

    include "classes/dbh.classes.php";
    include "classes/notification.classes.php";

    $notification = new Notifications;

    $get_noti_num = $notification->retriveNotifications($_SESSION['userid'], false);
    $get_all_notis = $notification->retriveNotifications($_SESSION['userid'], true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php
        include("includes/header.inc.php");
    ?>
    <main>
        <h2>Notifications</h2>
        <div class="notifications">
            <ul>
                <?php
                    if ($get_noti_num > 0) {
                        foreach($get_all_notis as $row){
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