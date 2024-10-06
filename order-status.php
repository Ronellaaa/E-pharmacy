<?php
require 'dbconnection.php';

$sql = $conn->prepare("
    SELECT o.orderId, o.orderStatus, c.custName, c.custAddress 
    FROM orders o 
    JOIN customer c ON o.custId = c.custId 
    ORDER BY o.orderId DESC 
    LIMIT 1
");
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row); // Output the fetched data as JSON
} else {
    echo json_encode(['error' => 'Order not found']);
}

$conn->close();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="order-status.css"> 
</head>
<body>
    <div class="header">
        <!-- Navbar -->
    </div>
    
    <div class="container">
        <h1>Your Order Status</h1>
        <div class="animation">
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script><lottie-player src="https://lottie.host/7c28de65-75a0-4545-a896-7e6ba41dbc7e/pBp6UWhpee.json" background="transparent" speed="1" style="width: 300px; height: 300px" direction="1" mode="normal" loop autoplay></lottie-player>
</div>
        <div class="order-status">
            <p><strong>Order ID :</strong> <span id="orderId"><?php echo $row['orderId']; ?></span></p> 
            <p><strong>Name :</strong> <span id="customerName"><?php echo $row['custName']; ?></span></p> 
            <p><strong>Address :</strong> <span id="customerAddress"><?php echo $row['custAddress']; ?></span></p> 
           
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


    <script src="order-status.js"></script> 
</body>
</html>
