


<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
    include 'config.php';

    //Retrieve data from POST request object
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    
    //Update product in the database

    $query = "UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE id = '$id'";
    $result = $conn->query($query);

    if($result) {
        echo "Product updated successfully!";
    }else {
        echo "Error: ", $query, "<br>", $conn-errormsg;
    }


    $conn->close();

?>