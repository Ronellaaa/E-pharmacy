<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$isMac = (PHP_OS === 'Darwin');

$servername = "localhost";
$username = "root";
$password = $isMac ? 'Oggy2012' : ''; 
$db_name = "pharmacydatabase";


$conn = new mysqli($servername, $username, $password, $db_name, 3306);


if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>
