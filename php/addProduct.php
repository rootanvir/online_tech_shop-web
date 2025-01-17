<?php include 'autoFill-id.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Input Form</title>
    <link rel="stylesheet" href="../css/addProduct.css">

</head>

<body>
    <div class="form-container">
        <h2>Product Input Form</h2>
        <form action="product-insert.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" id="product_id" name="product_id" maxlength="15" value="<?php echo $newId ?>" required>
            </div>
            <div class="form-group">
                <label for="product_category">Product Category</label>
                <input type="text" id="product_category" name="product_category" maxlength="20" required>
            </div>
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" maxlength="100" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" step="0.01" id="product_price" name="product_price">
            </div>
            <div class="form-group">
                <label for="product_quantity">Product Quantity</label>
                <input type="number" id="product_quantity" name="product_quantity">
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" id="product_image" name="product_image" accept="image/*" required>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    <script src="../js/validation.js"></script>
</body>

</html>