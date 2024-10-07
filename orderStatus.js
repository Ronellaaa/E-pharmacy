document.addEventListener('DOMContentLoaded', () => {
    fetch('orderStatus.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            if (data.error) {
                console.error(data.error); 
                document.getElementById('orderId').innerText = "N/A"; // Show N/A if no order found
                document.getElementById('customerName').innerText = "N/A"; // Show N/A
                document.getElementById('customerAddress').innerText = "N/A"; // Show N/A
                return;
            }

            // Update the HTML elements with the fetched data
            document.getElementById('orderId').innerText = data.orderId || "N/A"; // Fallback if orderId is empty
            document.getElementById('customerName').innerText = data.custName || "N/A"; // Fallback if custName is empty
            document.getElementById('customerAddress').innerText = data.custAddress || "N/A"; // Fallback if custAddress is empty

            // Update progress bar based on orderStatus
            if (data.orderStatus.toLowerCase() === 'pending') {
                document.getElementById('step1').classList.add('current-item');
            } else if (data.orderStatus.toLowerCase() === 'completed') {
                document.getElementById('step1').classList.add('current-item');
                document.getElementById('step2').classList.add('current-item');
            } 
        })
        .catch(error => {
            console.error('Error fetching order status:', error);
        });
});
