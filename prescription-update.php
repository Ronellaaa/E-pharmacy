<?php
session_start();
require 'dbconnection.php';

// Check if the ID is passed through URL
if (isset($_GET['id'])) {
    $prescription_id = $_GET['id'];

    // Fetch prescription data from the database based on the ID
    $query = "SELECT * FROM prescriptions WHERE id = '$prescription_id'";
    $result = mysqli_query($conn, $query);

    // Check if the prescription exists
    if ($result && mysqli_num_rows($result) > 0) {
        $prescription = mysqli_fetch_assoc($result);
    } else {
        echo "No record found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}

// Update the prescription data when the form is submitted
if (isset($_POST['update'])) {
    $patient_name = $_POST['patient_name'];
    $patient_email = $_POST['patient_email'];
    $patient_phone = $_POST['patient_phone'];
    $fulfillment_type = $_POST['fulfillment_type'];
    $payment_method = $_POST['payment_method'];
    $prescription_date = $_POST['prescription_date'];
   

    // Update query to modify the prescription data
    $updateQuery = "UPDATE prescriptions 
                    SET patient_name = '$patient_name', patient_email = '$patient_email', patient_phone = '$patient_phone', 
                        fulfillment_type = '$fulfillment_type', payment_method = '$payment_method', 
                        prescription_date = '$prescription_date' 
                    WHERE id = '$prescription_id'";

    // Execute the update query
    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to the prescriptions list page with a success message
        header('Location: prescription.php?prescription_updated=true');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prescription</title>
    <link rel="stylesheet" href="prescription.css">
</head>
<body>
<a href="./prescription.php"> <button class="close-pres">back</i></button></a>
    <header>
        <h1>Edit Prescription</h1>
    </header>
    <main  class="main-containerr">
    
    <section class="upload-prescription">
        <!-- Form to update the prescription details -->
        <form action="" method="POST">
            <!-- Pre-filled input fields with current prescription data -->
            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" value="<?php echo htmlspecialchars($prescription['patient_name']); ?>" required />

            <label for="patient_email">Patient Email:</label>
            <input type="email" id="patient_email" name="patient_email" value="<?php echo htmlspecialchars($prescription['patient_email']); ?>" required />

            <label for="patient_phone">Patient Phone:</label>
            <input type="tel" id="patient_phone" name="patient_phone" value="<?php echo htmlspecialchars($prescription['patient_phone']); ?>" required />

            <label for="prescription_date">Prescription Date:</label>
            <input type="date" id="prescription_date" name="prescription_date" value="<?php echo htmlspecialchars($prescription['prescription_date']); ?>" required />

            <label for="fulfillment_type">Fulfillment Type:</label>
            <select id="fulfillment_type" name="fulfillment_type" required>
                <option value="Home Delivery" <?php if($prescription['fulfillment_type'] == 'Home Delivery') echo 'selected'; ?>>Home Delivery</option>
                <option value="In-Store Pickup" <?php if($prescription['fulfillment_type'] == 'In-Store Pickup') echo 'selected'; ?>>In-Store Pickup</option>
            </select>

            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="COD" <?php if($prescription['payment_method'] == 'COD') echo 'selected'; ?>>Cash on Delivery</option>
                <option value="Online" <?php if($prescription['payment_method'] == 'Online') echo 'selected'; ?>>Online Payment</option>
            </select>
            <input type="submit" name="update" value="Update Prescription" class="prescriptionbtn">
        </form>
</section>
    </main>

    <?php
include 'hompage-footer.php';
?>
</body>
</html>
