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
    <script>
        async function loadProducts() {
            try {
                const response = await fetch('../json/products.json'); // Fetch the JSON file
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const products = await response.json();
                if (!Array.isArray(products)) {
                    throw new Error("Fetched data is not an array.");
                }

                const gridContainer = document.getElementById('productGrid');
                gridContainer.innerHTML = ''; // Clear existing content

                products.forEach(product => {
                    const productCard = document.createElement('div');
                    productCard.classList.add('product-card');
                    productCard.innerHTML = `
                        <img src="${product.product_location}" alt="${product.product_name}">
                        <h3>${product.product_name}</h3>
                        <p>৳ ${product.product_price}</p>
                        <button>Add to Cart</button>
                    `;
                    gridContainer.appendChild(productCard);
                });
            } catch (error) {
                console.error("Error loading products:", error);
                document.getElementById('productGrid').innerHTML = '<p>Failed to load products. Please try again later.</p>';
            }
        }

        window.onload = loadProducts;
    </script>
</body>
</html>
