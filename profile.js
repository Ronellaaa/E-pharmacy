
document.addEventListener('DOMContentLoaded', function() {
    const updateBtn = document.getElementById('updateBtn');
    const saveBtn = document.getElementById('saveBtn');
    const deleteBtn = document.getElementById('deleteBtn');
  
    const inputs = document.querySelectorAll('input, textarea');
  
    // Enable editing when clicking 'Update Account'
    updateBtn.addEventListener('click', function() {
        inputs.forEach(input => {
            input.disabled = false;  // Enable all form fields for editing
        });
        saveBtn.disabled = false;  // Enable the Save button
        updateBtn.disabled = true; // Disable Update button while editing
    });
  
    // Save changes
    saveBtn.addEventListener('click', function(event) {
        // Ensure that the form is submitted
        const form = saveBtn.closest('form');
        if (form) {
            form.submit(); // This will submit the form to the server
        }
    });
  
    // Delete account with confirmation
    deleteBtn.addEventListener('click', function() {
        const confirmation = confirm("Are you sure you want to delete your account?");
        if (confirmation) {
            alert('Account is deleted.');
            window.location.href = 'sign-up.html';  // Redirect to sign-up page
        }
    });
  });
  



