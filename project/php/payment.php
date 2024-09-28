<?php
require 'connect.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="../css/payment.css"/>
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
<a href="../php/tablets.php" >Tablts</a>
<a href="../php/syrups.php">Syrups</a>
<a href="../php/hair.php" >Hair Care</a>
<a href="../php/eye.php">Eye Care</a>
<a href="../php/vitamins.php">Vitamins</a>
</div>
<section>
<div class="row">
<div class="container">
<form action="" method="post">
  <div class="col">
 
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com" required>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York" required>

      
            <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY" >
            
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001" >
                </div>
<div class="col2">

      <h2>Payment</h2><br><br>

  
            <label for="fname"><h4>Accepted Cards</h4></label>
            
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required disabled >
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required  disabled>
            <label for="expmonth">Exp date</label>
            <input type="date" id="expmonth" name="expmonth" placeholder="September" required disabled>
  </div>
          <div class="row">
          <div class="col2">
          <label for="payoption"><h3><b>Choose a payment option</b></h3></label><br><br>
            <input type="checkbox" id="checkbox1"  >&nbsp&nbsp Cash on delivery <br>
            <input type="checkbox" id="checkbox" onclick="enableinputs()"> &nbsp&nbsp Online transfer 
</div></div>
</div>
        <div class="row">
          
        <h4>Summary</h4>
       
       <span><div class="price" > 
       
<?php
if(isset($_GET['TOTAL'])){

  $total = $_GET['TOTAL'];

?>   
       <hr>
        <p >Total<h6 >Rs.<?php echo  number_format($total,2) ;?>/-</h6></p></div> </span> 
    </div> </div>
  
   <?php
   ;}
   ?>
        <div class="row">
       <input type="submit" value="Confirm" class="btn" onclick="message()">
       <input type="submit" value="View order Status" class="btn" >

     <script src="../js/payment.js"></script>
</div>
      </form>

</div></div>
</section> 

</body>
</html>