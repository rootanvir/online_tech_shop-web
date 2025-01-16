// Function to show an alert when the "Add to Cart" button is clicked
function addToCartAlert(productName) {
    //alert(`${productName} has been added to the cart!`);
    toast(`${productName} has been successfully added to cart`,4000);
    console.log("Added to cart");
}

// Function to save product to cookie with ID and Quantity
function saveToCookie(productId, quantity) {
    // Get existing cart from cookie or create a new one
    let cart = getCookie("cart");
    cart = cart ? JSON.parse(cart) : [];

    // Check if the product already exists in the cart
    const existingProductIndex = cart.findIndex(item => item.productId === productId);

    if (existingProductIndex !== -1) {
        // If the product exists, update the quantity
        cart[existingProductIndex].quantity += quantity;
    } else {
        // If the product doesn't exist, add it to the cart
        cart.push({ productId, quantity });
    }

    // Save updated cart back to cookie
    document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=31536000`; // 1 year expiry
}

// Function to send cart to the server (add to cart)
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
            const quantity = 1; // Default quantity is 1, this can be adjusted based on your requirement
            
            addToCartAlert(button.getAttribute('data-product-name')); // Show alert with product name
            saveToCookie(productId, quantity); // Save to cookie with product ID and quantity
            sendToServer(productId, quantity); // Send to server with product ID and quantity
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

console.log("ADD 2 CART loaded");
