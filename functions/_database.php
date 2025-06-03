<?php
$prefix = "da7_";
$servername = "localhost";  // Change if needed
$username = "root";         // Your DB username
$password = "";             // Your DB password
$dbname = $prefix . "seeds";  // Your database name

// Establish the connection using mysqli_connect
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>