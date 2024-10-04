<?php

require 'dbconnection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"]) ) {
    // Prepare SQL query
    $sql = "INSERT INTO contactus (customerName, cutomerAddress, customerEmail, phone_number, Message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() was successful
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    $customerName = filter_var($_POST['customerName'], FILTER_SANITIZE_STRING);
    $customerAddress = filter_var($_POST['cutomerAddress'], FILTER_SANITIZE_STRING); // Fixed typo here
    $customerEmail = filter_var($_POST['customerEmail'], FILTER_SANITIZE_EMAIL);
    $phone_number = filter_var($_POST['phone_number'], FILTER_SANITIZE_STRING);
    $Message = filter_var($_POST['Message'], FILTER_SANITIZE_STRING);


    // Validate email format
    if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Bind parameters (removed $contactID)
    $stmt->bind_param("sssss", $customerName, $customerAddress, $customerEmail, $phone_number, $Message);

    // Execute statement
    if ($stmt->execute()) {
        echo " ";
    } else {
        echo "Error: Please try again. " . $stmt->error;
    }

    // Close resources
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact-us.css"> 
    <script src="contact-us.js"></script> 
</head>
<body>
    <!--navigation bar -->
  
<?php
include_once 'homepage-header.php';
?>

    <div class="contact-container">
        <div class="contact-image">
            <!-- add image with extra styuff -->
             <!-- <img src="./contactus-images/contact-bg.jpg" alt="Contact Us">  -->
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
        
            <form id="contactForm" action="contact-us.php" method="post" onsubmit="confirmSubmission(event)">
                <label for="customerName">Name:</label>
                <input type="text" id="customerName" name="customerName" required>
                
                <label for="cutomerAddress">Address:</label> 
                <input type="text" id="cutomerAddress" name="cutomerAddress" required>
            
                <label for="customerEmail">Email:</label>
                <input type="email" id="customerEmail" name="customerEmail" required>
            
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            
                <label for="Message">Message:</label>
                <textarea id="Message" name="Message" required></textarea>
            <div class="contact-btn">
                <button type="submit" name="submit">Submit</button>
                <button type="cancel" name="cancel">Cancel</button>
            </div>
            </form>
            
        </div>
    </div>

 <!-- footer -->
<?php
include_once 'hompage-footer.php';
?>

   
    
</body>
</html>

