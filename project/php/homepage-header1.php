<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if(isset($_SESSION['userId'])) {
  // User is logged in
  $userRole = $_SESSION['userRole'];  // Get the user role
  $userName = $_SESSION['userName'];  // Get the user name
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription</title>
  <link rel="stylesheet" href="../css/header.css" />
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
</head>
<body>

      <div class="container">
        <div class="logo">
        <img src="../../assets/logo.png" alt="logo image" />
        </div>
        <nav>
          <ul>
            <li>
              <a href="http://localhost/E-pharmacy/home-page.php" class="link">Home</a>
              <a href="http://localhost/E-pharmacy/about-Us.php" class="link">About Us</a>
              <a href="http://localhost/E-pharmacy/project/php/product.php" class="link">Products</a>
              <a href="http://localhost/E-pharmacy/contact-us.php" class="link">Contact Us</a>
            </li>
          </ul>
        </nav>
        
    
        <div class="login-button">
          <?php if(isset($_SESSION['userId'])): ?>
              <!-- If user is logged in, show Profile and Logout -->
              <a href="../../profile.php">
              <button class="btn-login"><i class="fa-regular fa-user"></i> <?php echo $_SESSION['userName'] ; ?></button>
              </a>
              <a href="./cart.php">
                  <button class="btn-login"><i class="fa-solid fa-cart-shopping"></i></button>
              </a>
          <?php else: ?>
              <!-- If user is not logged in, show Login and Sign up -->
              <a href="../../login.php">
                  <button class="btn-login">Login</button>
              </a>
              <a href="../../sign-Up.php">
                  <button class="btn-login">Sign up</button>
              </a>
          <?php endif; ?>
        </div>

      </div>
   
   
 
</body>
</html>


