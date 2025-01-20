<?php
$productsFile = '../json/products.json';
$searchedFile = '../json/searched.json';
$searchQuery = isset($_POST['query']) ? $_POST['query'] : '';
$productsData = file_get_contents($productsFile);
$products = json_decode($productsData, true);
$filteredProducts = array_filter($products, function($product) use ($searchQuery) {
    return stripos($product['product_name'], $searchQuery) !== false;
});
file_put_contents($searchedFile, json_encode(array_values($filteredProducts), JSON_PRETTY_PRINT));
?>