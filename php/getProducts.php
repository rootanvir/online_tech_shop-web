<?php
include "db_connection.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT product_id, product_name, product_price, product_location FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $jsonPath = '../json/products.json';
    if (file_put_contents($jsonPath, json_encode($products, JSON_PRETTY_PRINT))) {
    } else {
        error_log("Error: Failed to write JSON file.");
    }
} else {
    file_put_contents('../json/products.json', json_encode([]));
}

$conn->close();
?>
