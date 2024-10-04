<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareMeds </title>
  <link rel="stylesheet" href="admin-styles/admin-orders.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php 
  require 'dbconnection.php';
  $query = "SELECT o.orderId, o.orderDate, o.orderStatus, o.totalAmount, o.payment_status, c.custName 
  FROM orders o
  JOIN customer c ON o.custId = c.custId";
  
  $result = mysqli_query($conn,$query);
  ?>				

<button class="close-btn" onclick="closePage()">X</button>

  <div class="products-container">
    <h1>Manage Orders</h1>
  <table >
    <th>Order Id</th>
    <th>Customer Id</th>
    <th>Order Date</th>
    <th>Total Amount</th>
    <th>Order Status</th>
    <th>Payment Status</th>
    <th>Action</th>
    <tr>
      <?php 
      while ($row = mysqli_fetch_assoc($result)){
        ?>
        <td> <?php echo $row['orderId'] ?></td>
        <td> <?php echo $row['custName'] ?></td>
        <td> <?php echo $row['orderDate'] ?></td>
        <td> <?php echo $row['totalAmount'] ?> </td>
        <td> <?php echo $row['payment_status'] ?> </td>
        <td> <?php echo $row['orderStatus'] ?></td>
        <td>
          <div class="manage-btn-container">
          <a href="admin-update-orders.php?orderId=<?php echo $row['orderId'];?>" class="edit-btn manage-btn"><i class="fa-solid fa-pencil"></i></a>
         
        </div>
      </td>
      </tr>
      <?php 
     }
    ?>
  </table>
  </div>
  <script src="admin-forms-alert.js"></script>
</body>
</html>