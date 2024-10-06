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
    <title>product page</title>
    <link rel="stylesheet" href="../css/eye.css"/>
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
  

<!--header-->
<section class="header">

  <img src="../images/vitamin1.png">
  <!--search bar-->
  
  <div class="search-cart-container">
    <form action="search.php" method="GET" name="search_form">
  <input type="text" placeholder="Search products..." name="query" class="search-bar">
  <input type="submit" value="Search" name="search_data" class="search-btn">
  </form>
  <button class="cart-icon"><a href="../php/cart.php" ><i class="fa-solid fa-cart-shopping"></i></a></button>
 
</div>

<div class="text">
<marquee class="marq" direction="left" loop="">
  <h1>VITAMINS</h1>
</marquee>
  
    <p>Discover our wide range of high-quality vitamins designed to support your health and wellness. Whether you're looking for daily multivitamins, immune boosters, or specific supplements like Vitamin D, B12, or C, our collection has you covered. Shop now to find trusted brands and expert formulations that promote vitality and well-being for all ages. </p>
</div>
   
    
   
</section>
<div class="topnav">
<a href="../php/tablets.php" >Tablets</a>
  <a href="../php/syrups.php">Syrups</a>
  <a href="../php/hair.php" >Hair Care</a>
  <a href="../php/eye.php">Eye Care</a>
  <a href="../php/vitamins.php" class="active">Vitamins</a>
</div>


<div class="row">
<?php

 // php for product page main view
$all_product = "SELECT * FROM products WHERE categoryId = '62' ORDER BY productId DESC";
$result =  mysqli_query($conn,$all_product);

if(mysqli_num_rows($result)>0){
    //output the data of each row
    while($row = mysqli_fetch_assoc($result)){
        $productId = $row["productId"];

       
 ?>
  <!--get data to send to the details.php-->

<a href="../php/details.php?ID=<?=$productId;?>">
<div class="column">
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
              <input type="submit" name="addtocart" value="Add to cart" class="btn">
              </form>
            </div>
              
            </div>
  </div>


 
<?php
    ;}
;};
?>
</div>
<?php
include('../../hompage-footer.php');
?>
</body>
</html>