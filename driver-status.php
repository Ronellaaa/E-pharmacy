<?php
require 'dbconnection.php';

// Fetch the most recent order along with customer details
$sql = $conn->prepare("
    SELECT o.orderId, o.orderStatus, c.custName, c.custAddress 
    FROM orders o
    JOIN customer c ON o.custId = c.custId  
    ORDER BY o.orderId DESC LIMIT 1
");
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
    <title>Delivery Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="driver-status.css">
</head>
<body>
    <div class="header">
        <!-- Navbar -->
    </div>
    

    
    <div class="container">
        <h1>Delivery Status</h1>
        <div class="order-status">
            <p><strong>Order ID :</strong> <span id="orderId"><?php echo $row['orderId']; ?></span></p> 
            <p><strong>Name :</strong> <span id="customerName"><?php echo $row['custName']; ?></span></p> 
            <p><strong>Address :</strong> <span id="customerAddress"><?php echo $row['custAddress']; ?></span></p> 
           
            <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li class="step-wizard-item <?php echo ($row['orderStatus'] == 'Pending') ? 'current-item' : ''; ?>">
                        <span class="progress-count">1</span>
                        <span class="progress-label">Pending</span>
                    </li>
                    <li class="step-wizard-item <?php echo ($row['orderStatus'] == 'Completed') ? 'current-item' : ''; ?>">
                        <span class="progress-count">2</span>
                        <span class="progress-label">Completed</span>
                    </li>
                </ul>
            </section>

            <div class="status-update">
                <label for="orderStatus">Update Order Status:</label>
                <select id="orderStatus">
                    <option value="" disabled>Select status</option>
                    <option value="Pending" <?php echo ($row['orderStatus'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="Completed" <?php echo ($row['orderStatus'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                    <option value="Cancelled" <?php echo ($row['orderStatus'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                </select>
                <button id="updateStatusBtn">Update Status</button>
            </div>
        </div>
    </div>

    <script src="driver-table.js"></script>
</body>
</html>
