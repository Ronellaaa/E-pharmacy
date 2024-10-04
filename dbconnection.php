<?php

$isMac = (PHP_OS === 'Darwin');

$servername = "localhost";
$username = "root";
$password = $isMac ? 'Oggy2012' : ''; 
$dbname = "pharmacydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>