

<?php
$host = 'localhost';
$db   = 'popust_db';  // Replace with the name of your database
$user = 'root';
$pass = '';   // Assuming no password for local MySQL

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
