<?php
header('Content-Type: application/json');

// Load products from the JSON file
$products = json_decode(file_get_contents('../json/products.json'), true);
$productsPerPage = 12; // Number of products per page

// Get the current page number (default to 1 if not provided)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting index for slicing
$start = ($page - 1) * $productsPerPage;

// Slice the products array to get products for the current page
$paginatedProducts = array_slice($products, $start, $productsPerPage);

// Calculate the total number of pages
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $productsPerPage);

// Return the paginated products, total number of products, and total pages as JSON
echo json_encode([
    'products' => $paginatedProducts,
    'totalPages' => $totalPages
]);
?>
