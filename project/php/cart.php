<?php
require 'connect.php';

if(isset($_POST['update'])){
    $update= $_POST['update_quan'];
    $cartId=$_POST['cartId'];
    $update_cart=mysqli_query($conn,"UPDATE cart SET quantity='$update' WHERE cartId ='$cartId'");
    if ($update_cart){
        header('location:cart.php');
    }

}

if(isset($_GET['remove'])){
    $removeId= $_GET['remove'];
   

    $delete_row=mysqli_query($conn,"DELETE FROM cart WHERE cartId ='$removeId'");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="../css/cart.css"/>
    <!--fontawsome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div id="wrapper">
    <h2 class="title">Shopping Cart</h2>
<!-- Cart -->
<div class="table">
<table class="tbl-cart">


<tr>
<th>Image</th>
<th>Product Name</th>
<th>Unit Price</th>
<th>Quantity</th>
<th>Sub Total</th>
<th>Remove</th>
</tr>
<?php
//select rows from the cart table
$show_cart = mysqli_query($conn,"SELECT * FROM cart ");
$total=0;

//if the selected rows no is more than 0
if(mysqli_num_rows($show_cart)>0){
    //output the data of each row
    while($row = mysqli_fetch_assoc($show_cart)){
        $pID = $row["productId"];
        //select images,productNmae rows from the product table where the selected productedid in cart table is equal to the product id in product table
        $show_cart2 = mysqli_query($conn,"SELECT images,productNmae FROM products WHERE productId ='$pID'");

        //output the data of each row
        if(mysqli_num_rows($show_cart)>0){

             while($row2 = mysqli_fetch_assoc($show_cart2)){

?>
<tr> 
<td>
<img src="../images/<?php echo $row2["images"];?>"></td>
<td><?php echo $row2["productNmae"];?></td>
<td class="price">Rs. <?php echo $row["price"];?>/-</td>


<form method="post">
<td>
<div class="input-group">
   
    <input type="hidden"   value="<?php echo $row["cartId"];?>" name="cartId">
<input type="number"  min="1" value="<?php echo $row["quantity"];?>" name="update_quan"><br>

<input type="submit" value="Update" name="update">

</div>
<td>Rs.<?php echo $sub_total=$row["price"] * $row["quantity"]  ;?>/-</td>

</td>
<td ><a href="cart.php?remove=<?php echo $row["cartId"];?>" onclick="return confirm('Want to remove item')" class="deletebtn"><i class="fa fa-trash-o"></i></a></td>

<?php
$total += $sub_total;
    ;}

;};};}
?>
</table>
</div>

<div class="summary">
            <div class="price">
                <p >Grand Total</p>
                <h6>Rs. <?php echo $total;?>/-</h6>

                
            </div>
    </div>
<div class="btn-group ">
<button  class="btn"><i class="fa fa-arrow-left"></i><a href="../php/product.php">&nbsp Continue shopping</a></button>

<button class="btn"><a href="../php/payment.php?TOTAL=<?=$total;?>">Checkout </a>&nbsp<i class="fa fa-arrow-right"></i> </button>
</div>
</form>
<!-- End Cart -->



</body>
</html>