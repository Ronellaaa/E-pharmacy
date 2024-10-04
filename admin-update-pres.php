<?php
require 'dbconnection.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $id = $_POST['id'];
  $status = $_POST['status'];

  $query = "UPDATE prescriptions SET status = '$status' WHERE id = '$id' ";

  if(mysqli_query($conn,$query)){
    header('Location: admin-view-pres.php');
  } else {
    echo "Error updating record: " . mysqli_error($conn);
}
}
$conn->close();
?>