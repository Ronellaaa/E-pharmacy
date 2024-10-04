<?php
require '../../dbconnection.php';

$customer= mysqli_query($conn,"SELECT *  FROM customer");//get the cusID from the login page
if(mysqli_num_rows($customer )>0){
    while($crow = mysqli_fetch_assoc($customer)){
//check whether the button is clicked or not if clicked then 
if(isset($_POST['addtocart']))
{
    //take the form input data
    $id= $_POST['pID'];
    $quan =1;
    $price=$_POST['price'];
    $cid = $_POST['cId'];

    $select_cart=mysqli_query($conn,"SELECT * FROM cart WHERE productId = $id");
//check wheather the product is in the cart
    if(mysqli_num_rows($select_cart)>0){
        echo '<script>alert("Already in the cart")</script>';}

        //if not add to the cart
    else{
        $insert= mysqli_query($conn,"INSERT INTO cart (custId,productId,quantity,price) VALUES ('$cid','$id','$quan','$price') ");
        echo '<script>alert(" Sucessfully added to the cart")</script>';
    }
    

}}
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
<!-- 
  <form action="search.php" method="GET" name="search_form">
    <div class="search">
  <input type="text" placeholder="Search products..." name="query" >
  <input type="submit" value="Search" name="search_data">
 
  
</div>

<a href="../php/cart.php"  class="nav-right"><i class="fa fa-shopping-cart"></i></a>

</form> -->



</div>

<?php

 // php for product page main view
$all_product = "SELECT * FROM products WHERE categoryId = '5' ORDER BY productId DESC";
$result =  mysqli_query($conn,$all_product);

if(mysqli_num_rows($result)>0){
    //output the data of each row
    while($row = mysqli_fetch_assoc($result)){
        $productId = $row["productId"];

       
 ?>
  <!--get data to send to the details.php-->
<form action="details.php" method="POST" name="viewform">
<a href="../php/details.php?ID=<?=$productId;?>">
<div class="column">
    <div class="card">
        <img src="../images/<?php echo $row["images"];?>" >
            <div class="container-2">
              <h4><b><?php echo $row["productNmae"];?></b></h4>

              </form>
               <form action="" method="POST" name="cart">
              <input type="hidden" name="pID" value="<?php echo $row["productId"];?>">
              <input type="hidden" name="price" value="<?php echo $row["productPrice"] ;?>">
              <input type="hidden" name="img" value="<?php echo $row["images"] ;?>">
              <input type="hidden" name="cId" value="<?php echo  $crow["cusId"] ;?>">
              <input type="submit" name="addtocart" value="Add to cart" class="btn">
              </form>
            </div>
              
            </div>
  </div>

</a>
 
<?php
    ;}
;};}
?>
<?php
include('../../hompage-footer.php');
?>
</body>
</html>