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

// Get the discount code from the POST request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['code'])) {
    $discountCode = $data['code'];

    // Prepare and execute the SQL query to check if the discount code exists in the table
    $sql = "SELECT * FROM discount_code WHERE LAZAR = 'DISCOUNT'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Code exists in the table (valid)
        echo json_encode(array('message' => 'Discount applied successfully.'));
    } else {
        // Code does not exist in the table (invalid)
        echo json_encode(array('message' => 'Invalid discount code.'));
    }
} else {
    echo json_encode(array('message' => 'Discount code not provided
    .'));
}

// Close the database connection
$conn->close();
?>
