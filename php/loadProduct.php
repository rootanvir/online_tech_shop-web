<?php 
    // Include the PHP script silently to create/update JSON file
    include 'getProducts.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Products</title>
    <link rel="stylesheet" href="../css/loadProduct.css">
</head>
<body>
    <div class="grid-container" id="productGrid"></div>
    <script src="../js/loadProduct.js">    </script>
</body>
</html>
