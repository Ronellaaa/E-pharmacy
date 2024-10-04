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
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $productName = $_POST['product_name'];
    $productQty = $_POST['product_qty'];
    $productDes = $_POST['product_description'];
    $category = $_POST['category'];
    $productPrice = $_POST['product_price'];

    // Handle file upload for product image
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $productImage = $_FILES['product_image']['name']; //original file name
        $imageTmpName = $_FILES['product_image']['tmp_name']; //temporary file location
        $imageSize = $_FILES['product_image']['size']; // image size in bytes
        $imageType = strtolower(pathinfo($productImage, PATHINFO_EXTENSION)); //pathinfo_extension will only extract the extension of the image and the strlower will convert this into lowercase 

        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        // Validate file type and size
        if (in_array($imageType, $allowed)) {  //checks if the value exists in the $allowed array
            if ($imageSize < 5000000) { // Limit file size to 5MB
            
                $targetDir = 'uploads/';  //directory where the uploaded file will be stored 
                $targetFile = $targetDir.basename($productImage);

                // Ensure the 'uploads' directory exists and is writable
                if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true)) {
                    echo "Failed to create upload directory.";
                    exit;
                }
                if ($_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                    // Proceed with moving the file
                } else {
                    echo "File upload error: " . $_FILES['product_image']['error'];
                }
              

                // Move the uploaded file
                if (move_uploaded_file($imageTmpName, $targetFile)) {
                    // Insert product data into the database
                    $sql = "INSERT INTO products (productName, categoryId, productQty, productDescription, productPrice, image_path) 
                            VALUES (?, ?, ?, ?, ?, ?)";

                    
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("siisds", $productName, $category, $productQty, $productDes, $productPrice, $targetFile);
                        if ($stmt->execute()) {
                            $message = "Product added successfully!";
                        } else {
                            $message = "Error inserting product: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        $message = "Error preparing statement: " . $conn->error;
                    }
                } else {
                    $message = "Error moving the uploaded file.";
                }
            } else {
                $message = "File size exceeds the limit of 5MB.";
            }
        } else {
            $message = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        $message = "Please upload a valid image file.";
    }
}

// Close the database connection after all operations are done
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
      <h2 class="add-products-heading">Add Products</h2>

    <label for="product_image">Product Image</label>

        <div class="custom-file-input">
            <label for="product_image">Select Product Image</label>
            <input type="file" id="product_image" name="product_image" required>
            <span class="file-name" id="file-name">No file selected</span>
        </div>
      <br>

      <label for="product_name">Product Name</label>
      <input type="text" id="product_name" name="product_name" required>
      <br>

      <label for="product_qty">Qty</label>
      <input type="number" id="product_qty" name="product_qty" min="1" required>
      <br>

      <label for="product_description">Product Description</label>
      <br>
      <textarea id="product_description" name="product_description" required></textarea>
      <br>

      <label for="category">Category:</label>
      <select name="category" id="category">
      <?php foreach ($categories as $category) : ?>
          <option value="<?= $category['categoryId']; ?>"><?= $category['categoryName']; ?></option>
          <?php endforeach; ?>
      </select>
      <br>

      <label for="product_price">Price:</label>
      <input type="number" id="product_price" name="product_price" min="0" step="0.01" required>
      <br>

      <input type="submit" name="submit" value="Add Product" class="submit-btn">

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