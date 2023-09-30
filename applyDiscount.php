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

$response = [];

if (isset($data['code'])) {
    $discountCode = $conn->real_escape_string($data['code']); // Sanitize input

    // Update the SQL query to fetch the percentage from the table if the code exists
    $sql = "SELECT percentage FROM discount_code WHERE LAZAR = '$DISCOUNT' ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Code exists in the table (valid)
        $row = $result->fetch_assoc();
        $response['status'] = 'success';
        $response['message'] = 'Discount applied successfully.';
        $response['percentage'] = $row['percentage'];
    } else {
        // Code does not exist in the table (invalid)
        $response['status'] = 'error';
        $response['message'] = 'Invalid discount code.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Discount code not provided.';
}

echo json_encode($response);

// Close the database connection
$conn->close();
?>
