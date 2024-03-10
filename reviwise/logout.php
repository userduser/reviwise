<?php
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the index page or any other page you prefer
header("Location: /reviwise/index.html");
exit();
?>
