<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CareMeds</title>
  <link rel="stylesheet" href="admin-styles/admin-add-products.css">

</head>
<body>
<?php
require 'dbconnection.php';

// Fetch categories from the database
$sql = "SELECT categoryId, categoryName FROM categories";
$result = $conn->query($sql);
$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

$message = '';
$productID = isset($_GET['updateId']) ? intval($_GET['updateId']) : 0;
error_log("Product ID being updated: $productID");

if ($productID) {
    $sql = "SELECT * FROM products WHERE productId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $productID);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

  $productID = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
  error_log("Product ID being updated from POST: $productID");
  
    $productName = $_POST['product_name'];
    $productQty = $_POST['product_qty'];
    $productDes = $_POST['product_description'];
    $category = $_POST['category'];
    $productPrice = $_POST['product_price'];

    // Use the current image path by default
    $targetFile = $product['image_path'];

    // Handle file upload for product image (if a new image is uploaded)
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $productImage = $_FILES['product_image']['name'];
        $imageTmpName = $_FILES['product_image']['tmp_name'];
        $imageSize = $_FILES['product_image']['size'];
        $imageType = strtolower(pathinfo($productImage, PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate file type and size
        if (in_array($imageType, $allowed)) {
            if ($imageSize < 5000000) {
                $newImageName = uniqid('', true) . "." . $imageType;
                $targetDir = 'uploads/';
                $targetFile = $targetDir . $newImageName;

                // Ensure the uploads directory exists and is writable
                if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
                    $message = "Failed to create upload directory.";
                }

                // Move the uploaded file to the target directory
                if (!move_uploaded_file($imageTmpName, $targetFile)) {
                    $message = "Error moving the uploaded file.";
                }
            } else {
                $message = "File size exceeds the limit of 5MB.";
            }
        } else {
            $message = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }


    // Update product data in the database (only if there are no errors)
    if (empty($message)) {
      $sql = "UPDATE products SET productName = ?, categoryId = ?, productQty = ?, productDescription = ?, productPrice = ?, image_path = ? WHERE productId = ?";
      $stmt = $conn->prepare($sql);
  
      if ($stmt) {
        
          $stmt->bind_param("siisdsi", $productName, $category, $productQty, $productDes, $productPrice, $targetFile, $productID);
  
          if ($stmt->execute()) {
              // Check how many rows were affected
              if ($stmt->affected_rows > 0) {
                  $message = "Product updated successfully!";
              } else {
                  $message = "No changes were made to the product.";
              }
          } else {
              $message = "Error updating product: " . $stmt->error;
              
          }
          $stmt->close();
      } else {
          $message = "Error preparing statement: " . $conn->error;
          
      }
  }
}

// Close the database connection
$conn->close();
?>


<?php if (!empty($message)): ?>
    <div id="alertBox" class="alert-box">
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>
  
<button class="close-btn" onclick="closePage()">X</button>
<div class="admin-add-products">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
      <h2 class="add-products-heading">Update Products</h2>
      <input type="hidden" name="product_id" value="<?php echo $productID; ?>">

    <label for="product_image">Product Image</label>

        <div class="custom-file-input">
            <label for="product_image">Select Product Image</label>
            <input type="file" id="product_image" name="product_image" >
            <span class="file-name" id="file-name">No file selected</span>
        </div>
      <br>

      <label for="product_name">Product Name</label>
      <input type="text" id="product_name" name="product_name" value="<?php echo $product['productName']?>" required>
      <br>

      <label for="product_qty">Qty</label>
      <input type="number" id="product_qty" name="product_qty" min="1" value="<?php echo $product['productQty']?>" required>
      <br>

      <label for="product_description">Product Description</label>
      <br>
      <textarea id="product_description" name="product_description"required><?php echo $product['productDescription'] ?></textarea>
      <br>

      <label for="category">Category:</label>
      <select name="category" id="category">
      <?php foreach ($categories as $category) : ?>
        <option value="<?= $category['categoryId']; ?>" <?= $category['categoryId'] == $product['categoryId'] ? 'selected' : ''; ?>>
          <?= $category['categoryName']; ?>
          <?php endforeach; ?>
      </select>
      <br>

      <label for="product_price">Price:</label>
      <input type="number" id="product_price" name="product_price" min="0" step="0.01" value="<?php echo $product['productPrice']?>"required>
      <br>

      <input type="submit" name="submit" value="Update Product" class="submit-btn">

    </form>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById('product_image');
    const fileName = document.getElementById('file-name');

    fileInput.addEventListener('change', function() {
      if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name; // Update the label with the selected file name
      } else {
        fileName.textContent = 'No file selected'; // Default message if no file is selected
      }
    });
  });
</script>



<script src="admin-forms-alert.js"></script>
</body>
</html>