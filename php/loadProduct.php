<?php

// header('Content-Type: application/json');

// // Database connection
// include 'db_connection.php';

// // Check database connection
// if ($conn->connect_error) {
//     die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
// }

// // Fetch all products from the database
// $sql = "SELECT * FROM product";
// $result = $conn->query($sql);

// $products = [];
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $products[] = $row;
//     }
// }

// // Write products to a JSON file
// $jsonFilePath = '../json/products.json';
// if (file_put_contents($jsonFilePath, json_encode($products, JSON_PRETTY_PRINT)) === false) {
//     die(json_encode(['error' => 'Failed to create JSON file']));
// }

// // Pagination setup
// $productsPerPage = 12; // Number of products per page
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $start = ($page - 1) * $productsPerPage;

// // Slice the products array for the current page
// $paginatedProducts = array_slice($products, $start, $productsPerPage);

// // Calculate total pages
// $totalProducts = count($products);
// $totalPages = ceil($totalProducts / $productsPerPage);

// // Return the paginated products and total pages as JSON
// echo json_encode([
//     'products' => $paginatedProducts,
//     'totalPages' => $totalPages
// ]);

// // Close the database connection
// $conn->close();
?>


<?php

header('Content-Type: application/json');

// Database connection
include 'db_connection.php';

// Check database connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Get the search query from the URL (if available)
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Build the SQL query to fetch products (with search filter if provided)
$sql = "SELECT * FROM product";

// If there is a search query, add the search filter to the SQL query
if ($searchQuery) {
    $sql .= " WHERE product_name LIKE ? OR product_category LIKE ? OR product_location LIKE ?";
}

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind parameters to the query (if search is provided)
if ($searchQuery) {
    $searchTerm = '%' . $searchQuery . '%';
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch all products
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Pagination setup (if no search query, use pagination)
$productsPerPage = 12; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $productsPerPage;

// Slice the products array for the current page
$paginatedProducts = array_slice($products, $start, $productsPerPage);

// Calculate total pages
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $productsPerPage);

// Return the paginated products and total pages as JSON
echo json_encode([
    'products' => $paginatedProducts,
    'totalPages' => $totalPages
]);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
