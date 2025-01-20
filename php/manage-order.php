<?php
session_start();
include 'db_connection.php'; // Include your database connection file


$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search_term'];
    $query = "SELECT * FROM ordered WHERE order_id LIKE '%$searchQuery%' OR customer_mobile_number LIKE '%$searchQuery%' ORDER BY order_id DESC";
} else {
    $query = "SELECT * FROM ordered ORDER BY order_id DESC";
}

$result = $conn->query($query);

// Handle status update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE ordered SET order_status = '$status' WHERE order_id = '$order_id'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>showToast('Order status updated successfully!', 'success', 2000);</script>";
        echo "<script>window.location.href = 'manage-order.php';</script>";
    } else {
        echo "<script>showToast('Error updating order status: " . $conn->error . "', 'error', 2000);</script>";
        echo "<script>window.location.href = 'manage-order.php';</script>";
    }
}

if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];

    $deleteQuery = "DELETE FROM ordered WHERE order_id = '$order_id'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "<script>showToast('Order deleted successfully!', 'success', 2000);</script>";
        echo "<script>window.location.href = 'manage-order.php';</script>";
    } else {
        echo "<script>showToast('Error deleting order: " . $conn->error . "', 'error', 2000);</script>";
        echo "<script>window.location.href = 'manage-order.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track order</title>
    <link rel="stylesheet" href="../css/manage-order.css">
    <link rel="stylesheet" href="../css/toast.css">
</head>
<body>
    <main>
        <div class="admin-panel">
            <h2>Order Management</h2>

            <!-- Search Form -->
            <form method="POST" action="" class="search-form">
                <input type="text" name="search_term" value="<?php echo $searchQuery; ?>" placeholder="Search by Order ID or Customer" required>
                <button type="submit" name="search">Search</button>
            </form>

            <?php if ($result->num_rows > 0): ?>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Mobile</th>
                            <th>Total Cost</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['customer_mobile_number']; ?></td>
                                <td>$<?php echo number_format($row['total_cost'], 2); ?></td>
                                <td><?php echo ucfirst($row['payment_method']); ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                        <select name="status">
                                            <option value="Pending" <?php echo ($row['order_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Shipped" <?php echo ($row['order_status'] == 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
                                            <option value="Delivered" <?php echo ($row['order_status'] == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                                        </select>
                                        <button type="submit" name="update_status">Update</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                        <button type="submit" name="delete_order" onclick="return confirm('Are you sure you want to delete this order?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No orders found.</p>
            <?php endif; ?>
        </div>
        <div id="toast-container"></div>
    </main>
    <script src="../js/toast.js"></script>
</body>
</html>

<?php
$conn->close(); // Close database connection
?>
