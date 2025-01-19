<?php
// Start the session to store user data
session_start();

// Database configuration
include 'db_connection.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$user_input_username = $_POST['username']; // Use a distinct variable for user-provided username
$user_input_password = $_POST['password'];

// Check in the 'customer' table
$query = "SELECT * FROM customer WHERE customer_mobile_number = '$user_input_username' AND customer_password = '$user_input_password'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // If user found in 'customer' table
    $_SESSION['username'] = $user_input_username;
    $_SESSION['role'] = 'Customer'; // Set role as customer
    header("Location: ../index.html"); // Redirect to customer dashboard
    exit();
} else {
    // Check in the 'employee' table
    $query = "SELECT * FROM employee WHERE employee_id = '$user_input_username' AND employee_password = '$user_input_password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // If user found in 'employee' table
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $user_input_username; // Store user-provided username in session
        $_SESSION['role'] = $row['employee_role']; // Set role based on employee table
        echo "<h1>".$_SESSION['role'] ." </h1>";
        // Redirect based on role
        if ($_SESSION['role'] === 'Manager') {
            header("Location: ../html/managerDash.html");
        } elseif ($_SESSION['role'] === 'Admin') {
            header("Location: ../html/adminDash.html");
        }elseif ($_SESSION['role'] === 'CEO') {
            header("Location: ../html/adminDash.html");
        }
        exit();
    } else {
        // If no user found, redirect back to login page with error
        echo "Invalid username or password.";
        header("Location: signin.html");
        exit();
    }
}

// Close the connection
$conn->close();
?>
