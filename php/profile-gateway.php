<?php
// Start session if not already started
session_start();

// Check if user role is set in the session
if (!isset($_SESSION['role'])) {
    // If user role is not set, redirect to the sign-in page
    header('Location: ../html/signin.html');
    exit();
}

// Assuming user data is stored in session, you can access the user's role
$user_role = $_SESSION['role']; // This can be 'admin', 'customer', 'guest', etc.

// Check the user's role and redirect accordingly
if ($user_role == 'Admin') {
    // Redirect to admin dashboard
    header('Location: ../html/adminDash.html');
    exit();
} elseif ($user_role == 'Customer') {
    // Redirect to customer profile page
    header('Location: profile.php');
    exit();
} elseif ($user_role == 'Manager') {
    // Redirect to the homepage or login page for guests
    header('Location: ../html/managerDash.html');
    exit();

}
elseif ($user_role == 'CEO') {
    // Redirect to the homepage or login page for guests
    header('Location: ../html/adminDash.html');
    exit();

}
else {
    // If role is undefined, redirect to login page
    header('Location: ../html/signin.html');
    exit();
}
?>
