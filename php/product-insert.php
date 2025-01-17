<?php
// Include your database connection here
include 'db_connection.php'; // Assuming you have a db_connection.php file to connect to the database

// Directory to store the images
$targetDir = "../product_img/";

// Ensure the uploads folder exists
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Function to get the next sequential number for file naming
function getNextFileNumber($dir, $prefix)
{
    $files = glob($dir . $prefix . '*'); // Get all files starting with the prefix
    if (empty($files)) {
        return 1; // Start from 1 if no files exist
    }

    // Extract numbers from existing file names
    $numbers = array_map(function ($file) use ($prefix) {
        $basename = basename($file);
        $number = intval(str_replace([$prefix, '.'], '', $basename));
        return $number;
    }, $files);

    return max($numbers) + 1; // Get the next number
}

// Get form data
$product_id = $_POST['product_id'];
$product_category = $_POST['product_category'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_quantity = $_POST['product_quantity'];

// Check if a file was uploaded
if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['product_image']['tmp_name'];
    $fileExtension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);

    // Generate a unique name for the file starting with "p"
    $prefix = "p";
    $nextNumber = getNextFileNumber($targetDir, $prefix);
    $newFileName = $prefix . $nextNumber . '.' . $fileExtension;

    // Destination path
    $destination = $targetDir . $newFileName;

    // Move the file to the uploads folder
    if (move_uploaded_file($fileTmpPath, $destination)) {
        // Full path to the image (to store in the database)
        $product_location = $destination;

        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO product (product_id, product_category, product_name, product_price, product_quantity, product_location)
                VALUES ('$product_id', '$product_category', '$product_name', '$product_price', '$product_quantity', '$product_location')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            echo "Product inserted successfully!";
        } else {
            echo "Error inserting product: " . mysqli_error($conn);
        }
    } else {
        echo "Error moving the uploaded file.";
    }
} else {
    echo "No image uploaded or there was an upload error.";
}

mysqli_close($conn); // Close the database connection
