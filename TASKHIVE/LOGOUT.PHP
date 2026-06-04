<?php
session_set_cookie_params(0);
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the active session
header("Location: login.php"); // Clear path back to login screen
exit();
?>