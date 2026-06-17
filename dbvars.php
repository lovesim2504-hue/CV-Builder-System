<?php
// Database connection settings
$servername = "localhost";   // usually localhost for XAMPP
$username = "root";          // default XAMPP username
$password = "";              // default XAMPP password is blank
$dbname = "sitedb";  // change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
