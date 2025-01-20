<?php
include 'db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_employee'])) {
    $employee_id = $_POST['employee_id'];
    $employee_mobile_number = $_POST['employee_mobile_number'];
    $employee_email = $_POST['employee_email'];
    $employee_name = $_POST['employee_name'];
    $employee_gender = $_POST['employee_gender'];
    $employee_address = $_POST['employee_address'];
    $employee_role = $_POST['employee_role'];
    $employee_salary = $_POST['employee_salary'];

    $sql = "UPDATE employee SET 
            employee_mobile_number = '$employee_mobile_number',
            employee_email = '$employee_email',
            employee_name = '$employee_name',
            employee_gender = '$employee_gender',
            employee_address = '$employee_address',
            employee_role = '$employee_role',
            employee_salary = '$employee_salary'
            WHERE employee_id = '$employee_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employee updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating employee: " . $conn->error . "');</script>";
    }
}

// Handle the delete functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM employee WHERE employee_id = '$delete_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Employee deleted successfully!');</script>";
        // Redirect to avoid resubmission after refresh
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
        exit; // Ensure no further code is executed after the redirect
    } else {
        echo "<script>alert('Error deleting employee: " . $conn->error . "');</script>";
    }
}

// Fetch employee data
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="../css/loadEmployeeList.css">
    <script src="../js/search_table.js" defer></script>

</head>

<body>
    <div class="main-container">
        <div class="container">

            <div class="table-container">
                <h1>Employee Information</h1>

                <!-- Search Box -->
                <input type="text" class="searchBox" id="EmployeeSearchBox" onkeyup="employeeSearchTable()" placeholder="Search employees...">

                <?php if ($result->num_rows > 0): ?>
                    <table id="employeeTable">
                        <thead>
                            <tr>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['employee_id']) ?></td>
                                    <td style="color:red;">Confidential</td>
                                    <td><?= htmlspecialchars($row['employee_mobile_number']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_email']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_name']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_gender']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_dob']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_address']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_role']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_joining_date']) ?></td>
                                    <td><?= htmlspecialchars($row['employee_salary']) ?></td>
                                    <td>
                                        <!-- Edit and Delete links -->
                                        <a href="?edit_id=<?= $row['employee_id'] ?>" title="Edit">✏️</a>
                                        <a href="?delete_id=<?= $row['employee_id'] ?>" title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this employee?')">❌</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No employee data found.</p>
                <?php endif; ?>
            </div>

            <!-- Update Employee Form -->
            <div class="form-container">
                <h2>Update Employee</h2>
                <?php
                if (isset($_GET['edit_id'])) {
                    $edit_id = $_GET['edit_id'];
                    $edit_query = "SELECT * FROM employee WHERE employee_id = '$edit_id'";
                    $edit_result = $conn->query($edit_query);
                    $edit_row = $edit_result->fetch_assoc();
                }
                ?>
                <form method="POST" action="">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" id="employee_id" name="employee_id"
                        value="<?= isset($edit_row['employee_id']) ? $edit_row['employee_id'] : '' ?>" disabled>
                    <input type="hidden" name="employee_id"
                        value="<?= isset($edit_row['employee_id']) ? $edit_row['employee_id'] : '' ?>">

                    <label for="employee_mobile_number">Mobile Number</label>
                    <input type="text" id="employee_mobile_number" name="employee_mobile_number"
                        value="<?= isset($edit_row['employee_mobile_number']) ? $edit_row['employee_mobile_number'] : '' ?>" required>

                    <label for="employee_email">Email</label>
                    <input type="email" id="employee_email" name="employee_email"
                        value="<?= isset($edit_row['employee_email']) ? $edit_row['employee_email'] : '' ?>" required>

                    <label for="employee_name">Name</label>
                    <input type="text" id="employee_name" name="employee_name"
                        value="<?= isset($edit_row['employee_name']) ? $edit_row['employee_name'] : '' ?>" required>

                    <label for="employee_gender">Gender</label>
                    <select id="employee_gender" name="employee_gender">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male" <?= (isset($edit_row['employee_gender']) && $edit_row['employee_gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= (isset($edit_row['employee_gender']) && $edit_row['employee_gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                    </select>

                    <label for="employee_address">Address</label>
                    <input type="text" id="employee_address" name="employee_address"
                        value="<?= isset($edit_row['employee_address']) ? $edit_row['employee_address'] : '' ?>" required>

                    <label for="employee_role">Role</label>
                    <select id="employee_role" name="employee_role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="Admin" <?= isset($edit_row['employee_role']) && $edit_row['employee_role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Manager" <?= isset($edit_row['employee_role']) && $edit_row['employee_role'] == 'Manager' ? 'selected' : '' ?>>Manager</option>
                    </select>

                    <label for="employee_salary">Salary</label>
                    <input type="number" id="employee_salary" name="employee_salary"
                        value="<?= isset($edit_row['employee_salary']) ? $edit_row['employee_salary'] : '' ?>"
                        step="0.01" required>

                    <button type="submit" name="update_employee">Update Employee</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php $conn->close(); ?>