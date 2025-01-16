<?php
// Allow Cross-Origin requests if needed
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Get the JSON data sent via POST
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['productId']) && isset($data['quantity'])) {
    $productId = $data['productId'];
    $quantity = $data['quantity'];

    // Get current cart from session (or create an empty array if not present)
    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product already exists in the session cart
    $existingProductIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['productId'] == $productId) {
            $existingProductIndex = $index;
            break;
        }
    }

    if ($existingProductIndex !== -1) {
        // If the product exists, update the quantity
        $_SESSION['cart'][$existingProductIndex]['quantity'] += $quantity;
    } else {
        // If the product doesn't exist, add it to the cart
        $_SESSION['cart'][] = ['productId' => $productId, 'quantity' => $quantity];
    }

    // Respond with success message
    echo json_encode(['status' => 'success', 'message' => "Product ID $productId added to cart with quantity $quantity."]);
} else {
    // Respond with an error if productId or quantity is not provided
    echo json_encode(['status' => 'error', 'message' => 'Missing productId or quantity']);
}
?>
