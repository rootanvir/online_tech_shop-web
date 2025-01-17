<?php
// Database configuration
include 'db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id_to_edit = '';
$product_category = '';
$product_name = '';
$product_price = '';
$product_quantity = '';

// Handle form submission for updating and deleting products
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_product'])) {
        $product_id = $_POST['product_id'];
        $product_category = $_POST['product_category'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];

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
        $product_id = $_POST['product_id'];

        $sql = "DELETE FROM product WHERE product_id = '$product_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Product deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// Fetch data for editing
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $sql = "SELECT * FROM product WHERE product_id = '$edit_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_id_to_edit = $row['product_id'];
        $product_category = $row['product_category'];
        $product_name = $row['product_name'];
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
    }
}

// Fetch all product data
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List and Update Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            display: flex;
            gap: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .product-list,
        .form-container {
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f9;
        }

        table img {
            max-width: 60px;
            max-height: 60px;
        }

        .form-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container form button {
            display: block;
            width: 100%;
            background: #4CAF50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container form button:hover {
            background: #45a049;
        }

        .action-buttons {
            white-space: nowrap;
        }

        .action-buttons form,
        .action-buttons a {
            display: inline;
        }

        .action-buttons button,
        .action-buttons a {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 5px;
        }

        .action-buttons button {
            color: red;
        }

        .action-buttons a {
            color: blue;
            text-decoration: none;
        }
    </style>
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
                        <th>Actions</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['product_id']) ?></td>
                            <td><?= htmlspecialchars($row['product_category']) ?></td>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td><?= htmlspecialchars($row['product_price']) ?></td>
                            <td><?= htmlspecialchars($row['product_quantity']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($row['product_location']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
                            </td>
                            <td class="action-buttons">
                                <form method="POST" action="">
                                    <a href="?edit_id=<?= $row['product_id'] ?>" title="Edit">✏️</a>
                                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                    <button type="submit" name="delete_product" onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">❌</button>
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
                <input type="text" id="product_id" name="product_id" value="<?= $product_id_to_edit ?>" disabled>

                <label for="product_category">Category</label>
                <input type="text" id="product_category" name="product_category" value="<?= $product_category ?>" required>

                <label for="product_name">Name</label>
                <input type="text" id="product_name" name="product_name" value="<?= $product_name ?>" required>

                <label for="product_price">Price</label>
                <input type="number" id="product_price" name="product_price" value="<?= $product_price ?>" step="0.01" required>

                <label for="product_quantity">Quantity</label>
                <input type="number" id="product_quantity" name="product_quantity" value="<?= $product_quantity ?>" required>

                <button type="submit" name="update_product">Update Product</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php $conn->close(); ?>