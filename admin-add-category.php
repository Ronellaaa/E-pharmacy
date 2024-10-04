<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareMeds</title>
  <link rel="stylesheet" href="admin-styles/admin-add-category.css" />
</head>
<body>
<?php
   require 'dbconnection.php';
    $message = '';

    if($_SERVER['REQUEST_METHOD']=='POST'){
      $categoryName = $_POST['category_name'];
      $sql = "INSERT INTO categories (categoryName) VALUES ('$categoryName')";

      if($conn->query($sql)===TRUE){
        $message = "Category added successfully!";
    } else {
        $message = "Error: " . $conn->error;
      }
      $conn->close();
    }
    
  ?>
<?php if (!empty($message)): ?>
    <div id="alertBox" class="alert-box">
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>
<button class="close-btn" onclick="closePage()">X</button>
<div class="admin-add-category">
  
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <h2 class="add-category-heading">Add category</h2>

      <label for="category_name">Category Name</label>
      <input type="text" id="category_name" name="category_name" required>
      <br>

      <input type="submit" value="Add category" class="submit-btn">
    </form>
</div>

<script src="admin-forms-alert.js"></script>
</body>
</html>