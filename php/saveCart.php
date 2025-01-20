<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['productId']) && isset($data['quantity'])) {
    $productId = $data['productId'];
    $quantity = $data['quantity'];

    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $existingProductIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['productId'] == $productId) {
            $existingProductIndex = $index;
            break;
        }
    }

    if ($existingProductIndex !== -1) {
        $_SESSION['cart'][$existingProductIndex]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][] = ['productId' => $productId, 'quantity' => $quantity];
    }

    echo json_encode(['status' => 'success', 'message' => "Product ID $productId added to cart with quantity $quantity."]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing productId or quantity']);
}
?>
