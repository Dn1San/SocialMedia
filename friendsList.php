<?php
    session_start();

    // TOTAL REQUESTS
    $get_req_num = $frnd_obj->request_notification($_SESSION['user_id'], false);
    // TOTLA FRIENDS
    $get_frnd_num = $frnd_obj->get_all_friends($_SESSION['user_id'], false);
    // GET MY($_SESSION['user_id']) ALL FRIENDS
    $get_all_friends = $frnd_obj->get_all_friends($_SESSION['user_id'], true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || *username* Friends List</title>
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
        <main class="friendlist">
            <h2>Friends List</h2>
            <span>? :friends</span>
            <div class="usercontainer">
            <?php
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="profile_images/'.$row->user_image.'" alt="Profile image"></div>
                                <div class="user_info"><span>'.$row->username.'</span>
                                <span><a href="user_profile.php?id='.$row->id.'" class="see_profileBtn">See profile</a></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>You have no friends!</h4>';
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