<?php


// Check if the script is running on a Mac
$isMac = (PHP_OS === 'Darwin');

// Database connection variables
$servername = "localhost";
$username = "root"; 
$password = '';
$dbname = "pharmacydatabase"; 

// Get the system username to determine the correct password
$systemUser = get_current_user(); 

// Set the password based on the user
if ($isMac) {
    if ($systemUser === 'ronelladias') { // For your friend Alice
        $password = 'Oggy2012'; // Alice's password
    } elseif ($systemUser === 'onelladias') { // For you
        $password = ''; // No password for your setup
    }
}

// Create the MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>