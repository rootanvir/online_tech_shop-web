let currentPage = 1;

        async function loadProducts(page = 1) {
            try {
                const response = await fetch(`../php/loadProduct.php?ajax=true&page=${page}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const products = await response.json();
                if (!Array.isArray(products)) {
                    throw new Error("Fetched data is not an array.");
                }

                const gridContainer = document.getElementById('productGrid');
                gridContainer.innerHTML = ''; // Clear existing content

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
            } catch (error) {
                console.error("Error loading products:", error);
                document.getElementById('productGrid').innerHTML = '<p>Failed to load products. Please try again later.</p>';
            }
        }

        // Event Listeners for Pagination
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                loadProducts(currentPage);
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            currentPage++;
            loadProducts(currentPage);
        });

        // Load the first page initially
        window.onload = () => loadProducts(currentPage);