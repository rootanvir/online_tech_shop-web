document.addEventListener("DOMContentLoaded", () => {
    const cartItemsContainer = document.getElementById("cart-items-container");
    const totalQuantityElement = document.getElementById("total-quantity");
    const totalPriceElement = document.getElementById("total-price");

    // Function to fetch product details from products.json
    const fetchProductDetails = async (productId) => {
        try {
            console.log("Attempting to fetch products.json...");
            const response = await fetch("../json/products.json"); // Assuming products.json is in the same directory
    
            // Check if the response is successful
            if (!response.ok) {
                throw new Error(`Failed to load products.json: ${response.status} ${response.statusText}`);
            }
    
            const productData = await response.json();
            console.log("Products data fetched successfully:", productData);
    
            // Find product by product_id
            const product = productData.find(item => item.product_id === productId);
    
            if (product) {
                // Convert product price to float
                product.product_price = parseFloat(product.product_price);
            }
    
            // Return product details
            return product || { product_name: "Unknown Product", product_price: 0, product_location: "Unknown Location" };
        } catch (error) {
            // Catch any error in fetching and log it
            console.error("Error fetching product data:", error);
            return {productId, product_name: "Unknown Product", product_price: 0, product_location: "Unknown Location" };
        }
    };
    

    // Function to get cart from cookie
    const getCartFromCookie = () => {
        const cartCookie = getCookie("cart");
        return cartCookie ? JSON.parse(cartCookie) : [];
    };

    // Function to get a cookie by name
    function getCookie(name) {
        const matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    // Render cart items and calculate totals
    const renderCart = async () => {
        const cart = getCartFromCookie();
        let totalQuantity = 0;
        let totalPrice = 0.0;

        cartItemsContainer.innerHTML = ""; // Clear the container

        for (const item of cart) {
            const { productId, quantity } = item;
            const productDetails = await fetchProductDetails(productId);

            totalQuantity += quantity;
            totalPrice += productDetails.product_price * quantity;

            // Create cart item element
            const cartItem = document.createElement("div");
            cartItem.classList.add("cart-item");
            cartItem.innerHTML = `
                <img src="${productDetails.product_location}" alt="Item Image">
                <div class="item-details">
                    <h3>${productDetails.product_name}</h3>
                    <h3>Id: ${productId}</h3>
                    <p>Price: ${productDetails.product_price.toFixed(2)}</p>
                    <p>Location: ${productDetails.product_location}</p>
                    <p>Quantity: ${quantity}</p>
                    <p>Total: $${(productDetails.product_price * quantity).toFixed(2)}</p>
                </div>
                <div class="cart-actions">
                    <button class="details" data-product-id="${productId}">View Details</button>
                    <button class="remove" data-product-id="${productId}">Remove</button>
                </div>
            `;
            cartItemsContainer.appendChild(cartItem);
        }

        // Update totals
        totalQuantityElement.textContent = totalQuantity;
        totalPriceElement.textContent = totalPrice.toFixed(2);
    };

    // Remove item from cart
    cartItemsContainer.addEventListener("click", (event) => {
        if (event.target.classList.contains("remove")) {
            const productId = event.target.getAttribute("data-product-id");
            let cart = getCartFromCookie();

            cart = cart.filter(item => item.productId !== productId);

            // Save updated cart back to cookie
            document.cookie = `cart=${JSON.stringify(cart)}; path=/; max-age=31536000`;

            renderCart(); // Re-render the cart
        }
    });

    renderCart(); // Initial render
});
