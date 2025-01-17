function showToast(message, type = 'info', duration = 3000) {
    const toastContainer = window.parent.document.getElementById('toast-container'); // Use the parent container
    if (!toastContainer) {
        console.error("Toast container not found in parent page.");
        return;
    }

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;

    toastContainer.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('hidden');
        toast.addEventListener('transitionend', () => toast.remove());
    }, duration);
}
