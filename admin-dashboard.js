function setupDropdown(itemClass) {
  item = document.querySelector(itemClass);

  item.addEventListener("click", function () {
    const dropDown = this.querySelector(".dropdown-ul");
    const arrowDown = this.querySelector(".side-arrow");

    dropDown.classList.toggle("show");

    if (arrowDown.classList.contains("fa-chevron-right")) {
      arrowDown.classList.remove("fa-chevron-right");
      arrowDown.classList.add("fa-angle-down");
    } else {
      arrowDown.classList.remove("fa-angle-downf");
      arrowDown.classList.add("fa-chevron-right");
    }
  });
}

setupDropdown(".products-item");
function closePage() {
  var confirmation = confirm("Are you sure you want to exit this page? ");

  if (confirmation) {
    window.location.href = "admin-products.php";
  }
}

var alertBox = document.getElementById("alertBox");
console.log(alertBox);

var ctx = document.getElementById("categoryChart").getContext("2d");

var chart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: categoryNames, // These variables are now defined in the HTML
    datasets: [
      {
        label: "Number of Products",
        data: categoryCounts,
        backgroundColor: "rgb(102, 67, 67, 0.7)",
        borderColor: "rgb(59, 48, 48, 1)",
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          font: {
            weight: "bold", // Make Y-axis labels bold
            size: 14, // Adjust font size if needed
          },
          color: "#000",
        },
      },
      x: {
        ticks: {
          font: {
            weight: "bold", // Make X-axis labels bold
            size: 14, // Adjust font size if needed
          },
          color: "#000",
        },
      },
    },
    plugins: {
      legend: {
        labels: {
          font: {
            weight: "bold", // Make legend labels bold
            size: 16, // Adjust font size if needed
          },
          color: "#000",
        },
      },
    },
  },
});


var ctx1 = document.getElementById("productChart").getContext('2d');

// var pieChart = new Chart(ctx, {
//     type: 'pie',  // Set the chart type to "pie"
//     data: {
//         labels: productNames,  // Product names as labels
//         datasets: [{
//             data: productCounts,  // Product counts as data
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         responsive: true,
//         plugins: {
//             legend: {
//                 position: 'top'
//             }
//         }
//     }
// });

var pieChart = new Chart(ctx1, {
  type: 'pie',
  data: {
      labels: productNames,  // Product names as labels
      datasets: [{
          data: productCounts,  // Directly use product quantities
          backgroundColor: [
              'rgb(121, 87, 87, 0.8)',
              'rgb(185, 148, 112, 0.8)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
              'rgba(121, 87, 87, 2)',
              'rgba(185, 148, 112, 2)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
  },
  options: {
    maintainAspectRatio: false,
      responsive: true,
      plugins: {
          legend: {
              position: 'top'
          }
      }
  }
});