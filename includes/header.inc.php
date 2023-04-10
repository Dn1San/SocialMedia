<?php
    include "classes/login.classes.php";
    include "classes/notification.classes.php";

    $login = new Login();
    $notification = new Notifications();

    $userIsAnAdmin = $login->checkIfUserIsAdmin();
    $getNotiNum = $notification->retriveNotifications($_SESSION["userid"], false);
?>
<header id="vertical-header">
    <div id="logo">
        <h1>NAME<br>MEDIA</h1>
    </div>
    <nav>
        <ul>
            <li><a href="myProfile.php">Profile</a></li>
            <li><a href="friendsList.php">Friends</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="create.php">Create</a></li>
            <li><a href="notifications.php">Notifications<span class="badge"><?php echo $getNotiNum; ?></span></a></li>
            <?php
                if($userIsAnAdmin){
                    echo '<li><a href="admin.php">Admin</a></li>';
                }
            ?>
        </ul>
        <div id="sign-out">
            <a href="includes/logout.inc.php">Sign Out</a>
        </div>
    </nav>
</header>