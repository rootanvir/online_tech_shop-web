<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/profile.css">

</head>
<body>

    <div class="profile-container">
        <h1>Profile</h1>

        <?php
            session_start();
            if (isset($_SESSION['username'])) {
                $sessionUsername = $_SESSION['username']; 

                include 'db_connection.php';
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT * FROM customer WHERE customer_mobile_number = '$sessionUsername'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<h2>Customer Details:</h2>";
                        echo "<div class='info-box'>";
                        echo "<p><span>Username:</span> " . $row['customer_mobile_number'] . "</p>";
                        echo "<p><span>Name:</span> " . $row['customer_name'] . "</p>";
                        echo "<p><span>Email:</span> " . $row['customer_email'] . "</p>";
                        echo "<p><span>Address:</span> " . $row['customer_address'] . "</p>";
                        echo "<p><span>Date of Birth:</span> " . $row['customer_dob'] . "</p>";
                        echo "</div>";
                        
                        // Add buttons
                        echo "<div class='buttons'>";
                        echo "<button class='btn continue-shopping' onclick='window.location.href=\"../index.html\"'>Continue Shopping</button>";
                        echo "<button class='btn signout' onclick='window.location.href=\"signout.php\"'>Sign Out</button>";
                        echo "</div>";
                        
                    }
                } else {
                    $query = "SELECT * FROM employee WHERE employee_id = '$sessionUsername'";
                    $result = $conn->query($query);
                    
                    if ($result->num_rows > 0) {
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
                        echo "<p class='error-message'>User not found in database.</p>";
                    }
                }

                // Close the connection
                $conn->close();

            } else {
                echo "<p class='error-message'>You are not logged in.</p>";
            }
        ?>

    </div>

</body>
</html>
