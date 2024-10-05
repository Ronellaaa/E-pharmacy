document.addEventListener('DOMContentLoaded', () => {
    
    fetch('order-status.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            if (data.error) {
                console.error(data.error); 
                return;
            }

            // Update the HTML elements with the fetched data
            document.getElementById('orderId').innerText = data.orderId;
            document.getElementById('customerName').innerText = data.custName;
            document.getElementById('customerAddress').innerText = data.custAddress;
            document.getElementById('status').innerText = data.orderStatus || "N/A"; // Fallback if status is empty

            // Update progress bar based on orderStatus
            if (data.orderStatus.toLowerCase() === 'pending') {
                document.getElementById('step1').classList.add('current-item');
            } else if (data.orderStatus.toLowerCase() === 'completed') {
                document.getElementById('step1').classList.add('current-item');
                document.getElementById('step2').classList.add('current-item');
            } 
        })
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
