<?php
// Database configuration
include 'db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer data
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

echo "<h1>Customer Information</h1>";
?>

<!-- Search Box -->
<input type="text" id="customerSearchInput" onkeyup="customerSearchTable()" placeholder="Search for customers...">

<?php
if ($result->num_rows > 0) {

    echo "<div>";

    // Start table and apply some inline styles
    echo "<table id='customerTable'>
            <tr>
                <th>Mobile Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Date of Birth</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['customer_mobile_number']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['customer_email']}</td>
                <td>{$row['customer_address']}</td>
                <td>{$row['customer_dob']}</td>
              </tr>";
    }

    echo "</table>";
    echo "</div>"; // End scrollable container
} else {
    echo "No customers found.";
}

// Close connection
$conn->close();
?>


<script src="../js/search_table.js"></script>

<link rel="stylesheet" href="../css/loadCustomerList.css">