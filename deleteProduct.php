


<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
include 'config.php';

//Retrieve product ID from POST request 
$id = $_POST['id'];


//Delete product from the database
$query = "DELETE FROM products WHERE id=$id";
$result = $conn->query($query)

if($result) {
    echo "Product deleted successfully";

}else {
    echo "Error: ", $query, "<br>", $conn-error;
}

$conn->close();
?>