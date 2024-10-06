<?php
require '../../dbconnection.php';
session_start(); // Start session to track logged-in users

// Get the selected product ID
if (isset($_GET['ID'])) {
    $productId = $_GET['ID'];

    // Check if the 'Add to Cart' button was clicked
    if (isset($_POST['addtocart'])) {

        // Check if the user is logged in
        if (!isset($_SESSION['userId'])) {
            // Redirect guest users to the login page
            echo "<script>alert('Please log in first!'); window.location.href='../../login.php';</script>";
            exit();
        }

        // For logged-in users, continue adding the product to the cart
        $id = $_POST['pID'];  // Product ID from form
        $quantity = 1;        // Default quantity is 1
        $price = $_POST['price'];  // Product price from form
        $custId = $_SESSION['userId'];  // Get the customer ID from the session (who is logged in)

        // Check if the product is already in the cart for this customer
        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE productId = $id AND custId = $custId");
        if (mysqli_num_rows($select_cart) > 0) {
            echo '<script>alert("Product is already in the cart!");</script>';
        } else {
            // Insert the product into the cart
            $insert = mysqli_query($conn, "INSERT INTO cart (custId, productId, quantity, price) VALUES ('$custId', '$id', '$quantity', '$price')");
            if ($insert) {
                echo '<script>alert("Successfully added to the cart"); window.location.href="cart.php";</script>';
            } else {
                echo '<script>alert("Error adding to the cart");</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="../css/details.css"/>
    <link rel="stylesheet" href="../../header.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <!--fontawsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
        <!--navbar-->
        <?php
    include('./homepage-header1.php');
    ?>

<?php
$product = "SELECT * FROM products WHERE productId= $productId LIMIT 1";
$result =  mysqli_query($conn,$product);

if(mysqli_num_rows($result)>0){
    //output the data of each row
    while($row = mysqli_fetch_assoc($result)){
?>
    <div class="container-1">
 
        <div class="main-image-box">
               
<?php 

echo '<img src="/E-pharmacy/' . $row['image_path'] . '" alt="Image not found">';

?>
        </div>
    
    <div class="detail-box">
        <h3><?php echo $row["productName"];?></h3><br>
        <h4>price: Rs. <?php echo $row["productPrice"];?></h4><br>
        <h4>Stock:  <?php echo $row["productQty"]; ?></h4><br>
        <h4>Specifications:</h4><br><br>
        <p><?php echo $row["productDescription"];?></p>
        <br><br>
     
        <form action="details.php?ID=<?php echo $productId; ?>" method="POST" name="cart">
              <input type="hidden" name="pID" value="<?php echo $row["productId"];?>">
              <input type="hidden" name="price" value="<?php echo $row["productPrice"] ;?>">
              <input type="hidden" name="img" value="<?php echo $row["image_path"] ;?>">
              <input type="submit" name="addtocart" value="Add to cart" >
              </form>
      

    </div>
</div>

<?php
    ;}
;};
?>

<?php
include('../../hompage-footer.php');
?>
</body>
</html>