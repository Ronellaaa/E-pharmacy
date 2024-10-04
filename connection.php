<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost";
$username = "root";
$password = "Oggy2012";
$db_name = "pharmacydatabase";


$conn = new mysqli($servername, $username, $password, $db_name, 3308);


if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>
