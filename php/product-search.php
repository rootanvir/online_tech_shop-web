<?php
include 'db_connection.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';

$sql = "SELECT * FROM product WHERE product_name LIKE ?";

$stmt = $conn->prepare($sql);

$searchTerm = "%" . $searchQuery . "%";
$stmt->bind_param("s", $searchTerm);

$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode(['products' => $products]);

$stmt->close();
$conn->close();
?>
