function showToast(message, type = 'info', duration = 3000) {
    // Create toast element
    //info = info || error || success
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;

    // Get the toast container
    const container = document.getElementById('toast-container');
    container.appendChild(toast);

    // Auto-remove the toast after the specified duration
    setTimeout(() => {
        toast.classList.add('hidden');
        toast.addEventListener('transitionend', () => toast.remove());
    }, duration);
}
