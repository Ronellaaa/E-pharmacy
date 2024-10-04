<?php
session_start(); 
require 'dbconnection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $fullName = $_POST['Name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password']; 
    $confirmPassword = $_POST['confirmPassword'];

    
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    if ($password < 5 ){
        echo "<script>alert('Password must be more than 5 characters'); window.history.back();</script>";
        exit();
    }

    
    $sql = "INSERT INTO customer (custName, dob, gender, custPhoneNumber, custEmail, custAddress, custPassword) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    
    if ($insertCustomerStatement = $conn->prepare($sql)) {
        
        $insertCustomerStatement->bind_param("sssssss", $fullName, $dob, $gender, $phone, $email, $address, $password);

        
        if ($insertCustomerStatement->execute()) {
            $_SESSION['custId'] = $conn->insert_id; 
             echo "<script>alert('Registration successful!'); window.location.href='profile.php';</script>";
        

        } else {
            echo "<script>alert('Error: Could not execute query.'); window.history.back();</script>";
        }

        
        $insertCustomerStatement->close();
    } else {
        echo "<script>alert('Error: Could not prepare the statement.'); window.history.back();</script>";
    }

    
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareMeds</title>
    <link rel="stylesheet" type="text/css" href="sign-Up.css">
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
    
</head>
<body>
 

<?php
include_once 'homepage-header.php';
?>
    <div class="background-signup">
        

    <div class="form-container">
        <h2>Sign Up</h2>
        <form id="signUpForm" action="sign-Up.php" method="POST">
        <div class="form-group">
           
                <label for="Name">Full Name</label>
                <input type="text" id="Name" name="Name" required>
          
          
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
          
          
                <label>Gender</label>
                <input type="radio" id="male" name="gender" value="male" class=
                "gender" required> Male
                <input type="radio" id="female" name="gender" value="female" required class=
                "gender"> Female
         
          
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" maxlength="10" required>
           
            
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
           
           
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="4" required></textarea>
            
           
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            
            
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            
            
</div>
<button type="submit" class="submit-btn">Submit</button>

        </form>
    </div>
   
    </div>
   
<?php
include_once 'hompage-footer.php';
?>
</body>
</html>


