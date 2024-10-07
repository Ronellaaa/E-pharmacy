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
    <!--css file-->
    <link rel="stylesheet" href="../css/product.css"/>
    <link rel="stylesheet" href="../css/footer.css" />
    <!--fontawsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <!--navbar-->
    <?php
    include('./homepage-header1.php');
    ?>
  
  
<!--search bar-->
<div class="search-cart-container">
    <form action="search.php" method="GET" name="search_form">
  <input type="text" placeholder="Search products..." name="query" class="search-bar">
  <input type="submit" value="Search" name="search_data" class="search-btn">
  </form>
  <button class="cart-icon"><a href="../php/cart.php" ><i class="fa-solid fa-cart-shopping"></i></a></button>
 
</div>



<section class="header">
<marquee class="marq" direction="left" loop="">
    <h1>CARE MEDS</h1>
    
</marquee>
</section>

<section>

<div class="title">
  <h2>Categories</h2>
</div>

<!--product category cards-->

<div  class="category-1">
<a href="../php/tablets.php">
<div class="row">
  <div class="column">
    <div class="cat">
      
        <img src="../images/50de437c40bba6893a0041e13031b741.jpg" >
       
        <div class="container-1">
        <h4><b>TABLETS</b></h4>
</div>
    </div>
  </div>
</a>
<a href="../php/syrups.php">
  <div class="column">
    <div class="cat">
        <img src="../images/sy.jpg" >
            <div class="container-1">
              <h4><b>SYRUPS</b></h4>
             
              
            </div></div>
  </div></a>
  <a href="../php/eye.php">
  <div class="column">
    <div class="cat">
        <img src="../images/image.png" >
            <div class="container-1">
              <h4><b>EYECARE</b></h4>
 
            </div>
          </div>
  </div>
</a>
<a href="../php/hair.php">
  <div class="column">
    <div class="cat">
        <img src="../images/eb5c0e2cff117a19f9e19139011b047f.jpg" >
            <div class="container-1">
              <h4><b>HAIRCARE</b></h4>
 
            </div></div>
  
</div></a>
<a href="../php/vitamins.php">
<div class="column">
    <div class="cat">
        <img src="../images/im.jpg" >
            <div class="container-1">
              <h4><b>VITAMINS</b></h4>
            
              
            </div>
  </div>
</div>
</a>
</div> 
</section> <br>
<br><hr><br>

<!--all product view-->

<div class="title">
  <h2>All products</h2>
</div>
<div class="row">
<?php

 // php for product page main view
$all_product = "SELECT * FROM products ";
$result =  mysqli_query($conn,$all_product);

if(mysqli_num_rows($result)>0){
    //output the data of each row
    while($row = mysqli_fetch_assoc($result)){
        $productId = $row["productId"];
        $imagePath = $row["image_path"];

       
 ?>
 
                 <!--get data to send to the details.php-->
<!-- <form action="details.php" method="POST" name="viewform"> -->
<a href="../php/details.php?ID=<?=$productId;?>">

<div class="column-product">
    <div class="card">
    
<?php 
//path of the where images are stored
echo '<img src="/E-pharmacy/' . $row['image_path'] . '" alt="Image not found">';



?>

            <div class="container-2">
              <h4><b><?php echo $row["productName"];?></b></h4>

              <!-- </form> --></a>
               <form action="" method="POST" name="cart">
              <input type="hidden" name="pID" value="<?php echo $row["productId"];?>">
              <input type="hidden" name="price" value="<?php echo $row["productPrice"] ;?>">
              <input type="hidden" name="img" value="<?php echo $row["image_path"] ;?>">
              <input type="hidden" name="cId" value="<?php echo  $crow["custId"] ;?>">
               <input type="submit" name="addtocart" value="Add to cart" >
              </form>
            </div>
            
              
            </div>

  </div>

 
<?php
;};};

?>
 </div>
</body>
</html>
<?php
include('../../hompage-footer.php');
?>