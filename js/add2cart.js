function addToCartAlert(productName) {
    showToast(`${productName} added successfully to your cart`, 'success', 2000);
    console.log("Added to cart:", productName); // Debug: Log the product name added to the cart
}

function saveToCookie(productId, quantity) {
    let cart = getCookie("cart");
    cart = cart ? JSON.parse(cart) : [];

    console.log('Cart before update:', cart); // Debug: Check the cart before updating

    const existingProductIndex = cart.findIndex(item => item.productId === productId);

    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += quantity;
    } else {
        cart.push({ productId, quantity });
    }

    console.log('Cart after update:', cart); // Debug: Check the cart after updating

    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=31536000`; // 1 year expiry
}

async function sendToServer(productId, quantity) {
    try {
        console.log('Sending to server:', { productId, quantity }); // Debug: Log the payload

        const response = await fetch('../php/saveCart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ productId, quantity })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Server response:', data); // Debug: Log the server's response
    } catch (error) {
        console.error("Error saving to cart server:", error); // Debug: Log the error
    }
}

async function checkStock(productId, desiredQuantity) {
    try {
        console.log('Checking stock for:', productId); // Debug: Log product ID

        const response = await fetch(`../php/getstock.php?productId=${productId}`);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Stock data:', data); // Debug: Log stock data

        if (data.quantity >= desiredQuantity) {
            return true; // Stock available
        } else {
            showToast(`Insufficient stock. Available quantity: ${data.quantity}.`, 'error', 3000);
            console.warn('Insufficient stock for product ID:', productId); // Debug: Log insufficient stock
            return false; // Insufficient stock
        }
    } catch (error) {
        console.error("Error checking stock:", error);
        showToast("Unable to check stock. Please try again later.", 'error', 3000);
        return false; // Default to not available on error
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.add-to-cart-button');
    
    buttons.forEach(button => {
        button.addEventListener('click', async function () {
            const productId = button.getAttribute('data-product-id'); // Get product ID
            const productName = button.getAttribute('data-product-name'); // Get product name
            const quantity = 1; // Fixed quantity for now
            
            console.log('Button clicked:', { productId, productName }); // Debug: Log button attributes

            const isStockAvailable = await checkStock(productId, quantity);
            if (isStockAvailable) {
                addToCartAlert(productName); // Show alert with product name
                saveToCookie(productId, quantity); // Save to cookie
                sendToServer(productId, quantity); // Send to server
            }
        });
    });
});

// Function to get a cookie by name
function getCookie(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    console.log('Cookie fetched:', matches ? decodeURIComponent(matches[1]) : 'Not Found'); // Debug: Check cookie retrieval
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
