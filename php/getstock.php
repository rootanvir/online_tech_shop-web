<?php
header('Content-Type: application/json');

$productId = $_GET['productId'];

// Database connection
include 'db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Query for product quantity
$query = "SELECT product_quantity FROM product WHERE product_id = $productId";
$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode(['quantity' => $row['quantity']]);
} else {
    echo json_encode(['error' => 'Product not found']);
}

$conn->close();
?>
