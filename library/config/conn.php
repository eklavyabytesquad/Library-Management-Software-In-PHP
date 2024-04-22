<?php
// Database connection parameters
$servername = "localhost:3307"; // Replace with your MySQL server address
$username = "root"; // Replace with your MySQL username
$password = "T123ekl@arn"; // Replace with your MySQL password
$dbname = "library"; // Replace with the name of your library database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
