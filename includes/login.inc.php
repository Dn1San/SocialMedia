<?php
    if(isset($_POST["submit"]))
    {
        // Grabbing data
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Instantiate LoginContr class
        include "../classes/dbh.classes.php";
        include "../classes/login.classes.php";
        include "../classes/login-contr.classes.php";
        $login = new LoginContr($username, $password);

        // Running error handlers and user login
        $login->loginUser();

        // Logging into profile page
        header("location: ../profile.php?error=none");
    }
?>