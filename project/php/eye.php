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
    <link rel="stylesheet" href="../css/eye.css"/>
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
<div class="topnav">
  <a href="../php/tablets.php" >Tablets</a>
  <a href="../php/syrups.php">Syrups</a>
  <a href="../php/hair.php">Hair Care</a>
  <a href="../php/eye.php" class="active">Eye Care</a>
  <a href="../php/vitamins.php">Vitamins</a>
</div>
 <!--search bar-->
 <form  action="">
    <div class="search">
  <input type="search" placeholder="Search here..." required>
  <button type="submit">Search</button>
  </div>
</form> 
<!--header-->
<div class="header">
    <img src="../images/eye.jpg" >
   <div class="text">
    <h1>EYE CARE</h1>
    <p>Sight and the hearing are the most vital senses,allowing us to navigate the world ,connect with others and experience the beauty around us. So it’s important that people take care of their both eyes and ears. At Care Meds, we understand the importance and provide you with the highest quality eye and ear care products and services. Our wide selection of products can help you treat dry, itchy, sore, or bloodshot eyes, as well as ear infections, swimmer's ear, and hearing loss. Shop our ear and eye care essentials today and start enjoying better vision and hearing!</</p>
    </div>
</div>


<?php

 // php for product page main view
$all_product = "SELECT * FROM products WHERE categoryId = '2' ORDER BY productId DESC";
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
              <h4><b><?php echo $row["productNmae"];?></b></h4>

              </form>
               <form action="" method="POST" name="cart">
              <input type="hidden" name="pID" value="<?php echo $row["productId"];?>">
              <input type="hidden" name="price" value="<?php echo $row["productPrice"] ;?>">
              <input type="hidden" name="img" value="<?php echo $row["images"] ;?>">
              <input type="hidden" name="cId" value="<?php echo  $crow["cusId"] ;?>">
              <input type="submit" name="addtocart" value="Add to cart" >
              </form>
            </div>
            
              
            </div>

  </div>

</a>

<?php
    ;}
;};}
?>
</body>
</html>