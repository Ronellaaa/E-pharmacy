<?php
include 'db-connection.php';

if (isset($_POST['orderId']) && isset($_POST['orderStatus'])) {
    $orderId = $_POST['orderId'];
    $orderStatus = $_POST['orderStatus'];

    // Prepare and execute the update query
    $sql = $conn->prepare("UPDATE orders SET orderStatus = ? WHERE orderId = ?");
    $sql->bind_param("si", $orderStatus, $orderId);

    // Check if the query executes successfully
    if ($sql->execute()) {
        // Respond with success
        echo json_encode(['message' => 'Order status updated successfully.']);
    } else {
        // Respond with error
        echo json_encode(['error' => 'Error updating order status: ' . $conn->error]);
    }

    // Close the statement
    $sql->close();
} else {
    echo json_encode(['error' => 'Invalid request. Please provide both order ID and status.']);
}

// Close the database connection
$conn->close();
?>
