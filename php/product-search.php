<?php
// Include the database connection configuration
include 'db_connection.php';

// Create a connection to the database
// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the URL
$searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';

// SQL query to fetch products based on the search query
$sql = "SELECT * FROM product WHERE product_name LIKE ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameter (with % wildcards for the search)
$searchTerm = "%" . $searchQuery . "%";
$stmt->bind_param("s", $searchTerm);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Return the products as a JSON response
echo json_encode(['products' => $products]);

// Close the connection
$stmt->close();
$conn->close();
?>
