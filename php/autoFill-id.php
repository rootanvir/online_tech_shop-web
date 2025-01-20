<?php
include 'db_connection.php';
$query = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastId = $row['product_id'];

    $newId = str_pad((int) $lastId + 1, 4, "0", STR_PAD_LEFT);
} else {
    // Start with 0001 if no ID found
    $newId = "0001";
}

$conn->close();

?>