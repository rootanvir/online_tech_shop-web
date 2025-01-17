<?php
// Database configuration
include 'db_connection.php';
// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee data
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

echo "<h1>Employee Information</h1>";

// Check if any data was returned
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style=width:100%>";
    echo "<tr>
            <th>Employee ID</th>
            <th>Password</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Role</th>
            <th>Joining Date</th>
            <th>Salary</th>
          </tr>";

    // Loop through and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['employee_id']}</td>
                <td style=color:red><!--{$row['employee_password']}-->Confidential data</td>
                <td>{$row['employee_mobile_number']}</td>
                <td>{$row['employee_email']}</td>
                <td>{$row['employee_name']}</td>
                <td>{$row['employee_gender']}</td>
                <td>{$row['employee_dob']}</td>
                <td>{$row['employee_address']}</td>
                <td>{$row['employee_role']}</td>
                <td>{$row['employee_joining_date']}</td>
                <td>{$row['employee_salary']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No employee data found.";
}

// Close connection
$conn->close();
