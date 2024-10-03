
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', (event) => {
       
        const customerName = form.querySelector('input[name="customerName"]').value;
        const cutomerAddress = form.querySelector('input[name="cutomerAddress"]').value;
        const customerEmail = form.querySelector('input[name="customerEmail"]').value;
        const phone_number = form.querySelector('input[name="phone_number"]').value;
        const Message = form.querySelector('textarea[name="Message"]').value;

       
        if (!customerName || !cutomerAddress || !customerEmail || !phone_number || !Message) {
            alert('Please fill in all fields.');
            return;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(customerEmail)) {
            alert('Please enter a valid email address.');
            return;
        }


        alert("We recieved your message! We will respond shortly");
        console.log('We recieved your message! We will respond shortly');
        form.submit();

        
    });
});
