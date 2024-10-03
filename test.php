<?php
// Include your database connection here
include 'db-connection.php'; // Make sure this file contains your DB connection logic 
// Initialize variables for storing messages
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['customerName'];
    $address = $_POST['cutomerAddress'];
    $email = $_POST['customerEmail'];
    $phone=$_POST['phone_number'];
    $message = $_POST['Message'];

    // Insert into database
    $sql = "INSERT INTO contactus (customerName, cutomerAddress, customerEmail, phone_number, Message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $address, $email, $phone, $message);

    if ($stmt->execute()) {
        // Show success message with SweetAlert
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Your message has been sent successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'test.php'; // Redirect to the ContactUs page
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'There was an error sending your message.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<link rel="stylesheet" type="text/css" href="contact-us.css"> <!-- Linking external CSS file -->


<div class="container">
    <div class="contact-container">
        <div class="contact-image">
            <!-- add image with extra styuff -->
            <!-- <img src="ADDIMAGEPATHjpg" alt="Contact Us"> -->
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form action="send-contact.php" method="POST">
                <label for="customerName">Name:</label>
                <input type="text" id="customerName" name="customerName" required>
                
                <label for="cutomerAddress">Address:</label> 
                <input type="text" id="cutomerAddress" name="cutomerAddress" required>
            
                <label for="customerEmail">Email:</label>
                <input type="email" id="customerEmail" name="customerEmail" required>
            
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            
                <label for="Message">Message:</label>
                <textarea id="Message" name="Message" required></textarea>
            
                <button type="submit" name="submit">Submit</button>
            </form>
            
        </div>
    </div>
    </div>
</div>