<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ayhf_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 25060);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
