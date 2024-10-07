<?php
require '../../dbconnection.php';

session_start(); 


// Handle 'Add to Cart' button click
if (isset($_POST['addtocart'])) {

  if (!isset($_SESSION['userId'])) {
    // If the user is not logged in, show an alert and redirect them to the login page
    echo "<script>alert('Please log in first!'); window.location.href='../../login.php';</script>";
    exit();
}

// Get the form input data
$productId = $_POST['pID'];
$quantity = 1; // Default quantity
$price = $_POST['price'];

// Use the customer ID from the session (foreign key)
$custId = $_SESSION['userId']; 

// Check if the product is already in the cart for this customer
$select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE productId = $productId AND custId = $custId");

if (mysqli_num_rows($select_cart) > 0) {
    echo '<script>alert("Product is already in the cart!");</script>';
} else {
    // Insert the product into the cart
    $insert = mysqli_query($conn, "INSERT INTO cart (productId, quantity, price, custId) VALUES ('$productId', '$quantity', '$price', '$custId')");

    if ($insert) {
        echo '<script>alert("Successfully added to the cart");</script>';
    } else {
        echo '<script>alert("Error adding to the cart");</script>';
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/product.css"/>
</head>
<body>
  

<div class="title">
  <h2>Search Results</h2>
</div>



  <div class="row">
<?php 
if(isset($_GET['search_data'])){
$user_search = $_GET['query'];

}else{
    echo "pleaseenter name correctly...";
}

$search =mysqli_query($conn,"SELECT * FROM products WHERE productName LIKE '%$user_search%'");
if(mysqli_num_rows($search)>0){
  
  //output the data of each row
  while($row = mysqli_fetch_assoc($search)){
    $productId = $row["productId"];

   
?>
<!--get data to send to the details.php-->

<a href="../php/details.php?ID=<?=$productId;?>">

<div class="column-product">
<div class="card">
<?php 
//path of the where images are stored
echo '<img src="/E-pharmacy/' . $row['image_path'] . '" alt="Image not found">';

?>
        <div class="container-2">
          <h4><b><?php echo $row["productName"];?></b></h4>

          </a>
           <form action="" method="POST" name="cart">
          <input type="hidden" name="pID" value="<?php echo $row["productId"];?>">
          <input type="hidden" name="price" value="<?php echo $row["productPrice"] ;?>">
          <input type="hidden" name="img" value="<?php echo $row["image_path"] ;?>">
          <input type="submit" name="addtocart" value="Add to cart" >
          </form>
        </div>
        
          
        </div>

</div>
<?php
    ;}
;};
?>
</div>
</body>
</html>

