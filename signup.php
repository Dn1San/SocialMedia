<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name Media || Signup</title>
  <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
  <link rel="stylesheet" type="text/css" href="CSS/register.css"/>
  <script src="js/main.js"></script>
</head>
<body>
  <div class="logo center">
    <h1>NAME<br>MEDIA</h1>
    <h2>We work to connect and share.</h2>
  </div>
  <div class="registerbox">
    <h2>SIGN UP</h2>
    <form action="includes/signup.inc.php" method="POST">
      <input type="text" placeholder="Full Name" name="full_name" required autofocus/>
      <input type="text" placeholder="Username" name="username" min="3" max="20" required/>
      <input type="password" placeholder="Password" name="password" min="3" max="20" required/>
      <input type="email" placeholder="Email" name="email" required/>
      <input type="number" placeholder="Phone Number" name="phone_number"  pattern="[0-9]{11}" required/>
      <input type="date" placeholder="Date Of Birth" name="date_of_birth" min="1940-12-31" max="2025-12-31" required/>
      <button class="registerbtn1" type="submit" name="submit">Finish</button>
    </form>
    <?php
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "stmtfailed") {
          echo "<p class='error'> Error connecting to database!</p>";
        }else if ($_GET["error"] == "emptyinput") {
          echo "<p class='error'> missing input! please fill out all the boxs.</p>";
        }else if ($_GET["error"] == "usernameoremailtaken") {
          echo "<p class='error'> Username or email has already been taken!</p>";
        }else if ($_GET["error"] == "email") {
          echo "<p class='error'> please enter a valid email!</p>";
        }else if ($_GET["error"] == "usernameshort") {
          echo "<p class='error'> please enter a username with 4 or more characters!</p>";
        }else if ($_GET["error"] == "passwordshort") {
          echo "<p class='error'> please enter a password with 4 or more characters!</p>";
        }else if ($_GET["error"] == "invalidphonenumber") {
          echo "<p class='error'> please enter a valid phone number!</p>";
        }else if ($_GET["error"] == "username") {
          echo "<p class='error'> please enter a username with no special characters!</p>";
        }
      }
    ?>
    <div class="loginlink">
      <span>Have an account? </span><a href="login.php">Click Here</a>
    </div>
  </div>
</body>
</html>