<?php

if(isset($_POST["submit"]))
{
    // Grabbing data
    $fullName = $_POST["full_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];
    $password = $_POST["password"];
    $dateOfBirth = $_POST["date_of_birth"];

    // Instantiate SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($fullName, $username, $email, $phoneNumber, $password, $dateOfBirth);

    // Running error handlers and user signup
    $signup->signupUser();

    // Going to next step
    header("location: ../signup2.php?error=none");
}