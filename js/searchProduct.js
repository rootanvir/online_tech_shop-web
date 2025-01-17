document.getElementById("search_bar").addEventListener("input", async function () {
    const query = this.value.trim();

    // Exit if the search box is empty
    if (query === "") return;

    try {
        // Send the search query to PHP for processing
        const response = await fetch('php/search-product.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `query=${encodeURIComponent(query)}`
        });

        // You can log the response if needed, but we're not displaying anything
        console.log('Search query sent successfully.');
    } catch (error) {
        console.error("Error:", error);
    }
});
