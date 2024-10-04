<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareMeds </title>
  <link rel="stylesheet" href="admin-styles/admin-prescriptions.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php 
  require 'dbconnection.php';
  $query = "SELECT 	id, patient_name, patient_email, patient_phone, prescription_file, prescription_date,	fulfillment_type,	payment_method,	status,	created_at	FROM prescriptions";
  
  $result = mysqli_query($conn,$query);
  ?>				

<button class="close-btn" onclick="closePage()">X</button>

  <div class="products-container">
    <h1>Manage Prescriptions</h1>
  <table >
    <th>Id</th>
    <th>Image file</th>
    <th>Patient Name</th>
    <th>Patient Email</th>
    <th>Patient PhoneNumber</th>
    <th>Issued Date</th>
    <th>Fullfillment Type</th>
    <th>Payment Method</th>
    <th>status</th>
    <th>created Date</th>
    <tr>
      <?php 
      while ($row = mysqli_fetch_assoc($result)){
        ?>
        <td> <?php echo $row['id'] ?></td>
        <td> <img src="<?php echo $row['prescription_file']; ?>" alt="Product Image" width="100"> </td>
        <td> <?php echo $row['patient_name'] ?></td>
        <td> <?php echo $row['patient_email'] ?></td>
        <td> <?php echo $row['patient_phone'] ?> </td>
        <td> <?php echo $row['prescription_date'] ?> </td>
        <td> <?php echo $row['fulfillment_type'] ?> </td>
        <td> <?php echo $row['payment_method'] ?></td>
        <td>
    <form action="admin-update-pres.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <select name="status">
        <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
        <option value="Processed" <?php echo ($row['status'] == 'Processed') ? 'selected' : ''; ?>>Processed</option>
        <option value="Completed" <?php echo ($row['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
        <option value="Cancelled" <?php echo ($row['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
      </select>
      <button type="submit"><i class="fa-solid fa-pencil"></i></button>
    </form>
  </td>
        <td> <?php echo $row['created_at'] ?></td>
       
      </tr>
      <?php 
     }
    ?>
  </table>
  </div>
  <script src="admin-forms-alert.js"></script>
</body>
</html>