// Select all the service images
const serviceImages = document.querySelectorAll('.clickable');

// Add an event listener to each image
serviceImages.forEach(function(image) {
    image.addEventListener('click', function() {
        // Get the parent 'service' div and toggle its background color
        const serviceDiv = image.parentElement;

        // Toggle background color between orange and default
        if (serviceDiv.style.backgroundColor === "orange") {
            serviceDiv.style.backgroundColor = "";  // Reset to default
        } else {
            serviceDiv.style.backgroundColor = "orange";  // Change to orange
        }
    });
});