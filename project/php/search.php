<?php
require 'connect.php';
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
    
</body>
</html>

<?php 
if(isset($_GET['search_data'])){
$user_search = $_GET['query'];

}else{
    echo "pleaseenter name correctly...";
}

$search =mysqli_query($conn,"SELECT * FROM products WHERE productNmae LIKE '%$user_search%'");
if(mysqli_num_rows($search)>0){
  
  //output the data of each row
  while($row = mysqli_fetch_assoc($search)){
    $productId = $row["productId"];
    ?>
      
      <form action="details.php" method="POST" name="viewform">
<a href="../php/details.php?ID=<?=$productId;?>">
<div class="column-1">
    <div class="card">
        <img src="../images/<?php echo $row["images"];?>" >
            <div class="container-2">
              <h4><b><?php echo $row["productNmae"];?></b></h4>

              </form></a>
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
      ;};};
      ?>