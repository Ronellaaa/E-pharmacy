document.addEventListener('DOMContentLoaded', () => {
    const updateStatusBtn = document.getElementById('updateStatusBtn');
    const orderId = document.getElementById('orderId').innerText;

    updateStatusBtn.addEventListener('click', () => {
        const orderStatus = document.getElementById('orderStatus').value;

        if (!orderStatus) {
            alert('Please select an order status.');
            return;
        }

        // Send a POST request to update the order status
        fetch('driver-update.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `orderId=${orderId}&orderStatus=${orderStatus}`
        })
        .then(response => response.json())  // Change this line to parse JSON
        .then(data => {
            if (data.error) {
                alert(data.error);  // Show error message if there is an error
            } else {
                alert(data.message);  // Show success message
            }
            location.reload(); // Reload the page to update the displayed status
        })
        .catch(error => {
            console.error('Error updating order status:', error);
        });
    });
});
