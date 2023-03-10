<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Signup</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter"/>
    <style>
        .logo h1{
            font-family: Inter;
            font-weight: 700;
            font-size: 60px;
            font-style: italic;
        }
        .logo h2{
        font-family: Inter;
        font-weight: 700;
        font-size: 27px;
        font-style: italic;
      }
    </style>
    <script src="js/main.js"></script>
</head>
<body>
    <div class="logo center">
        <h1>NAME<br>MEDIA</h1>
        <h2>We work to connect and share.</h2>
    </div>
    <div class="registerbox">
        <h2>SIGN UP</h2>
        <p>Step: 1 of 2</p>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" placeholder="Full Name" name="full_name"/>
            <input type="text" placeholder="Username" name="username"/>
            <input type="password" placeholder="Password" name="password"/>
            <input type="email" placeholder="Email" name="email"/>
            <input type="number" placeholder="Phone Number" name="phone_number"/>
            <input type="date" placeholder="Date Of Birth" name="date_of_birth"/>
            <button class="registerbtn1" type="submit" name="submit">FINISH</button>
        </form>
        <div class="loginlink">
            <span>Have an account? </span><a href="login.php">Click Here</a>
        </div>
    </div>
</body>
</html>