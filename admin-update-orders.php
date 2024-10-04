<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareMeds</title>
  <link rel="stylesheet" href="admin-styles/admin-orders.css">

</head>
<body>
<?php
require 'dbconnection.php';
  if(isset($_GET['orderId'])){
    $orderId = intval($_GET['orderId']);

    $query = 'SELECT * FROM orders WHERE orderId = ? ';
    $stmt = $conn->prepare($query);
    $stmt -> bind_param('i',$orderId);
    $stmt -> execute();
    $order = $stmt -> get_result()->fetch_assoc();
    $stmt -> close();
  }

  if($_SERVER ['REQUEST_METHOD']=== 'POST'){
    $newStatus = $_POST['orderStatus'];

    $query = 'UPDATE orders SET orderStatus = ? WHERE orderId = ? ';
    $stmt = $conn->prepare($query);
    $stmt -> bind_param('si', $newStatus, $orderId);

    if($stmt -> execute()){
      echo "Order status updated Successfully!";
      header('Location:admin-view-orders.php');
      exit;
    }else{
      echo "Error Updating the status. ".$conn->error;
    }
    $stmt -> close();
  }

$conn->close();

?>
<button class="close-btn" onclick="closePage()">X</button>
<h2>Update Order Status for Order #<?php echo $orderId; ?></h2>
<div class="update-orderstatus-container">
    <form method="POST" action="">
        <label for="orderStatus">Order Status:</label>
        <select name="orderStatus" id="orderStatus">
            <option value="Pending" <?php if ($order['orderStatus'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Completed" <?php if ($order['orderStatus'] == 'Completed') echo 'selected'; ?>>Completed</option>
            <option value="Cancelled" <?php if ($order['orderStatus'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
        </select>
        <button type="submit" class="submit-btn">Update Status</button>
    </form>
    </div>

<script src="admin-forms-alert.js"></script>
</body>
</html>