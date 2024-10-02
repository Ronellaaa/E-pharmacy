<?php
// Include config file
require_once 'dbconnection.php';

if(isset($_GET['deleteId'])){
    $custID = intval($_GET['deleteId']);

    $sql = 'DELETE FROM customer WHERE custId = ?';

    if($stmt = $conn->prepare($sql)){
        $stmt -> bind_param('i',$custID);

        if($stmt ->execute()){
            header('Location:sign-Up.php');
            exit();

        }else{
            echo "Error deleting product: ".$stmt->error;
        }

    }else{
        echo("Invalid product Id");
    }
}

// // Start session
// session_start();

// // Check if the user is logged in
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: sign-Up.php");
//     exit;
// }

// // Get the email of the logged-in user
// $custID = $_SESSION['custId'];

// // Prepare and execute the DELETE query
// $sql = "DELETE FROM customer WHERE custId = ?";

// if ($stmt = $conn->prepare($sql)) {
//     // Bind parameters
//     $stmt->bind_param("i", $custID);
    
//     // Execute the prepared statement
//     if ($stmt->execute()) {
//         // Check if any rows were affected (user found and deleted)
//         if ($stmt->affected_rows === 1) {
//             // Destroy session and redirect to login page
//             session_destroy();
//             header("location: profile.php?success=delete");
//             exit;
//         } else {
//             echo "Profile not found or already deleted.";
//         }
//     } else {
//         echo "Error executing query: " . $stmt->error;
//     }

//     // Close the statement
//     $stmt->close();
// } else {
//     echo "Database error: Failed to prepare the statement: " . $conn->error;
// }

// // Close the connection
$conn->close();
?>

