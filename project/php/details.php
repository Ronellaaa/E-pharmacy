<?php
require '../../dbconnection.php';
//get the selected product id
if(isset($_GET['ID']) ){

    $productId = $_GET['ID'];

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
     
        <form action="" method="POST" name="cart">
              <input type="hidden" name="pID" value="<?php echo $row["productId"];?>">
              <input type="hidden" name="price" value="<?php echo $row["productPrice"] ;?>">
              <input type="hidden" name="img" value="<?php echo $row["image_path"] ;?>">
              <input type="hidden" name="cId" value="<?php echo  $crow["custId"] ;?>">
              <input type="submit" name="addtocart" value="Add to cart" >
              </form>
      

    </div>
</div>

<?php
    ;}
;};};}
?>

<?php
include('../../hompage-footer.php');
?>
</body>
</html>