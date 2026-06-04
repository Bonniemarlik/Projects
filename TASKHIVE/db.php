<?php
$host = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$dbname = "taskhive_db";

// Establish a connection to the MySQL server
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection established successfully
if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error());
}

// NOTE: Comment out or remove this message once you have captured your logbook screenshot!
// echo "✅ Database Connection Successful! Ready for TaskHive development.";
?>