<?php
// Set CORS headers to allow requests from any origin
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type");
// Database configuration
$host = 'localhost'; // Your database host
$username = 'root';  // Your database username
$password = '';      // Your database password
$database = 'popust_db'; // Your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the POST request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name']) && isset($data['price']) && isset($data['description'])) {
    // Prepare and execute the SQL query to insert a new product
    $name = $conn->real_escape_string($data['name']);
    $price = $conn->real_escape_string($data['price']);
    $description = $conn->real_escape_string($data['description']);

    $sql = "INSERT INTO products (name, price, description) VALUES ('$name', '$price', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'Product created successfully.'));
    } else {
        echo json_encode(array('message' => 'Error: ' . $sql . '<br>' . $conn->error));
    }
} else {
    // Required data is missing
    echo json_encode(array('message' => 'Incomplete data. Please provide name, price, and description.'));
}

// Close the database connection
$conn->close();
?>
