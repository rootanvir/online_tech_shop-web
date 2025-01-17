document.addEventListener("DOMContentLoaded", () => {
    const cartItemsContainer = document.querySelector("#cart-items-container tbody");
    const subTotalElement = document.getElementById("sub-total");
    const shippingCostElement = document.getElementById("shipping-cost");
    const totalAmountElement = document.getElementById("total-amount");

    const SHIPPING_COST = 5.00; // Fixed shipping cost

    // Fetch product details from JSON
    const fetchProductDetails = async (productId) => {
        try {
            const response = await fetch("../json/products.json");
            const productData = await response.json();
            return productData.find(item => item.product_id === productId) || null;
        } catch (error) {
            console.error("Error fetching product details:", error);
            return null;
        }
    };

    // Get cart from cookies
    const getCartFromCookie = () => {
        const cartCookie = document.cookie.match(/cart=([^;]*)/);
        return cartCookie ? JSON.parse(decodeURIComponent(cartCookie[1])) : [];
    };

    // Save cart back to cookies
    const saveCartToCookie = (cart) => {
        document.cookie = `cart=${encodeURIComponent(JSON.stringify(cart))}; path=/; max-age=31536000`;
    };

    // Render cart items
    const renderCart = async () => {
        const cart = getCartFromCookie();
        let subTotal = 0;
        cartItemsContainer.innerHTML = "";

        for (const item of cart) {
            const { productId, quantity } = item;
            const productDetails = await fetchProductDetails(productId);

            if (!productDetails) continue;

            const productPrice = parseFloat(productDetails.product_price || 0);
            const itemTotal = productPrice * quantity;
            subTotal += itemTotal;

            // Render row
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>
                    <img src="${productDetails.product_location}" alt="Product Image" width="50">
                    ${productDetails.product_name}
                </td>
                <td>৳ ${productPrice.toFixed(2)}</td>
                <td>
                    <button class="decrement" data-product-id="${productId}">-</button>
                    <span>${quantity}</span>
                    <button class="increment" data-product-id="${productId}">+</button>
                </td>
                <td>৳ ${itemTotal.toFixed(2)}</td>
                <td>
                    <button class="remove" data-product-id="${productId}">Remove</button>
                </td>
            `;
            cartItemsContainer.appendChild(row);
        }

        // Update totals
        subTotalElement.textContent = subTotal.toFixed(2);
        shippingCostElement.textContent = subTotal > 0 ? SHIPPING_COST.toFixed(2) : "0.00";
        totalAmountElement.textContent = (subTotal + (subTotal > 0 ? SHIPPING_COST : 0)).toFixed(2);
    };

    // Event listeners for cart actions
    cartItemsContainer.addEventListener("click", (event) => {
        const target = event.target;
        const productId = target.getAttribute("data-product-id");
        let cart = getCartFromCookie();

        if (target.classList.contains("remove")) {
            cart = cart.filter(item => item.productId !== productId);
        } else if (target.classList.contains("increment")) {
            cart = cart.map(item => item.productId === productId ? { ...item, quantity: item.quantity + 1 } : item);
        } else if (target.classList.contains("decrement")) {
            cart = cart.map(item => item.productId === productId && item.quantity > 1 ? { ...item, quantity: item.quantity - 1 } : item);
        }

        saveCartToCookie(cart);
        renderCart();
    });

    renderCart();
});
