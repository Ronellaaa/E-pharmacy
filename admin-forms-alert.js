function closePage() {
  var confirmation = confirm("Are you sure you want to exit this page? ");

  if (confirmation) {
    window.location.href = "admin-dashboard.php";
  }
}

var alertBox = document.getElementById("alertBox");
console.log(alertBox);

if (alertBox) {
  setTimeout(function () {
    alertBox.classList.add("hide"); // Add class to fade out the alert
    console.log("Hide class added to alert box"); // Log when the hide class is added
  }, 2000); // 2 seconds delay
} else {
  console.log("Alert box not found");
}
