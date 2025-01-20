<?php
include 'db_connection.php'; 

$targetDir = "../product_img/";

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

function getNextFileNumber($dir, $prefix)
{
    $files = glob($dir . $prefix . '*'); 
    if (empty($files)) {
        return 1; 
    }

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

if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['product_image']['tmp_name'];
    $fileExtension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);

    $prefix = "p";
    $nextNumber = getNextFileNumber($targetDir, $prefix);
    $newFileName = $prefix . $nextNumber . '.' . $fileExtension;

    $destination = $targetDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $destination)) {
        $product_location = $destination;

        $sql = "INSERT INTO product (product_id, product_category, product_name, product_price, product_quantity, product_location)
                VALUES ('$product_id', '$product_category', '$product_name', '$product_price', '$product_quantity', '$product_location')";

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

mysqli_close($conn); 
