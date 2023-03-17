<?php
    if(isset($_POST["findemailbtn"])) {
        // Grabbing data
        $userEmail = $_POST["email"];

        // Instantiate ResetPassword class
        include "../classes/dbh.classes.php";
        include "../classes/resetPassword.classes.php";
        $reset = new ResetPassword($userEmail);

        // Running error handlers and user password reset
        $reset->resetPasswordRequest();

        // Return to forgot passwor page
        header("Location: ../forgottenPassword.php?reset=success");
    }else {
        header("Location: ../forgottenPassword.php");
    }
?>