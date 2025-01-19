<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            position: relative;
        }

        /* Profile Container */
        .profile-container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            width: 70%;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left; /* Left align the text */
        }

        .profile-container h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
            text-align: center; /* Center align the profile heading */
        }

        .profile-container h2 {
            font-size: 24px;
            margin-top: 30px;
            color: #555;
        }

        /* Information Box Styling */
        .info-box {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: left; /* Ensure the information inside the box is left aligned */
        }

        .info-box p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Profile Details Styling */
        .info-box p span {
            font-weight: bold;
            color: #007BFF;
        }

        /* Error/Not Found Message */
        .error-message {
            color: #e74c3c;
            font-size: 18px;
            margin-top: 20px;
        }

        /* Link Styling */
        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <h1>Profile</h1>

        <?php
            session_start();
            if(!isset($_SESSION['username']))
            {
                header("Location: ../html/signin.html");
            }
            // Check if the user is logged in (session exists)
            if (isset($_SESSION['username'])) {
                // Retrieve the session username
                $sessionUsername = $_SESSION['username']; // Rename session variable for clarity

                // Database configuration
                include 'db_connection.php';
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Search for the user in the 'customer' table using the session username
                $query = "SELECT * FROM customer WHERE customer_mobile_number = '$sessionUsername'";
                $result = $conn->query($query);

                // If user is not found in the 'customer' table, search in the 'employee' table
                if ($result->num_rows > 0) {
                    // User found in customer table, display the details
                    while ($row = $result->fetch_assoc()) {
                        echo "<h2>Customer Details:</h2>";
                        echo "<div class='info-box'>";
                        echo "<p><span>Username:</span> " . $row['customer_mobile_number'] . "</p>";
                        echo "<p><span>Name:</span> " . $row['customer_name'] . "</p>";
                        echo "<p><span>Email:</span> " . $row['customer_email'] . "</p>";
                        echo "<p><span>Address:</span> " . $row['customer_address'] . "</p>";
                        echo "<p><span>Date of Birth:</span> " . $row['customer_dob'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    // If not found in 'customer', search in 'employee'
                    $query = "SELECT * FROM employee WHERE employee_id = '$sessionUsername'";
                    $result = $conn->query($query);
                    
                    if ($result->num_rows > 0) {
                        // User found in employee table, display the details
                        while ($row = $result->fetch_assoc()) {
                            echo "<h2>Employee Details:</h2>";
                            echo "<div class='info-box'>";
                            echo "<p><span>Employee ID:</span> " . $row['employee_id'] . "</p>";
                            echo "<p><span>Name:</span> " . $row['employee_name'] . "</p>";
                            echo "<p><span>Email:</span> " . $row['employee_email'] . "</p>";
                            echo "<p><span>Address:</span> " . $row['employee_address'] . "</p>";
                            echo "<p><span>Gender:</span> " . $row['employee_gender'] . "</p>";
                            echo "<p><span>Date of Birth:</span> " . $row['employee_dob'] . "</p>";
                            echo "<p><span>Role:</span> " . $row['employee_role'] . "</p>";
                            echo "<p><span>Joining Date:</span> " . $row['employee_joining_date'] . "</p>";
                            echo "<p><span>Salary:</span> " . $row['employee_salary'] . "</p>";
                            echo "</div>";
                        }
                    } else {
                        // If no user found in either table
                        echo "<p class='error-message'>User not found in database.</p>";
                    }
                }

                // Close the connection
                $conn->close();

            } else {
                // If the user is not logged in, show a message
                echo "<p class='error-message'>You are not logged in.</p>";
            }
        ?>

    </div>

</body>
</html>
