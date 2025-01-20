<?php
// Start session if not already started
session_start();

if (!isset($_SESSION['role'])) {
    header('Location: ../html/signin.html');
    exit();
}

$user_role = $_SESSION['role']; // This can be 'admin', 'customer', 'guest', etc.

if ($user_role == 'Admin') {
    header('Location: ../html/adminDash.html');
    exit();
} elseif ($user_role == 'Customer') {
    header('Location: profile.php');
    exit();
} elseif ($user_role == 'Manager') {
    header('Location: ../html/managerDash.html');
    exit();

}
elseif ($user_role == 'CEO') {
    header('Location: ../html/adminDash.html');
    exit();

}
else {
    header('Location: ../html/signin.html');
    exit();
}
?>
