function addToCartAlert(productName) {
    showToast(`${productName} added successfully to your cart`, 'success', 2000);
    console.log("Added to cart");
}

function saveToCookie(productId, quantity) {
    let cart = getCookie("cart");
    cart = cart ? JSON.parse(cart) : [];

    const existingProductIndex = cart.findIndex(item => item.productId === productId);

    if (existingProductIndex !== -1) {
        cart[existingProductIndex].quantity += quantity;
    } else {
        cart.push({ productId, quantity });
    }

    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=31536000`; // 1 year expiry
}

async function sendToServer(productId, quantity) {
    try {
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
        console.log('Cart updated on server:', data);
    } catch (error) {
        console.error("Error saving to cart server:", error);
    }
}

// Example usage: attach the function to each "Add to Cart" button
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.add-to-cart-button');
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = button.getAttribute('data-product-id'); // Get product ID
            const quantity = 1; 
            
            addToCartAlert(button.getAttribute('data-product-name')); // Show alert with product name
            saveToCookie(productId, quantity); 
            sendToServer(productId, quantity); 
        });
    });
});

// Function to get a cookie by name
function getCookie(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
