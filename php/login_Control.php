<?php
// Include the database connection
include('db_connection.php'); // Assuming the database connection code is saved in db_connection.php

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve the form data
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    // Query the database for the user based on employee_id (assuming 'employee_id' is the username)
    $sql = "SELECT * FROM employee WHERE employee_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter (employee_id as username)
        mysqli_stmt_bind_param($stmt, "s", $username);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if a user was found
        if ($user = mysqli_fetch_assoc($result)) {
            // Debugging line to check what is returned
            var_dump($user);

            // Directly compare the password (assuming employee_password is stored in plain text)
            if ($password == $user['employee_password']) {
                // Password is correct, login successful
                $_SESSION['username'] = $user['employee_id']; // Store employee_id in session
                $_SESSION['role'] = $user['employee_role']; // Store employee role in session

                // Redirect based on the role
                if ($user['employee_role'] == "Admin") {
                    header("Location: ../html/adminDash.html");
                } elseif ($user['employee_role'] == "Manager") {
                    header("Location: ../html/managerDash.html");
                } else {
                    // Default redirect for any other role
                    echo "Role not recognized!";
                    exit();
                }
                exit();
            } else {
                // Incorrect password
                echo "Invalid username or password!";
            }
        } else {
            // User not found
            echo "Invalid username or password!";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in SQL query!";
    }

    // Close the connection
    mysqli_close($conn);
}
