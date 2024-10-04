
document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevents form from submitting automatically

    // Get form values
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirmPassword').value;

    // Basic validation for password match
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return; // Stop further execution if passwords do not match
    }

    if (password.length < 5) {
        alert('Password must be more than 5 characters.');
        return;
    }

    let phone = document.getElementById('phone').value;

    // Validate phone number (only 10 digits)
    if (phone.length !== 10 || isNaN(phone)) {
        alert('Phone number must be 10 digits long and contain only numbers.');
        return; // Stop further execution if phone number is invalid
    }

    // If all validations pass, submit the form
    function sucessmsg(){
    alert('Form submitted successfully!');
    this.submit();
    }  // Submits the form after successful validation
});


