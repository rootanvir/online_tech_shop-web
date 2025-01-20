document.addEventListener("DOMContentLoaded", () => {
  const { months, totals } = chartData;

  if (months && totals) {
    const ctx = document.getElementById("sales_chart").getContext("2d");

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
