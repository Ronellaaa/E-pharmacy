<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareMeds </title>
  <link rel="stylesheet" href="admin-styles/admin-view-products.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php 
  require 'dbconnection.php';

  

  $query = "SELECT p.productId, p.productName, p.productQty, p.productDescription, p.productPrice, p.image_path, c.categoryName 
            FROM products p
            JOIN categories c ON p.categoryId = c.categoryId";
  $result = mysqli_query($conn,$query);
  ?>

<button class="close-btn" onclick="closePage()">X</button>
  <div class="products-container">
 
  <h1>Manage Products</h1>
  <table >
    <th>Product Id</th>
    <th>Prodcut Image</th>
    <th>Product Name</th>
    <th>Qty</th>
    <th>Category</th>
    <th>Product Description</th>
    <th>Price per product</th>
    <th>Action</th>
    <tr>
      <?php 
      while ($row = mysqli_fetch_assoc($result)){
        ?>
        <td> <?php echo $row['productId'] ?></td>
        <td> <img src="<?php echo $row['image_path']; ?>" alt="Product Image" width="100"> </td>
        <td> <?php echo $row['productName'] ?></td>
        <td> <?php echo $row['productQty'] ?></td>
        <td> <?php echo $row['categoryName'] ?> </td>
        <td> <?php echo $row['productDescription'] ?> </td>
        <td> <?php echo $row['productPrice'] ?></td>
        <td>
          <div class="manage-btn-container">
          <a href="admin-update-products.php?updateId=<?php echo $row['productId']?>" class="edit-btn manage-btn"><i class="fa-solid fa-pencil"></i></a>
          <a href="admin-dlt-products.php?id=<?php echo $row['productId']?>"class="dlt-btn manage-btn" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fa-solid fa-trash"></i></a>
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