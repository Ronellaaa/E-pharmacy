document.getElementById('cashOnDeliveryBtn').addEventListener('click', function() {
    const confirmed = confirm("Are you sure you want to choose Cash on Delivery?");
    if (confirmed) {
        document.getElementById('paymentForm').action = 'order-status.php'; // Redirect to order status page
        document.getElementById('paymentForm').submit(); // Submit the form
    }
});

document.getElementById('onlinePaymentBtn').addEventListener('click', function() {
    document.getElementById('paymentForm').action = 'payment.php'; // Set action back to payment
});
