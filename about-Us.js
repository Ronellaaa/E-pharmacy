// Select all the service images
const serviceImages = document.querySelectorAll(".clickable");

// Add an event listener to each image
serviceImages.forEach(function (image) {
  image.addEventListener("click", function () {
    // Get the parent 'service' div and toggle its background color
    const serviceDiv = image.parentElement;

    // Toggle background color between brown and default
    if (serviceDiv.style.backgroundColor === "brown") {
      serviceDiv.style.backgroundColor = ""; // Reset to default
    } else {
      serviceDiv.style.backgroundColor = "brown"; // Change to brown
    }
  });
});
