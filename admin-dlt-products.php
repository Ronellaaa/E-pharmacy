
<?php
require 'dbconnection.php';

$productID = isset($_GET['id'])?intval($_GET['id']):0;
if($productID){
  $query = 'DELETE FROM products WHERE productId = ?';
  $stmt =$conn->prepare($query);
  $stmt -> bind_param('i',$productID);

  if($stmt->execute()){
    header('Location: admin-view-products.php');
    exit;
  }else{
    echo "Error deleting product: " . $stmt->error;
  }

}else{
  echo("Invalid ProductId");
}
$conn->close();


?>