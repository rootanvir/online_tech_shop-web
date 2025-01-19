// JavaScript to handle dynamic payment method selection
function togglePaymentFields() {
    const selectedMethod = document.querySelector('input[name="payment-method"]:checked').value;
    const cardFields = document.getElementById('card-fields');
    const bkashFields = document.getElementById('bkash-fields');

    if (selectedMethod === 'card') {
        cardFields.style.display = 'block';
        bkashFields.style.display = 'none';
    } else if (selectedMethod === 'bkash') {
        cardFields.style.display = 'none';
        bkashFields.style.display = 'block';
    } else {
        cardFields.style.display = 'none';
        bkashFields.style.display = 'none';
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const orderDetailsElement = document.getElementById("order-details");
    const totalSummaryElement = document.getElementById("total-summary");

    const SHIPPING_COST = 40.00; // Fixed shipping cost

    // Function to get cookie value by name
    const getCookie = (name) => {
        const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
        return match ? decodeURIComponent(match[2]) : null;
    };

    // Fetch subtotal from the cookie
    const subTotal = parseFloat(getCookie("cost")) || 0;
    const total = subTotal + SHIPPING_COST;

    // Update the order summary
    orderDetailsElement.innerHTML = `
        <li>Subtotal: ৳${subTotal.toFixed(2)}</li>
        <li>Shipping Cost: ৳${SHIPPING_COST.toFixed(2)}</li>
    `;
    totalSummaryElement.textContent = `Total: ৳${total.toFixed(2)}`;
});