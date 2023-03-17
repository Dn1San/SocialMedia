<?php
    if(isset($_POST["resetpasswordbtn"])) {
        // Grabbing data
        $selector = $_POST["selector"];
        $valdidator = $_POST["validator"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["passwordconfirm"];

        // Instantiate ResetPassword class
        include "../classes/dbh.classes.php";
        include "../classes/resetPassword.classes.php";
        $reset = new ResetPassword($userEmail);

        // Running error handlers and user password reset
        $reset->resetPassword();

        // Return to forgot passwor page
        header("Location: ../forgottenPassword.php?reset=success");
    }else {
        header("Location: ../resetPassword.php");
    }
?>