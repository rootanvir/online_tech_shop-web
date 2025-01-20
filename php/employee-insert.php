<?php
include 'db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $employee_id = $_POST['employee_id'];
    $employee_password = $_POST['employee_password'];
    $employee_mobile_number = $_POST['employee_mobile_number'];
    $employee_email = $_POST['employee_email'];
    $employee_name = $_POST['employee_name'];
    $employee_gender = $_POST['employee_gender'];
    $employee_dob = $_POST['employee_dob'];
    $employee_address = $_POST['employee_address'];
    $employee_role = $_POST['employee_role'];
    $employee_joining_date = $_POST['employee_joining_date'];
    $employee_salary = $_POST['employee_salary'];

    // Create the SQL query
    $sql = "INSERT INTO employee (employee_id, employee_password, employee_mobile_number, employee_email, 
            employee_name, employee_gender, employee_dob, employee_address, 
            employee_role, employee_joining_date, employee_salary) 
            VALUES ('$employee_id', '$employee_password', '$employee_mobile_number', '$employee_email', 
            '$employee_name', '$employee_gender', '$employee_dob', '$employee_address', 
            '$employee_role', '$employee_joining_date', $employee_salary)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Employee record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
