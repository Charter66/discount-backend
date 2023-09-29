

<?php
include 'config.php';

$query = "SELECT * FROM products";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Name: " . $row['name'] . " - Price: " . $row['price'] . " - Description: " . $row['description'] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
