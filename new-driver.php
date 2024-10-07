<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['userId']) || $_SESSION['userRole'] !== 'Driver') {
  header("Location: login.php");
  exit();
}
?>


<?php
require 'dbconnection.php';

// Fetch the most recent order along with customer details
$sql = $conn->prepare("
    SELECT o.orderId, o.orderStatus, c.custName, c.custAddress 
    FROM orders o
    JOIN customer c ON o.custId = c.custId  
    ORDER BY o.orderId DESC 
");
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
  $orders = $result->fetch_all(MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="new-driver.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="header">
        <!-- Navbar -->
    </div>

    <div class="user">
    <h1 class="driver-h1">Delivery Status</h1>
   <div class="user-log">
   <a href="profile.php"> <h6 class="user-name"><i class="fa-solid fa-user"></i>  <?php echo $_SESSION['userName'] ;?></h6></a>
   <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
</div>
    <div class="driver-con">
    <div class="driver-img-1">
     <img src="./new-driver-img/img-22.gif" alt="">
   
      </div>
    
    <div class="container">
      
        <?php foreach ($orders as $row): ?>
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
                    <?php if ($row['orderStatus'] == 'Completed'): ?>
            <li class="step-wizard-item current-item">
                <span class="progress-count">2</span>
                <span class="progress-label">Completed</span>
            </li>
        <?php elseif ($row['orderStatus'] == 'Cancelled'): ?>
            <li class="step-wizard-item current-item">
                <span class="progress-count">2</span>
                <span class="progress-label">Cancelled</span>
            </li>
        <?php endif; ?>
                    
                </ul>
            </section>

            <div class="status-update">
            <label for="orderStatus-<?php echo $row['orderId']; ?>">Update Order Status:</label>
    <select id="orderStatus-<?php echo $row['orderId']; ?>">
        <option value="" disabled>Select status</option>
        <option value="Completed" <?php echo ($row['orderStatus'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
        <option value="Cancelled" <?php echo ($row['orderStatus'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
    </select>
    <button class="driver-btn" id="updateStatusBtn-<?php echo $row['orderId']; ?>">Update Status</button>
            </div>
        </div>
        <?php endforeach; ?>
      
    </div>
    <!-- <div class="driver-img">
     <img src="./new-driver-img/img21.png" alt="">
      </div> -->
   
    </div>
    <script src="new-driver.js"></script>
</body>
</html>
