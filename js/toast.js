function toast(message, duration) {
    // Create alert element
    const alert = document.createElement('div');
    alert.className = 'alert';
    alert.textContent = message;

    // Add alert to the document
    document.body.appendChild(alert);

    // Remove alert after the specified duration
    setTimeout(() => {
        alert.classList.add('hidden'); // Add hidden class to fade out
        alert.addEventListener('transitionend', () => alert.remove()); // Remove from DOM after transition
    }, duration);
}