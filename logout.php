<?php
session_start();

// Clear session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to home.php or any other page
header('Location:index.php');
exit;
?>