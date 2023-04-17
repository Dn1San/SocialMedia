<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name Media || Forgotten Password</title>
  <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
  <link rel="stylesheet" type="text/css" href="CSS/forgottenPassword.css"/>
  <script src="js/main.js"></script>
</head>
<body>
  <div class="logo center">
    <h1>NAME<br>MEDIA</h1>
    <h2>We work to connect and share.</h2>
  </div>
  <div class="forgottenpasswordbox">
    <h2>Reset Your Password</h2>
    <span>Please enter your email address to search for your account</span>
    <form action="includes/resetRequest.inc.php" method="POST">
      <input type="email" placeholder="Email Address" name="email"/>
      <br>
      <button class="findemailbtn" name="findemailbtn" type="submit">SEARCH</button>
    </form>
    <button class="cancelbtn" name="cancelbtn" onclick="window.location.href='login.php';">CANCEL</button>
    <?php
      if (isset($_GET["reset"])) {
        if ($_GET["reset"] == "success") {
          echo "<p class='success'> Check your email!</p>";
        }
      }
    ?>
  </div>
</body>
</html>