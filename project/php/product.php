<?php
require 'connect.php';

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
    <!--css file-->
    <link rel="stylesheet" href="../css/product.css"/>
    <!--fontawsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    <!--navbar-->
    <div class="nav">
  
        <ul>
            <li><a class="nav-link" href="#">Home</a></li>
            <li><a class="nav-link" href="#">About Us</a></li>
            <li><a class="nav-link" href="product.php" >Products</a></li>
            <li><a class="nav-link" href="#" >Contact Us</a></li>
    </ul>
    <div class="nav-right">
        <a href="../php/cart.php"><i class="fa fa-shopping-cart"></i></a>
        <a href="#"><i class="fa fa-user"></i></a>

    </div>
</div>
<!--search bar-->

<form action="product.php" method="get" name="search_form">
    <div class="search">
  <input type="text" placeholder="Search products..." name="search_product" autocomplete="off">
  <input type="submit" value="Search" name="search_data">
</div>
</form>
<?php/*
$user_search= $_GET['TERM'];
$sql = mysqli_query($conn,"SELECT productNmae FROM products WHERE productNmae LIKE '%".$user_search."%'");

$suggestions= [];
if(mysqli_num_rows($sql)> 0){
  while($term =mysqli_fetch_assoc($sql)){
    $suggestions [] =$term["productNmae"];
  }
;}

$js= "window.suggestions=" . json_encode( $suggestions).";";
header('Content-Type:text/javascript');
echo $js;*/
?>

<section class="header">

    <h1>CARE MEDS</h1>
  
    
</section>
<section>
<div class="title">
  <h2>Categories</h2>
</div>

<!--product category cards-->
<div>
<a href="../php/tablets.php">
<div class="row">
  <div class="column">
    <div class="cat">
        <img src="../images/drugs.png" >
        <h4><b>TABLETS</b></h4>
 
    </div>
  </div>
</a>
<a href="../php/syrups.php">
  <div class="column">
    <div class="cat">
        <img src="../images/syrup.png" >
            <div class="container">
              <h4><b>SYRUPS</b></h4>
             
              
            </div></div>
  </div></a>
  <a href="../php/eye.php">
  <div class="column">
    <div class="cat">
        <img src="../images/eyecare.png" >
            <div class="container">
              <h4><b>EYECARE</b></h4>
 
            </div>
          </div>
  </div>
</a>
<a href="../php/hair.php">
  <div class="column">
    <div class="cat">
        <img src="../images/shampoo.png" >
            <div class="container">
              <h4><b>HAIRCARE</b></h4>
 
            </div></div>
  
</div></a>
<a href="../php/vitamins.php">
<div class="column">
    <div class="cat">
        <img src="../images/supplement.png" >
            <div class="container">
              <h4><b>VITAMINS</b></h4>
            
              
            </div>
  </div>
</div>
</a>
</div> 
</section> <br>
<br><hr><br>

<!--all product view-->
<section>
<div class="title">
  <h2>All products</h2>
</div>
<?php

 // php for product page main view
$all_product = "SELECT * FROM products ";
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
            <div class="container">
              <h4 class="Pname"><b><?php echo $row["productNmae"];?></b></h4>
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
;};};}
/*
if(isset($_POST['search_data'])){
$user_search = $_POST['search_product'];
$search =mysqli_query($conn,"SELECT * FROM products WHERE productNmae LIKE '%$user_search%'");
if(mysqli_num_rows($result)>0){
  
  //output the data of each row
  while($row = mysqli_fetch_assoc($result)){
    $productId = $row["productId"];*/
    ?>
      
   <!--   <form action="details.php" method="POST" name="viewform">
      <a href="../php/details.php?ID=<?//=$productId;?>">
      <div class="column">
          <div class="card">
              <img src="../images/<?php// echo $row["images"];?>" >
                  <div class="container">
                    <h4 class="Pname"><b><?php//// echo $row["productNmae"];?></b></h4>
      </form>
        <form action="" method="POST" name="cart">
            <input type="hidden" name="pID" value="<?php //echo $row["productId"];?>">
            <input type="hidden" name="price" value="<?php// echo $row["productPrice"] ;?>">
            <input type="hidden" name="img" value="<?php //echo $row["images"] ;?>">
             <input type="hidden" name="cId" value="<?php //echo  $crow["cusId"] ;?>">
            <input type="submit" name="addtocart" value="Add to cart" class="btn">
         </form>
                  </div>
          
                  </div>
        </div>
      
      </a> -->



</section>
<?php
   /* ;}
;};};}*/
?>


</body>
</html>