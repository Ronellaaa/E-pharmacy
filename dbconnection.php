<?php
$servername = "localhost";
$username = "root";
$password = "Oggy2012";
$dbname = "pharmacydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>