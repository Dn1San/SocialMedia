<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Forgotten Password</title>
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
  <div class="forgottenpasswordbox">
    <h2>Find Your Account</h2>
    <span>Please enter your email address to search for your account</span>
    <form action="" method="POST">
      <input type="email" placeholder="Email Address" name="email"/>
    </form>
    <br>
    <button class="findemailbtn" name="findemailbtn" onclick="window.location.href='';">SEARCH</button>
    <button class="cancelbtn" name="cancelbtn" onclick="window.location.href='login.php';">CANCEL</button>
  </div>
</body>
</html>