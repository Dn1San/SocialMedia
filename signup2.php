<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <p>Step: 2 of 2</p>
    <form action="" method="POST">
      <label for="profile picture">Upload profile picture</label>
      <input type="file" name="profilePic"id="profile picture"/>
      <label for="description">Profile Description</label>
      <textarea name="description" id="description"></textarea>
      <button type="submit" name="registerbtn2">FINISH</button>
    </form>
    <div class="loginlink">
      <span>Have an account? </span><a href="login.php">Click Here</a>
    </div>
  </div>
</body>
</html>