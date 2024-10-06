<?php
session_start();
include 'dbconnection.php';

if (isset($_POST['submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare statement to select user by email and password
        $stmt = $conn->prepare("SELECT * FROM customer WHERE custEmail = ? AND custpassword = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

    

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['userId'] = $user['custId'];
            $_SESSION['userName'] = $user['custName'];
            $_SESSION['userRole'] = 'Customer';

            echo "Email: $email, Password: $password <br>";

            // Check if Admin or Driver
            if ($email === 'ronelladias17@gmail.com' && $password === 'caremeds') {
                $_SESSION['userRole'] = 'Admin';
                header("Location: admin-dashboard.php");
                exit();
            } elseif ($email === 'imanlatiffa@gmail.com' && $password === 'caremeds12') {
                $_SESSION['userRole'] = 'Driver';
                header("Location: driver-status.php");
                exit();
            }

            // Redirect to home page for regular customers
            header("Location: home-page.php");
            exit();
        } else {
            echo "Invalid email or password";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

</head>
<body>
<a href="./home-page.php"> <button class="close-home"><i class="fa-solid fa-x"></i></button></a>
  
 
<div class="main-box">
 
    <form  method="POST" action="login.php" class="form-login">
    <h1>Login</h1>
      <label for="username" class="label-login">
        username:
      </label>
      <input type="text" id="username" name="email" class="box"></br></br> 
      <label for="pwd" class="label-login">
        Password:
      </label>
      <input type="password" id="password" name="password" class="box" ></br></br>
     
      <input type="submit" id="submit-btn-login" value="Login" name="submit">
      <p >Dont have an Account? <a href="./sign-Up.php"> Sign UP</a></p>
      
      
    </form>
    <div class="form-pic">

  <dotlottie-player src="https://lottie.host/88ac892a-8c3c-4330-b266-adbbeee86c7c/xvx1zArt0t.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay class="lottie-img"></dotlottie-player>
  
    </div>

  


  </div>


  
</body>
</html>
