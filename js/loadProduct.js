let currentPage = 1; // Initialize current page to 1
let totalPages = 1; // To be determined once the server responds

// Function to load products based on current page
async function loadProducts(page = 1) {
    try {
        const response = await fetch(`../php/loadProduct.php?page=${page}`);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        const products = data.products;
        totalPages = data.totalPages; // Update total pages from the response

        const gridContainer = document.getElementById('productGrid');
        gridContainer.innerHTML = ''; // Clear existing content

        if (products.length === 0) {
            gridContainer.innerHTML = '<p>No products available.</p>';
        } else {
            // Add products to the grid
            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');
                productCard.innerHTML = `
                            <img src="${product.product_location}" alt="${product.product_name}">
                            <h3>${product.product_name}</h3>
                            <p>৳ ${product.product_price}</p>
                            <button>Add to Cart</button>
                        `;
                gridContainer.appendChild(productCard);
            });
        }

        // Scroll to the top of the page
        window.scrollTo(0, 0);

        // Update pagination buttons
        checkPagination();

    } catch (error) {
        console.error("Error loading products:", error);
        document.getElementById('productGrid').innerHTML = '<p>Failed to load products. Please try again later.</p>';
        disablePaginationButtons();
    }
}

// Function to check pagination button states (Previous and Next)
function checkPagination() {
    // Disable Previous button if on the first page
    document.getElementById('prevPage').disabled = currentPage === 1;

    // Disable Next button if on the last page
    document.getElementById('nextPage').disabled = currentPage === totalPages;
}

// Disable both pagination buttons
function disablePaginationButtons() {
    document.getElementById('prevPage').disabled = true;
    document.getElementById('nextPage').disabled = true;
}

// Event listener for Previous page button
document.getElementById('prevPage').addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        loadProducts(currentPage); // Load the previous page
    }
});

// Event listener for Next page button
document.getElementById('nextPage').addEventListener('click', () => {
    if (currentPage < totalPages) {
        currentPage++;
        loadProducts(currentPage); // Load the next page
    }
});

// Load the first page when the page is ready
window.onload = () => loadProducts(currentPage);