<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareMeds </title>
  <link rel="stylesheet" href="admin-styles/admin-customers.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php 
session_start(); 

?>

  <?php 
  require 'dbconnection.php';
  $query_customers = "SELECT custId, custName, custAddress, custPhoneNumber, custEmail, dob, gender FROM customer";
  $result_customers = mysqli_query($conn,$query_customers);

  $query_ContactUs = "SELECT contactID, customerName, custAddress,customerEmail,phone_number,Message	FROM contactUs";
  $result_contactUs = mysqli_query($conn,$query_ContactUs);
?>				

<button class="close-btn" onclick="closePage()">X</button>

  <div class="products-container">
    <h1>View Customers</h1>
  <table >
    <th>custId</th>
    <th>custName</th>
    <th>custAddress</th>
    <th>custPhoneNumber</th>
    <th>custEmail</th>
    <th>dob</th>
    <th>gender</th>
    <tr>
      <?php 
      while ($row = mysqli_fetch_assoc($result_customers)){
        ?>
        <td> <?php echo $row['custId'] ?></td>
        <td> <?php echo $row['custName'] ?></td>
        <td> <?php echo $row['custAddress'] ?></td>
        <td> <?php echo $row['custPhoneNumber'] ?> </td>
        <td> <?php echo $row['custEmail'] ?> </td>
        <td> <?php echo $row['dob'] ?> </td>
        <td> <?php echo $row['gender'] ?></td>
       
      </tr>
      <?php 
     }
    ?>
  </table>
  </div>

  <script src="admin-forms-alert.js"></script>
</body>
</html>