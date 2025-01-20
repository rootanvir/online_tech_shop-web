// Toggle payment fields based on the selected payment method
function togglePaymentFields() {
    const cardFields = document.getElementById('card-fields');
    const bkashFields = document.getElementById('bkash-fields');
    const cashMessage = document.getElementById('cash-message');

    const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

    cardFields.style.display = paymentMethod === 'card' ? 'block' : 'none';
    bkashFields.style.display = paymentMethod === 'bkash' ? 'block' : 'none';
    cashMessage.style.display = paymentMethod === 'cash' ? 'block' : 'none';
}

// Validate payment form before submission
function validatePaymentForm(event) {
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked');
    if (!paymentMethod) {
        alert('Please select a payment method.');
        event.preventDefault();  // Prevent form submission if no payment method is selected
        return false;
    }

    if (paymentMethod.value === 'card') {
        const cardNumber = document.getElementById('card-number').value;
        const expiryDate = document.getElementById('expiry-date').value;
        const cvv = document.getElementById('cvv').value;

        if (!cardNumber || !expiryDate || !cvv) {
            alert('Please fill in all the card payment fields.');
            event.preventDefault();  // Prevent form submission if card fields are incomplete
            return false;
        }

        // Further validation for card fields (e.g., CVV, expiry date, etc.) can be added here
    }

    if (paymentMethod.value === 'bkash') {
        const bkashNumber = document.getElementById('bkash-number').value;
        const transactionId = document.getElementById('bkash-transaction-id').value;

        if (!bkashNumber || !transactionId) {
            alert('Please fill in all the Bkash payment fields.');
            event.preventDefault();  // Prevent form submission if Bkash fields are incomplete
            return false;
        }

        // Further validation for Bkash fields can be added here
    }

    // If everything is valid, allow form submission
    return true;
}

// Add event listener to form submission
document.getElementById('paymentForm').addEventListener('submit', validatePaymentForm);

// Update order summary and total cost
document.addEventListener("DOMContentLoaded", () => {
    const totalCostInput = document.getElementById("total-cost");
    const orderDetailsList = document.getElementById("order-details");
    const totalSummary = document.getElementById("total-summary");

    // Retrieve the cost from the cookie and calculate total
    const cost = parseFloat(document.cookie.replace(/(?:(?:^|.*;\s*)cost\s*\=\s*([^;]*).*$)|^.*$/, "$1")) || 0;
    const shippingCost = 40.00;
    const totalCost = cost + shippingCost;

    // Update the order summary and hidden input
    orderDetailsList.innerHTML = `
        <li>Subtotal: ৳${cost.toFixed(2)}</li>
        <li>Shipping Cost: ৳${shippingCost.toFixed(2)}</li>
    `;
    totalSummary.textContent = `Total: ৳${totalCost.toFixed(2)}`;
    totalCostInput.value = totalCost.toFixed(2);
});
