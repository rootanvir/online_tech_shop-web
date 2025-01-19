 

// validate signup
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const mobileInput = document.getElementById("mobile");
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const addressInput = document.getElementById("address");
  const dobInput = document.getElementById("dob");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirm-password");

  form.addEventListener("submit", (event) => {
    let isValid = true;

    // Validate mobile number
    const mobile = mobileInput.value.trim();
    const mobileRegex = /^[0-9]{11}$/; // 10-digit numeric only
    if (!mobileRegex.test(mobile)) {
      isValid = false;
    }

    // Validate name
    const name = nameInput.value.trim();
    const nameRegex = /^[a-zA-Z ]+$/; // Letters and spaces only
    if (!nameRegex.test(name)) {
      isValid = false;
    }

    // Validate email
    const email = emailInput.value.trim();
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Standard email format
    if (!emailRegex.test(email)) {
      isValid = false;
    }

    // Validate address
    const address = addressInput.value.trim();
    if (address.length < 5) {
      isValid = false;
    }

    // Validate password
    const password = passwordInput.value.trim();
    const passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    if (!passwordRegex.test(password)) {
      isValid = false;
    }

    // Validate confirm password
    const confirmPassword = confirmPasswordInput.value.trim();
    if (password !== confirmPassword) {
      isValid = false;
    }

    // Prevent form submission if validation fails
    if (!isValid) {
      event.preventDefault();
      alert("Invalid information try again");
    } else {
      alert("successfully signup");
    }
  });
});

//emplyevalidation

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const employeeIdInput = document.getElementById("employee_id");
  const passwordInput = document.getElementById("employee_password");
  const mobileInput = document.getElementById("employee_mobile_number");
  const emailInput = document.getElementById("employee_email");
  const nameInput = document.getElementById("employee_name");
  const addressInput = document.getElementById("employee_address");
  const salaryInput = document.getElementById("employee_salary");

  form.addEventListener("submit", (event) => {
    let isValid = true;

    // Validate employee ID
    const employeeId = employeeIdInput.value.trim();
    const employeeIdRegex = /^[0-9]+$/; // Numbers only
    if (!employeeIdRegex.test(employeeId)) {
      // alert("Employee ID must contain only numbers.");
      isValid = false;
    }

    // Validate password
    const password = passwordInput.value.trim();
    const passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
    if (!passwordRegex.test(password)) {
      isValid = false;
    }

    // Validate mobile number
    const mobile = mobileInput.value.trim();
    const mobileRegex = /^[0-9]{11}$/; // 10-digit numeric only
    if (!mobileRegex.test(mobile)) {
      isValid = false;
    }

    // Validate email
    const email = emailInput.value.trim();
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Standard email format
    if (!emailRegex.test(email)) {
      isValid = false;
    }

    // Validate name
    const name = nameInput.value.trim();
    const nameRegex = /^[a-zA-Z ]+$/; // Letters and spaces only
    if (!nameRegex.test(name)) {
      isValid = false;
    }

    // Validate address
    const address = addressInput.value.trim();
    if (address.length > 5) {
      isValid = false;
    }

    // Validate salary
    const salary = salaryInput.value.trim();
    if (isNaN(salary) || salary <= 0) {
      isValid = false;
    }

    // If any validation fails, prevent form submission
    if (!isValid) {
      event.preventDefault();
      alert("Invalid information try again");
    } else {
      alert("successfully added");
    }
  });
});

// PRODUCT VALIDATION
// validation.js

// validation.js

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const productIdInput = document.getElementById("product_id");
  const categoryInput = document.getElementById("product_category");
  const nameInput = document.getElementById("product_name");
  const priceInput = document.getElementById("product_price");
  const quantityInput = document.getElementById("product_quantity");

  form.addEventListener("submit", (event) => {
    let isValid = true;

    // Helper function to check if a field is empty or only spaces
    const isEmptyOrSpaces = (str) => str.trim().length === 0;

    // Validate product ID
    const productId = productIdInput.value.trim();
    const productIdRegex = /^[0-9]+$/; // Numbers only
    if (isEmptyOrSpaces(productId) || !productIdRegex.test(productId)) {
      alert(
        "Product ID must contain only numbers and cannot be empty or spaces."
      );
      isValid = false;
    }

    // Validate product category
    const category = categoryInput.value.trim();
    const categoryRegex = /^[a-zA-Z]{1,20}$/; // Letters and spaces, max 20 chars
    if (isEmptyOrSpaces(category) || !categoryRegex.test(category)) {
      isValid = false;
    }

    // Validate product name
    const name = nameInput.value.trim();
    if (isEmptyOrSpaces(name) || name.length < 3 || name.length > 100) {
      isValid = false;
    }

    // Validate product price
    const price = parseFloat(priceInput.value.trim());
    if (isNaN(price) || price <= 0) {
      // alert("Product price must be a positive number.");
      isValid = false;
    }
    // Validate product price
    // const price = priceInput.value.trim();
    // if ((isEmptyOrSpaces(price) || isNaN(price) ) || price >= 0) {
    //     isValid = false;
    // }

    // Validate product quantity
    const quantity = quantityInput.value.trim();
    if (
      isEmptyOrSpaces(quantity) ||
      isNaN(quantity) ||
      quantity <= 0 ||
      !Number.isInteger(parseFloat(quantity))
    ) {
      isValid = false;
    }

    // If any validation fails, prevent form submission
    if (!isValid) {
      event.preventDefault();
      alert("Invalid information try again");
    } else {
      alert("successfully added product");
    }
  });
});
