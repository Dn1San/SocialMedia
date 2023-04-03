<?php
    if(isset($_POST["submit"]))
    {
        // Grabbing data
        $username = $_POST["username"];

        // Instantiate SignupContr class
        include "../classes/dbh.classes.php";
        include "../classes/admin.classes.php";
        $admin = new Admin();

        // Running error handlers and user signup
        $admin->setAdmin($username);

        // Going to next step
        header("location: ../admin.php?error=none");
    }
?>