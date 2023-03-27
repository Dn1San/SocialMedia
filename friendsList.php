<?php
    session_start();

    include "includes/friendsList.inc.php";
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
            <span><?php echo $get_frnd_num; ?> :friends</span>
            <div class="usercontainer">
            <?php
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="uploads/'.$row->userprofile_picture.'" alt="Profile image"></div>
                                <div class="user_info"><span>'.$row->users_username.'</span>
                                <span><a href="user_profile.php?id='.$row->users_id.'" class="see_profileBtn">View profile</a></div>
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