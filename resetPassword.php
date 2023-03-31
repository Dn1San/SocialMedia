<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || Reset Password</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" type="text/css" href="CSS/forgottenPassword.css"/>
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
    <?php
      $selector = $_GET["selector"];
      $validator = $_GET["validator"];

      if (empty($selector) || empty($validator)) {
        echo "Could not validate your request!";
      }else {
        if (ctype_xdigit($selector) == true && ctype_xdigit($validator) == true) {
          ?>
            <h2>Reset Your Password</h2>
            <span>Please enter your new password.</span>
            <form action="includes/resetPassword.inc.php" method="POST">
              <input type="hidden" name="selector" value="<?php echo $selector ?>">
              <input type="hidden" name="validator" value="<?php echo $validator ?>">
              <input type="password" placeholder="Enter New Password" name="password"/>
              <input type="password" placeholder="Re-enter New Password" name="passwordconfirm"/>
              <br>
              <button class="findemailbtn" name="resetpasswordbtn" type="submit">RESET</button>
            </form>
            <button class="cancelbtn" name="cancelbtn" onclick="window.location.href='login.php';">CANCEL</button>
          <?php
        }
      }
    ?>
  </div>
</body>
</html>