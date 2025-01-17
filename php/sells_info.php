<?php
// Include the database connection
include('db_connection.php');

// Fetch sales data for the table
$sql_table = "SELECT sell_id, customer_name, customer_email, products, quantity, price, time FROM sells";
$result_table = mysqli_query($conn, $sql_table);

// Fetch sales data for the chart
$sql_chart = "SELECT products, SUM(quantity) AS total_quantity FROM sells GROUP BY products";
$result_chart = mysqli_query($conn, $sql_chart);

$products = [];
$quantities = [];

// Process data for the chart
while ($row = mysqli_fetch_assoc($result_chart)) {
    $products[] = $row['products'];
    $quantities[] = $row['total_quantity'];
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Data and Statistics</title>
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

        .table-container {
            max-height: 250px;
            overflow-y: auto;
            border: 1px solid #ccc;
        }

        canvas {
            margin: 20px 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pass PHP data to JavaScript
        const products = <?php echo json_encode($products); ?>;
        const quantities = <?php echo json_encode($quantities); ?>;
    </script>
    <script src="../js/sell_statistic.js" defer></script>
</head>

<body>
    <h1>Sales Information</h1>

    <!-- Scrollable Sales Table -->
    <div class="table-container">
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
                if (mysqli_num_rows($result_table) > 0) {
                    // Fetch each row and display it
                    while ($row = mysqli_fetch_assoc($result_table)) {
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
                ?>
            </tbody>
        </table>
    </div>

    <!-- Sales Statistics Chart -->
    <h1>Sales Statistics</h1>
    <canvas id="salesChart" width="800" height="400"></canvas>
</body>

</html>