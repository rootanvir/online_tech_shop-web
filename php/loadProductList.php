<?php
// Database configuration
include 'db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product data
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

// Check if any data was returned
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width:100%;'>";
    echo "<tr>
            <th>Product ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
          </tr>";

    // Loop through and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['product_id']}</td>
                <td>{$row['product_category']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['product_price']}</td>
                <td>{$row['product_quantity']}</td>
                <td><img src='{$row['product_location']}' alt='{$row['product_name']}' style='max-width:60px;'></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No product data found.";
}

// Close connection
$conn->close();
?>
