document.addEventListener('DOMContentLoaded', () => {
    // Get the orderId from the URL
    const params = new URLSearchParams(window.location.search);
    const orderId = params.get('orderId'); 

    if (!orderId) {
        console.error('No orderId provided in the URL');
        return;
    }

    // Fetch order details from the PHP script
    fetch(`path/to/your/php/script.php?orderId=${orderId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error(data.error); 
                return;
            }

            // Updates HTML elements with the fetched data
            document.getElementById('orderId').innerText = orders.orderId;
            document.getElementById('customerName').innerText = customer.custName;
            document.getElementById('customerAddress').innerText = customer.custAddress;
            document.getElementById('productName').innerText = products.productName;
            document.getElementById('productQty').innerText = order_items.quantity;
            document.getElementById('totalPrice').innerText = orders.totalAmount;

            
            const status = orders.orderStatus; 

            // Example logic to update steps
            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const step3 = document.getElementById('step3');

            if (status === 'processed') {
                step1.style.backgroundColor = '#28a745'; 
                step2.style.backgroundColor = '#e0e0e0'; 
                step3.style.backgroundColor = '#e0e0e0'; 
            } else if (status === 'out for delivery') {
                step1.style.backgroundColor = '#28a745'; 
                step2.style.backgroundColor = '#ffc107'; 
                step3.style.backgroundColor = '#e0e0e0'; 
            } else if (status === 'delivered') {
                step1.style.backgroundColor = '#28a745'; 
                step2.style.backgroundColor = '#ffc107'; 
                step3.style.backgroundColor = '#28a745'; 
            }
        })
        .catch(error => {
            console.error('Error fetching order details:', error);
        });
});
