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

// Display customer data in a table
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width:100%; text-align:left;'>";
    echo "<tr>
            <th>Mobile Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date of Birth</th>
          </tr>";

    // Loop through and display each row of data
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
} else {
    echo "No customers found.";
}

// Close connection
$conn->close();
?>
