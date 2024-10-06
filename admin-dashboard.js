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
    window.location.href = "admin-dashboard.php";
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

var pieChart = new Chart(ctx1, {
  type: 'pie',
  data: {
      labels: productNames,  // Product names as labels
      datasets: [{
          data: productCounts,  // Directly use product quantities
          backgroundColor: [
            'rgb(169, 68, 56, 0.7)',
            'rgb(210, 69, 69, 0.7)',
            'rgb(230, 186, 163,0.7)',
             'rgb(67, 118, 108,0.7)',
            'rgb(228, 222, 190,0.7)'
          ],
          borderColor: [
              
              'rgb(210, 69, 69, 2)',
              'rgb(230, 186, 163,2)',
              'rgb(230, 186, 163,2)',
              'rgb(67, 118, 108,2)',
              'rgb(228, 222, 190,2)'
             
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