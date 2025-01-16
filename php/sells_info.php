<?php
// Include the database connection
include('db_connection.php'); // Assuming the database connection code is saved in db_connection.php

// Fetch the sales data
$sql = "SELECT sell_id, customer_name, customer_email, products, quantity, price, time FROM sells";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Sales Data</h1>
    <table>
        <thead>
            <tr>
                <th>Sell ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Products</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                // Fetch each row and display it
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['sell_id']}</td>
                        <td>{$row['customer_name']}</td>
                        <td>{$row['customer_email']}</td>
                        <td>{$row['products']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['time']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No sales data found</td></tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>

</html>