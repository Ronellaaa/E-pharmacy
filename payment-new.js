document.getElementById('cashOnDeliveryBtn').addEventListener('click', function() {
    const confirmed = confirm("Are you sure you want to choose Cash on Delivery?");
    if (confirmed) {
        disableForm();
    }
});


document.getElementById('cancelPaymentBtn').addEventListener('click', function() {
    if (confirm("Are you sure you want to cancel the payment?")) {
        document.getElementById('paymentForm').reset(); // Reset the form
    }
});

function disableForm() {
    const cardFields = ['cardName', 'cardNumber', 'expiryMonth', 'expiryYear', 'cvc'];
    cardFields.forEach(fieldId => {
        const input = document.getElementById(fieldId);
        if (input) {
            input.disabled = true;
        }
    });
}

document.getElementById('paymentForm').addEventListener('submit', function() {
    document.querySelectorAll('input[type="text"], input[type="email"]').forEach(input => {
        input.disabled = false;
    });
});

document.getElementById('paymentForm').addEventListener('submit', function(event) {
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
    console.log(paymentMethod ? paymentMethod.value : "No payment method selected");
});
