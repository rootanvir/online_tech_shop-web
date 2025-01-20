<?php
session_start();
include 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['username'])) {
        header('Location: ../html/signin.html');
        exit();
    }

    $username = $_SESSION['username']; // Ensure session is set, default to 'guest'
    $paymentMethod = $_POST['payment-method'];
    $totalCost = $_POST['total-cost'];
    $status = 'pending';
    // Generate order ID
    $query = "SELECT order_id FROM ordered ORDER BY order_id DESC LIMIT 1";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $newOrderId = str_pad($row['order_id'] + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $newOrderId = '0001';
    }

    // Insert into database
    $query = "INSERT INTO ordered (order_id, customer_mobile_number, total_cost, payment_method,order_status) 
              VALUES ('$newOrderId', '$username', '$totalCost', '$paymentMethod','$status')";

    $sqq = "INSERT INTO `sells` (`customer_mobile_number`, `price`, `time`, `payment_method`) VALUES ('$username', '$totalCost', NOW(), '$paymentMethod')";
    if ($conn->query($query) && $conn->query($sqq) === TRUE) {
        // Order placed successfully
        echo "
            <style>
                .order-slip {
                    border: 1px solid #ddd;
                    padding: 20px;
                    margin-top: 20px;
                    background-color: #f9f9f9;
                    width: 80%;
                    margin-left: auto;
                    margin-right: auto;
                    text-align: center;
                }

                .order-slip h2 {
                    color: green;
                }

                .order-slip p {
                    font-size: 16px;
                }

                .order-slip button {
                    padding: 10px 20px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                }

                .order-slip button:hover {
                    background-color: #45a049;
                }
            </style>
            <div class='order-slip'>
                <h2>Order Placed Successfully!</h2>
                <p>Your Order ID is: <strong>$newOrderId</strong></p>
                <p>Total Cost: <strong>৳$totalCost</strong></p>
                <p>Payment Method: <strong>$paymentMethod</strong></p>
                <button onclick='window.print();'>Print this Page</button>
                <button onclick='window.location.href = \"../index.html\";'>Go back to Home page</button>
            </div>
        ";
    } else {
        echo "Error placing the order: " . $conn->error;
    }

    $conn->close();
}
