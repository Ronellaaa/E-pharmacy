document.getElementById('cashOnDeliveryBtn').addEventListener('click', function() {
    const confirmed = confirm("Are you sure you want to choose Cash on Delivery?");
    if (confirmed) {
        disableForm();
    }
});

document.getElementById('onlinePaymentBtn').addEventListener('click', function() {
    enableForm();
});

document.getElementById('cancelPaymentBtn').addEventListener('click', function() {
    if (confirm("Are you sure you want to cancel the payment?")) {
        document.getElementById('paymentForm').reset(); // Reset the form
    }
});

function disableForm() {
    document.querySelectorAll('input[type="text"], input[type="email"]').forEach(input => {
        input.disabled = true;
    });
}

function enableForm() {
    document.querySelectorAll('input[type="text"], input[type="email"]').forEach(input => {
        input.disabled = false;
    });
}
