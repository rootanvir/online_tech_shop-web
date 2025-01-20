<?php
session_start();
include 'db_connection.php'; 

if (!isset($_SESSION['username'])) {
    header('Location: ../html/signin.html'); 
    exit();
}

$username = $_SESSION['username']; 

$query = "SELECT * FROM ordered WHERE customer_mobile_number = '$username' ORDER BY order_id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order</title>
    <link rel="stylesheet" href="../css/track_order.css"> <!-- Link to your existing CSS file -->
</head>
<body>
    <header>
        <h1>Track Your Orders</h1>
        <button class="go-back-btn" onclick="window.location.href='../index.html';">Go Back to Home</button> <!-- Go back button -->
    </header>

    <main>
        <div class="order-list">
            <h2>Your Orders</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="order-card">
                        <h3>Order ID: <?php echo $row['order_id']; ?></h3>
                        <p><strong>Payment Method:</strong> <?php echo ucfirst($row['payment_method']); ?></p>
                        <p><strong>Total Cost:</strong> $<?php echo number_format($row['total_cost'], 2); ?></p>
                        <p><strong>Order Status:</strong> <?php echo ucfirst($row['order_status']); ?></p>
                        <button onclick="window.print();">Print Order Details</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>You don't have any orders yet.</p>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>

<?php
$conn->close(); // Close database connection
?>
