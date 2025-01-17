<?php
// Database configuration
include 'db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for updating and deleting products
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_product'])) {
        // Update product
        $product_id = $_POST['product_id'];
        $product_category = $_POST['product_category'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];

        // SQL UPDATE query
        $sql = "UPDATE product 
                SET product_category = '$product_category', 
                    product_name = '$product_name', 
                    product_price = '$product_price', 
                    product_quantity = '$product_quantity' 
                WHERE product_id = '$product_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product updated successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    if (isset($_POST['delete_product'])) {
        // Delete product
        $product_id = $_POST['product_id'];

        // SQL DELETE query
        $sql = "DELETE FROM product WHERE product_id = '$product_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product deleted successfully!');</script>";
        } else {
            echo "<script>alert('product " . $conn->error . "not deleted"."');</script>";
        }
    }
}

// Fetch product data
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List and Form</title>
    <link rel="stylesheet" href="../css/updateDelete.css">
</head>
<body>
    <div class="container">
        <!-- Product List -->
        <div class="product-list">
            <h2>Product List</h2>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Product ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['product_id']) ?></td>
                            <td><?= htmlspecialchars($row['product_category']) ?></td>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td><?= htmlspecialchars($row['product_price']) ?></td>
                            <td><?= htmlspecialchars($row['product_quantity']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($row['product_location']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" style="max-width: 60px;">
                            </td>
                            <td>
                                <!-- Delete Button -->
                                <form method="POST" action="" style="display: inline;">
                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                    <button type="submit" name="delete_product" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No product data found.</p>
            <?php endif; ?>
        </div>

        <!-- Update Form -->
        <div class="form-container">
            <h2>Update Product</h2>
            <form method="POST" action="">
                <label for="product_id">Product ID</label>
                <input type="text" id="product_id" name="product_id" value="<?= isset($_POST['product_id']) ? $_POST['product_id'] : '' ?>" required>

                <label for="product_category">Category</label>
                <input type="text" id="product_category" name="product_category" value="<?= isset($_POST['product_category']) ? $_POST['product_category'] : '' ?>" required>

                <label for="product_name">Name</label>
                <input type="text" id="product_name" name="product_name" value="<?= isset($_POST['product_name']) ? $_POST['product_name'] : '' ?>" required>

                <label for="product_price">Price</label>
                <input type="number" id="product_price" name="product_price" value="<?= isset($_POST['product_price']) ? $_POST['product_price'] : '' ?>" step="0.01" required>

                <label for="product_quantity">Quantity</label>
                <input type="number" id="product_quantity" name="product_quantity" value="<?= isset($_POST['product_quantity']) ? $_POST['product_quantity'] : '' ?>" required>

                <button type="submit" name="update_product">Update Product</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
