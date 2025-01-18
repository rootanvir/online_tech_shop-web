let currentPage = 1;
const productsPerPage = 12;

async function loadProducts() {
    try {
        const response = await fetch('../json/searched.json ?t=' + Date.now());
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const rawText = await response.text();
        const products = JSON.parse(rawText);

        if (Array.isArray(products) && products.length > 0) {
            const start = (currentPage - 1) * productsPerPage;
            const end = start + productsPerPage;
            const productsToDisplay = products.slice(start, end);
            const productContainer = document.getElementById('pr');
            productContainer.innerHTML = '';

            productsToDisplay.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('product');
                productDiv.innerHTML = `
                    <img src="${product.product_location}" alt="${product.product_name}">
                    <h3>${product.product_name}</h3>
                    <p>${product.product_category}</p>
                    <p>$${product.product_price}</p>
                    <button onclick="addToCart('${product.product_id}', '${product.product_name}')">Add to Cart</button>
                `;
                productContainer.appendChild(productDiv);
            });

            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage * productsPerPage >= products.length;
        } else {
            console.warn('Product array is empty.');
        }
    } catch (error) {
        console.error('Error loading products:', error);
    }
}

function addToCart(productId, productName) {
    // Retrieve the cart cookie or initialize it as an empty array
    let cart = getCookie("cart");

    // If no cart cookie exists, initialize as an empty array
    if (!cart) {
        cart = "[]"; // Default to empty cart in string format
    }

    // Try to parse the cart cookie into a JavaScript object
    try {
        cart = JSON.parse(cart); // Parsing the raw JSON
    } catch (e) {
        console.error("Error parsing cart cookie:", e);
        cart = []; // In case of error, initialize with an empty array
    }

    // Check if the product is already in the cart
    const existingProduct = cart.find(item => item.productId === productId);

    if (existingProduct) {
        // If the product exists, increase its quantity
        existingProduct.quantity += 1;
    } else {
        // Otherwise, add the new product with a quantity of 1
        cart.push({ productId, quantity: 1 });
    }

    // Show a success toast with the product name
    showToast(`${productName} added to cart`, "success", 2000);

    // Save the updated cart back to the cookie in raw JSON format (no encoding)
    setCookie("cart", JSON.stringify(cart), 7); // Save for 7 days
    console.log("Cart updated:", cart);
}

// Utility function to get a cookie by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
    return null;
}

// Utility function to set a cookie
function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
}


// Pagination controls
document.getElementById('prevPage').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        loadProducts();
    }
});

document.getElementById('nextPage').addEventListener('click', () => {
    currentPage++;
    loadProducts();
});

// Initial load
window.onload = loadProducts;
