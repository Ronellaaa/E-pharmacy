<?php
session_start();
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session
header("Location: home-page.php");  // Redirect to the homepage
exit();
?>