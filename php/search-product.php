<?php

// Path to the products JSON file
$productsFile = '../json/products.json';
$searchedFile = '../json/searched.json';

// Get the search query from the POST request
$searchQuery = isset($_POST['query']) ? $_POST['query'] : '';

// Read the existing products from the JSON file
$productsData = file_get_contents($productsFile);
$products = json_decode($productsData, true);

// Search through the products
$filteredProducts = array_filter($products, function($product) use ($searchQuery) {
    return stripos($product['product_name'], $searchQuery) !== false;
});

// Store the filtered products in searched.json
file_put_contents($searchedFile, json_encode(array_values($filteredProducts), JSON_PRETTY_PRINT));

?>
