<?php
// Include database connection
include 'db_connection.php';

// Get the search query from the POST request
$searchQuery = isset($_POST['query']) ? $_POST['query'] : '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query to search for matching products
$sql = "SELECT product_id, product_category, product_name, product_price, product_quantity, product_location 
        FROM product 
        WHERE product_name LIKE ? OR product_category LIKE ? OR product_location LIKE ?";

// Use a prepared statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $searchQuery . '%';
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

$filteredProducts = [];

// Fetch the matching rows and add them to the array
while ($row = $result->fetch_assoc()) {
    $filteredProducts[] = $row;
}

// If no products found, send a message
if (count($filteredProducts) == 0) {
    echo '<p>No products found.</p>';
} else {
    // Display the products in the same structure as your loadProduct.html
    foreach ($filteredProducts as $product) {
        echo '
        <div class="product-item">
            <h3>' . htmlspecialchars($product['product_name']) . '</h3>
            <p><strong>Category:</strong> ' . htmlspecialchars($product['product_category']) . '</p>
            <p><strong>Price:</strong> $' . htmlspecialchars($product['product_price']) . '</p>
            <p><strong>Quantity:</strong> ' . htmlspecialchars($product['product_quantity']) . '</p>
            <p><strong>Location:</strong> ' . htmlspecialchars($product['product_location']) . '</p>
        </div>';
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
