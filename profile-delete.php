<?php
// Include config file
require 'dbconnection.php';
session_start();

if(isset($_GET['deleteId'])){
    $custID = intval($_GET['deleteId']);

    $sql = 'DELETE FROM customer WHERE custId = ?';

    if($stmt = $conn->prepare($sql)){
        $stmt -> bind_param('i',$custID);

        if($stmt ->execute()){
            header('Location:logout.php');
            exit();

        }else{
            echo "Error deleting product: ".$stmt->error;
        }

    }else{
        echo("Invalid product Id");
    }
}
