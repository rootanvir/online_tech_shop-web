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