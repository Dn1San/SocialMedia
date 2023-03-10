<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Login</title>
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
    <div class="loginbox">
        <form action="includes/login.inc.php" method="POST">
            <input type="text" placeholder="username" name="username"/>
            <input type="password" placeholder="password" name="password"/>
            <button class="loginbtn" type="submit" name="submit">LOGIN</button>
            <div id=forgotPasswordLink>
                <a href="forgottenPassword.php">Forgotten Password?</a>
            </div>
        </form>
        <button class="signupbtn" name="signup" onclick="window.location.href='signup.php'">SIGN UP</button>
    </div>
</body>
</html>