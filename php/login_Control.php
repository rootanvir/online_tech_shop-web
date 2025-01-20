<?php
// Start the session to store user data
session_start();

// Database configuration
include 'db_connection.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$user_input_username = $_POST['username']; 
$user_input_password = $_POST['password'];

$query = "SELECT * FROM customer WHERE customer_mobile_number = '$user_input_username' AND customer_password = '$user_input_password'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $_SESSION['username'] = $user_input_username;
    $_SESSION['role'] = 'Customer'; // Set role as customer
    header("Location: ../index.html"); // Redirect to customer dashboard
    exit();
} else {
    $query = "SELECT * FROM employee WHERE employee_id = '$user_input_username' AND employee_password = '$user_input_password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // If user found in 'employee' table
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $user_input_username; 
        $_SESSION['role'] = $row['employee_role']; 
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
        echo "Invalid username or password.";

        header("Location: ../html/signin.html?error=1");
        exit();
    }
}

// Close the connection
$conn->close();
?>
