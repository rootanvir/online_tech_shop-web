document
  .getElementById("search_bar")
  .addEventListener("input", async function () {
    const query = this.value.trim();

    // Exit if the search box is empty
    if (query === "") {
      document.getElementById("search_results").innerHTML = ""; // Clear previous results
      return;
    }

    try {
      // Send the search query to loadProduct.php for processing
      const response = await fetch(
        `php/loadProduct.php?query=${encodeURIComponent(query)}`
      );

      // Check if the request was successful
      if (response.ok) {
        const data = await response.json();
        displayProducts(data.products); // Call the function to display products
      } else {
        console.error("Error fetching search results");
      }
    } catch (error) {
      console.error("Error:", error);
    }
  });

function displayProducts(products) {
  const productList = document.getElementById("search_results");
  productList.innerHTML = ""; // Clear previous results

  if (products.length === 0) {
    productList.innerHTML = "<p>No products found.</p>";
    return;
  }

  // Loop through the products and display them in grid format
  products.forEach((product) => {
    const productItem = document.createElement("div");
    productItem.classList.add("product-item");
    productItem.innerHTML = `
            <div class="product-card">
                <img src="${product.product_image}" alt="${product.product_name}" class="product-image">
                <h3 class="product-name">${product.product_name}</h3>
                <p class="product-category">${product.product_category}</p>
                <p class="product-price">$${product.product_price}</p>
                <p class="product-quantity">Quantity: ${product.product_quantity}</p>
                <p class="product-location">${product.product_location}</p>
            </div>
        `;
    productList.appendChild(productItem);
  });
}
