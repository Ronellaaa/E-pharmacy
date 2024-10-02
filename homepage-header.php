
<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription</title>
  <link rel="stylesheet" href="home-page.css" />
</head>
<body>

      <div class="container">
        <div class="logo">
          <img src="./assets/logo.png" alt="logo image" />
        </div>
        <nav>
          <ul>
            <li>
              <a href="http://localhost/E-pharmacy/home-page.php" class="link">Home</a>
              <a href="http://localhost/E-pharmacy/about-Us.php" class="link">About Us</a>
              <a href="http://localhost/E-pharmacy/project/php/product.php" class="link">Products</a>
              <a href="#" class="link">Contact Us</a>
            </li>
          </ul>
        </nav>
        <?php
        if(isset($_SESSION['custuid'])){
        echo '<div class="login-button">
                    <a href="profile.php">
                        <button class="btn-login">' . $_SESSION['useruid'] . '</button>
                    </a>
                    <a href="includes/logout.inc.php">
                        <button class="btn-login">Logout</button>
                    </a>
                </div>';
              }else{
                echo '<div class="login-button">
                    <a href="login.php">
                        <button class="btn-login">Login</button>
                    </a>
                    <a href="sign-Up.php">
                        <button class="btn-login">Sign up</button>
                    </a>
                </div>';
              }

        ?>
      
      </div>

   
 
</body>
</html>