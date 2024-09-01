<?php
$servername = "localhost";
$username = "root";  // Ensure this is exactly "qqq"
$password = "";  // Ensure this is exactly "1111"
$dbname = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
