<?php
session_start();

// Include the database connection file
require 'dbconnection.php';

// Retrieve the logged-in user's ID from the session
$custId = $_SESSION['userId'];

// Prepare the SQL query to retrieve the latest order details for the logged-in user
$sql = $conn->prepare("
    SELECT o.orderId, o.orderStatus, c.custName, c.custAddress 
    FROM orders o 
    JOIN customer c ON o.custId = c.custId 
    WHERE o.custId = ? 
    ORDER BY o.orderId DESC LIMIT 1
");

// Bind the user ID to the query
$sql->bind_param("i", $custId);

// Execute the query
$sql->execute();
$result = $sql->get_result();

// Fetch the data as an associative array
$row = $result->fetch_assoc();

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="orderStatus.css"> 
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
</head>
<body>
    <div class="header">
        <!-- Navbar -->
    </div>
    
    <div class="container">
        <h1>Your Order Status</h1>
        <a href="./project/php/product.php"> <button class="close-home"><i class="fa-solid fa-x"></i></button></a>
        <div class="animation">
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script><lottie-player src="https://lottie.host/7c28de65-75a0-4545-a896-7e6ba41dbc7e/pBp6UWhpee.json" background="transparent" speed="1" style="width: 300px; height: 300px" direction="1" mode="normal" loop autoplay></lottie-player>
</div>
     <div class="order-status">
            <p><strong>Order ID :</strong> <span id="orderId"><?php echo $row['orderId']; ?></span></p> 
            <p><strong>Name :</strong> <span id="customerName"><?php echo $row['custName']; ?></span></p> 
            <p><strong>Address :</strong> <span id="customerAddress"><?php echo $row['custAddress']; ?></span></p> 
    </div>
           
            <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li class="step-wizard-item" id="step1">
                        <span class="progress-count">1</span>
                        <span class="progress-label">Pending</span>
                    </li>
                    <li class="step-wizard-item" id="step2">
                        <span class="progress-count">2</span>
                        <span class="progress-label">Completed</span>
                    </li>
            
                </ul>
            </section>
        </div>
       
    </div>


    <script src="orderStatus.js"></script> 
</body>
</html>