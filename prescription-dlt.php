
<?php
require 'dbconnection.php';

if(isset($_GET['delete_id'])){
  $id= $_GET['delete_id'];
  $query = "DELETE FROM prescriptions WHERE id=?";
  $stmt = $conn->prepare($query);
  $stmt-> bind_param("i",$id);

if($stmt->execute()){
  header("Location: prescription.php");
  exit();
}else{
  echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
}
?>