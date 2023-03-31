<?php
    session_start();

    include "includes/search.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>
    <div>
        <?php
            include("includes/header.inc.php");
        ?>
        <main class="friendlist">
            <h2>Search</h2>
            <div class="usercontainer">
                <?php
                    if($all_users){
                        foreach($all_users as $row){
                            echo '<div class="profile">
                            <div><img src="uploads/defualtProfile.jpg" alt="Profile image"></div>
                            <div><span>'.$row->users_username.'</span>
                            <span><a href="userProfile.php?id='.$row->users_id.'">View profile</a></span>
                            </div>';
                        }
                    }else{
                        echo '<h4>User has not been found!</h4>'; 
                    }
                ?>
            </div>
        <?php
            include("includes/footer.inc.php");
        ?>
    </div>
</body>
</html>