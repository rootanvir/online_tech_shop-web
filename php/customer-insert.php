<?php
// Database configuration
include 'db_connection.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$mobile = $_POST['mobile'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$dob = $_POST['dob'];
$password = $_POST['password'];

$sql = "INSERT INTO customer (customer_mobile_number, customer_password, customer_name, customer_email, customer_address, customer_dob) 
        VALUES ('$mobile', '$password', '$name', '$email', '$address', '$dob')";

if ($conn->query($sql) === TRUE) {
    echo "Sign up successful! You can now <a href='../html/signin.html'>sign in</a>.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
