<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Form</title>
  <link rel="stylesheet" href="../css/addManager.css">
  <script src="../js/validation.js" defer></script>
</head>

<body>
  <div class="form-container">
    <h2>Employee Registration Form</h2>
    <form action="employee-insert.php" method="POST">
      <div class="form-group">
        <label for="employee_id">Employee ID</label>
        <input type="text" id="employee_id" name="employee_id" required>
      </div>
      <div class="form-group">
        <label for="employee_password">Password</label>
        <input type="password" id="employee_password" name="employee_password" required>
      </div>
      <div class="form-group">
        <label for="employee_mobile_number">Mobile Number</label>
        <input type="text" id="employee_mobile_number" name="employee_mobile_number" required>
      </div>
      <div class="form-group">
        <label for="employee_email">Email</label>
        <input type="email" id="employee_email" name="employee_email" required>
      </div>
      <div class="form-group">
        <label for="employee_name">Name</label>
        <input type="text" id="employee_name" name="employee_name" required>
      </div>
      <div class="form-group">
        <label for="employee_gender">Gender</label>
        <select id="employee_gender" name="employee_gender" required>
          <option value="" disabled selected>Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label for="employee_dob">Date of Birth</label>
        <input type="date" id="employee_dob" name="employee_dob" required>
      </div>
      <div class="form-group">
        <label for="employee_address">Address</label>
        <input type="text" id="employee_address" name="employee_address" required>
      </div>
      <div class="form-group">
        <label for="employee_role">Role</label>
        <select id="employee_role" name="employee_role" required>
          <option value="" disabled selected>Select Role</option>
          <option value="Manager">Manager</option>
          <option value="Administation">Admin</option>
        </select>
      </div>
      <div class="form-group">
        <label for="employee_joining_date">Joining Date</label>
        <input type="date" id="employee_joining_date" name="employee_joining_date" required>
      </div>
      <div class="form-group">
        <label for="employee_salary">Salary</label>
        <input type="number" id="employee_salary" name="employee_salary" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
  <!-- <script src="../js/validation.js"></script> -->
</body>

</html>