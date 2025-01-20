document.getElementById("search_bar").addEventListener("input", async function () {
  const query = this.value.trim();
  if (query === "") return;
  try {
      const response = await fetch('php/search-product.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `query=${encodeURIComponent(query)}`
      });
      console.log('Search query sent successfully.');
  } catch (error) {
      console.error("Error:", error);
  }
});