<?php
include 'db_connection.php';

$sql = "SELECT sell_id, customer_mobile_number, price, DATE_FORMAT(time, '%Y-%m') as month, payment_method FROM sells";
$result = $conn->query($sql);

$sells_data = [];
$monthly_sales = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sells_data[] = $row;

        $month = $row['month'];
        $price = $row['price'];
        if (!isset($monthly_sales[$month])) {
            $monthly_sales[$month] = 0;
        }
        $monthly_sales[$month] += $price;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sells Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/sell_info.css">
    <script>
        // Pass PHP data to JavaScript
        const chartData = {
            months: <?= json_encode(array_keys($monthly_sales)) ?>,
            totals: <?= json_encode(array_values($monthly_sales)) ?>
        };

        // Log to check the data
        console.log(chartData); // Check if the data is passed correctly
    </script>
    <script src="../js/sell_statistic.js" defer></script>
</head>

<body>
    <div class="container">
        <h1>Sells Data</h1>
        <!-- Search Box -->
        <input type="text" id="sellsSearchInput" onkeyup="sellsSearchTable()" placeholder="Search for products...">
        <div class="table-container">

            <table id="sells_table" border="1">
                <thead>
                    <tr>
                        <th>Sell ID</th>
                        <th>Customer Mobile</th>
                        <th>Price</th>
                        <th>Time</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sells_data as $sell): ?>
                        <tr>
                            <td><?= htmlspecialchars($sell['sell_id']) ?></td>
                            <td><?= htmlspecialchars($sell['customer_mobile_number']) ?></td>
                            <td><?= htmlspecialchars($sell['price']) ?></td>
                            <td><?= htmlspecialchars($sell['month']) ?></td>
                            <td><?= htmlspecialchars($sell['payment_method']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="../js/search_table.js" defer></script>
        <h2>Monthly Sales Chart</h2>
        <canvas id="sales_chart"></canvas>
    </div>
</body>

</html>