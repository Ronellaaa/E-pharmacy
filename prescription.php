
<?php

session_start();
require 'dbconnection.php';

if (!isset($_SESSION['userId'])) {
    echo "<script>alert('Please log in first!'); window.location.href='login.php';</script>";
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $patient_name = $_POST['patient_name'];
    $patient_email = $_POST['patient_email'];
    $patient_phone = $_POST['patient_phone'];
    $fulfillment_type = $_POST['fulfillment_type'];
    $payment_method = $_POST['payment_method'];
    $prescription_date = $_POST['prescription_date'];
    $status = "Pending";
    $custId = $_SESSION['userId'];

    // File upload handling
    $file_name = $_FILES["prescription_file"]["name"];
    $temp_name = $_FILES["prescription_file"]["tmp_name"];
    $file_type = $_FILES["prescription_file"]["type"];
    

    // Set upload directory
    $upload_dir = 'uploads/';
    $target_file = $upload_dir . basename($file_name);

    // Check file type and move uploaded file
    if ($file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'application/pdf') {
        if (move_uploaded_file($temp_name, $target_file)) {
            // Insert data into the database
            $query = "INSERT INTO prescriptions (patient_name, patient_email, patient_phone, prescription_file, prescription_date, fulfillment_type, payment_method, status,custId) 
                      VALUES ('$patient_name', '$patient_email', '$patient_phone', '$target_file', '$prescription_date', '$fulfillment_type', '$payment_method', '$status','$custId')";

            // Execute the query
            if (mysqli_query($conn, $query)) {
                header('Location: prescription.php?prescription_added=true');
            } else {
                echo "Failed to add the record: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload file.";
           

        }
    } else {
        echo "Invalid file type. Only JPEG, PNG, and PDF are allowed.";
    }
}
$fetchQuery = "SELECT * FROM prescriptions"; //add karapu data retreive karanawa
$result = mysqli_query($conn, $fetchQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prescription Management</title>
    <link rel="stylesheet" href="prescription.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />

    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
</head>
<body>

<?php
include_once 'homepage-header.php';
?>

    <header>
        <h1>Prescriptions</h1>
    </header>

 
 
    <dotlottie-player src="https://lottie.host/e1a58e02-4ffd-4dc2-a828-2edf6c002a7b/rwLWYHjz3e.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay class="robot"></dotlottie-player>
    <main class="main-containerr">
        
        <section class="upload-prescription">
            <h2>Upload a New Prescription</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <input type="text" name="patient_name" placeholder="Patient Name" required />
                <input type="email" name="patient_email" placeholder="Patient Email" required />
                <input type="tel" name="patient_phone" placeholder="Patient Phone" required />
                <input type="file" name="prescription_file" accept=".pdf, .jpg, .jpeg, .png" required />
                <input type="date" name="prescription_date" required />
                <select name="fulfillment_type" required>
                    <option value="" disabled selected>Choose Fulfillment Type</option>
                    <option value="Home Delivery">Home Delivery</option>
                    <option value="In-Store Pickup">In-Store Pickup</option>
                </select>
                <select name="payment_method" required>
                    <option value="" disabled selected>Choose Payment Method</option>
                    <option value="COD">Cash on Delivery</option>
                    <option value="Online">Online Payment</option>
                </select>
                <input type="submit" name="submit" value="Upload Prescription" class="prescriptionbtn">
            </form>
        </section>

        <section class="prescription-list">
            <h2>Uploaded Prescriptions</h2>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="prescription-item">';
                    echo '<div>';
                    echo '<p><strong>' . htmlspecialchars($row['prescription_file']) . '</strong></p>';
                    echo '<p>Status: <span class="status">' . htmlspecialchars($row['status']) . '</span></p>';
                    echo '<p>Uploaded on: ' . htmlspecialchars($row['prescription_date']) . '</p>';
                    echo '</div>';
                    echo '<div>';
                    echo '<a href="prescription-update.php?id=' . $row['id'] . '"><i class="fa-solid fa-pen"></i></a>';
                    echo ' | ';
                    echo '<a href="prescription-dlt.php?delete_id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this prescription?\')"<i class="fa-solid fa-trash"></i></a>';

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No prescriptions uploaded yet.</p>';
            }
            ?>
        </section>
    </main>
  <script>

    const isLogged ="<?php echo isset($_SESSION['userId']) ? 'true' : 'false'; ?>";
    if (isLoggedIn === "false") {
        // If user is not logged in, redirect them to the login page
        alert("You must log in to upload a prescription.");
        window.location.href = "login.php";
    }
  </script>
    <?php
include 'hompage-footer.php';
?>
</body>

</html>
