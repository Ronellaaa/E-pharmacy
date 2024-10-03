<?php
include 'db-connection.php';

$orderId = $_GET['orderId'];  

$sql = $conn->prepare("SELECT * FROM orders WHERE orderId = ?");
$sql->bind_param("i", $orderId);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
} else {
    echo json_encode(['error' => 'Order not found']);
    exit();
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
        <div class="order-status">
            <p><strong>Order ID :</strong> <span id="orderId"><?php echo $row['orderId']; ?></span></p> 
            <p><strong>Name :</strong> <span id="customerName"><?php echo $row['customerName']; ?></span></p> 
            <p><strong>Address :</strong> <span id="customerAddress"><?php echo $row['customerAddress']; ?></span></p> 
            <p><strong>Product Name:</strong> <span id="productName"><?php echo $row['productName']; ?></span> 
            <span><strong>Qty :</strong> <span id="productQty"><?php echo $row['productQty']; ?></span></span></p> 
            <p><strong>Total :</strong> Rs. <span id="totalPrice"><?php echo $row['totalPrice']; ?></span></p> 

            <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li class="step-wizard-item <?php echo ($row['status'] == 'processed') ? 'current-item' : ''; ?>">
                        <span class="progress-count">1</span>
                        <span class="progress-label">Processed</span>
                    </li>
                    <li class="step-wizard-item <?php echo ($row['status'] == 'out for delivery') ? 'current-item' : ''; ?>">
                        <span class="progress-count">2</span>
                        <span class="progress-label">Out for delivery</span>
                    </li>
                    <li class="step-wizard-item <?php echo ($row['status'] == 'delivered') ? 'current-item' : ''; ?>">
                        <span class="progress-count">3</span>
                        <span class="progress-label">Delivered</span>
                    </li>
                </ul>
            </section>
        </div>
    </div>

    <script src="order-status.js"></script> 
</body>
</html>
