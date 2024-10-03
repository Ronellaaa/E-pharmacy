<?php
include 'db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['orderId'];
    $orderStatus = $_POST['orderStatus'];

    $sql = $conn->prepare("UPDATE orders SET status = ? WHERE orderId = ?");
    $sql->bind_param("ss", $orderStatus, $orderId);
    
    if ($sql->execute()) {
        echo "Order status updated successfully.";
    } else {
        echo "Error updating order status: " . $conn->error;
    }

    $sql->close();
}

$conn->close();
?>
