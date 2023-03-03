<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Media || *username* Profile</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter"/>
    <style>
      #logo h1{
        font-family: Inter;
        font-weight: 700;
        font-size: 60px;
        font-style: italic;
      }
    </style>
    <script src="js/main.js"></script>
</head>
<body>
    <div>
        <?php
            include("includes/header.inc.php");
        ?>
        <main>
            <div class="profileHeader">
                <img src="images/testProfilePicture.jpg" alt="Profile Picture">
                <div class="details">
                    <h2>John Doe</h2>
                    <div class="description">
                        <p>15 Posts</p>
                        <p>24 Friends</p>
                        <p>User Description: I am 20 years old • Live in Sheffield •  
                            study at Hallam University • study Programming Software 
                            Engineering • I Love Anime and Basketball
                        </p>
                    </div>
                </div>
            </div>
            <div class="profilePosts">
                <ul>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                    <li><img src="" alt="User Post"></li>
                </ul>
            </div>
        </main>
        <?php
            include("includes/footer.inc.php");
        ?>
    </div>
</body>
</html>