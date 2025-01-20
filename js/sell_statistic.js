document.addEventListener("DOMContentLoaded", () => {
  // Extract chart data from the global variable
  const { months, totals } = chartData;

  // Check if data exists before initializing the chart
  if (months && totals) {
    // Get the chart context
    const ctx = document.getElementById("sales_chart").getContext("2d");

    // Initialize the chart
    new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [
          {
            label: "Total Sales",
            data: totals,
            borderColor: "blue",
            backgroundColor: "rgba(173, 216, 230, 0.5)",
            fill: true,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true },
        },
        scales: {
          x: { title: { display: true, text: "Month" } },
          y: { title: { display: true, text: "Total Sales (Price)" } },
        },
      },
    });
  } else {
    console.log("No data available for the chart.");
  }
});
