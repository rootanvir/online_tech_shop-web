
// signin
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    // const employeePasswordInput = document.getElementById("employee_password");
    const nameInput = document.getElementById("name");
    // employee

    form.addEventListener("submit", (event) => {
        let isValid=true;
        // Validate username
        const username = usernameInput.value.trim();
        const usernameRegex = /^[a-zA-Z]+$/; // Alphanumeric only

        if (!usernameRegex.test(username)) {
            // alert("Username must contain only letters and numbers.");
            event.preventDefault(); // Prevent form submission
            isValid=false;
            // return;
        }

        // Validate password
        const password = passwordInput.value.trim();
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;

        if (!passwordRegex.test(password)) {
            // alert("Password must be at least 6 characters long, and include at least one uppercase letter, one lowercase letter, one number, and one special character.");
            event.preventDefault(); // Prevent form submission
            isValid=false;
            // return;
        }

        // If any validation fails, prevent form submission
        if (!isValid) {
            alert("Wrong information");
              
            // alert("Validation failed. Please correct the errors and try again.");
            event.preventDefault();
        } else {
            alert("successfully signin");
        }
    });

    
});

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
            // alert("Mobile number must be a 11-digit numeric value.");
            isValid = false;
        }

        // Validate name
        const name = nameInput.value.trim();
        const nameRegex = /^[a-zA-Z ]+$/; // Letters and spaces only
        if (!nameRegex.test(name)) {
            // alert("Name must contain only letters and spaces.");
            isValid = false;
        }

        // Validate email
        const email = emailInput.value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Standard email format
        if (!emailRegex.test(email)) {
            // alert("Please enter a valid email address.");
            isValid = false;
        }

        // Validate address
        const address = addressInput.value.trim();
        if (address.length < 5) {
            // alert("Address must be at least 5 characters long.");
            isValid = false;
        }

        // Validate password
        const password = passwordInput.value.trim();
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
        if (!passwordRegex.test(password)) {
            //alert("Password must be at least 6 characters long, and include at least one uppercase letter, one lowercase letter, one number, and one special character.");
            isValid = false;
        }

        // Validate confirm password
        const confirmPassword = confirmPasswordInput.value.trim();
        if (password !== confirmPassword) {
            // alert("Password and Confirm Password must match.");
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
            alert("Invalid information ! Try Again.");
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
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
        if (!passwordRegex.test(password)) {
            alert("Password must be at least 6 characters long, and include at least one uppercase letter, one lowercase letter, one number, and one special character.");
            isValid = false;
        }

        // Validate mobile number
        const mobile = mobileInput.value.trim();
        const mobileRegex = /^[0-9]{11}$/; // 10-digit numeric only
        if (!mobileRegex.test(mobile)) {
            // alert("Mobile number must be a 10-digit numeric value.");
            isValid = false;
        }

        // Validate email
        const email = emailInput.value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Standard email format
        if (!emailRegex.test(email)) {
            // alert("Please enter a valid email address.");
            isValid = false;
        }

        // Validate name
        const name = nameInput.value.trim();
        const nameRegex = /^[a-zA-Z ]+$/; // Letters and spaces only
        if (!nameRegex.test(name)) {
            // alert("Name must contain only letters and spaces.");
            isValid = false;
        }

        // Validate address
        const address = addressInput.value.trim();
        if (address.length > 5) {
            // alert("Address must be at least 5 characters long.");
            isValid = false;
        }

        // Validate salary
        const salary = salaryInput.value.trim();
        if (isNaN(salary) || salary <= 0) {
            // alert("Salary must be a positive number.");
            isValid = false;
        }

        // If any validation fails, prevent form submission
        if (!isValid) {
            event.preventDefault();
            alert("Invalid information! Try Again ");
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
            alert("Product ID must contain only numbers and cannot be empty or spaces.");
            isValid = false;
        }

        // Validate product category
        const category = categoryInput.value.trim();
        const categoryRegex = /^[a-zA-Z]{1,20}$/; // Letters and spaces, max 20 chars
        if (isEmptyOrSpaces(category) || !categoryRegex.test(category)) {
            alert("Product category must contain only letters and spaces, and be no longer than 20 characters. It cannot be empty or spaces.");
            isValid = false;
        }

        // Validate product name
        const name = nameInput.value.trim();
        if (isEmptyOrSpaces(name) || name.length < 3 || name.length > 100) {
            alert("Product name must be between 3 and 100 characters long and cannot be empty or spaces.");
            isValid = false;
        }

        // Validate product price
        const price = priceInput.value.trim();
        if (isEmptyOrSpaces(price) || isNaN(price) || price <= 0) {
            alert("Product price must be a positive number and cannot be empty or spaces.");
            isValid = false;
        }

        // Validate product quantity
        const quantity = quantityInput.value.trim();
        if (isEmptyOrSpaces(quantity) || isNaN(quantity) || quantity <= 0 || !Number.isInteger(parseFloat(quantity))) {
            alert("Product quantity must be a positive integer and cannot be empty or spaces.");
            isValid = false;
        }

        // If any validation fails, prevent form submission
        if (!isValid) {
            event.preventDefault();
            alert("Invalid Information");
        } else {
            alert("successfully added product");
        }
    });
});
