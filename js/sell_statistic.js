// Generate gradient background for bars
const ctx = document.getElementById("salesChart").getContext("2d");
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, "rgba(54, 162, 235, 0.8)"); // Light Blue
gradient.addColorStop(1, "rgba(75, 192, 192, 0.2)"); // Light Green

// Render the bar chart with a new style
const salesChart = new Chart(ctx, {
  type: "bar", // Specify chart type
  data: {
    labels: products, // X-axis labels
    datasets: [
      {
        label: "Total Quantity Sold",
        data: quantities, // Y-axis data
        backgroundColor: gradient, // Gradient fill
        borderColor: "rgba(54, 162, 235, 1)", // Border color
        borderWidth: 2, // Border thickness
        borderRadius: 5, // Rounded corners on bars
        hoverBackgroundColor: "rgba(255, 99, 132, 0.6)", // Hover color
        hoverBorderColor: "rgba(255, 99, 132, 1)",
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: true,
        position: "top",
        labels: {
          color: "#333", // Legend label color
          font: {
            size: 14, // Legend font size
          },
        },
      },
      tooltip: {
        enabled: true,
        backgroundColor: "rgba(0, 0, 0, 0.8)",
        bodyColor: "#fff",
        borderColor: "#ddd",
        borderWidth: 1,
      },
    },
    scales: {
      x: {
        ticks: {
          color: "#666", // X-axis label color
          font: {
            size: 12,
          },
        },
        grid: {
          color: "#eaeaea", // X-axis grid line color
          borderDash: [5, 5], // Dashed grid lines
        },
      },
      y: {
        ticks: {
          color: "#666", // Y-axis label color
          font: {
            size: 12,
          },
          stepSize: 1, // Step size for Y-axis
        },
        grid: {
          color: "#eaeaea", // Y-axis grid line color
          borderDash: [5, 5],
        },
        beginAtZero: true,
      },
    },
  },
});
