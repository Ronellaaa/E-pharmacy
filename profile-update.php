<?php
// Include config file
require 'dbconnection.php';
// // Start session
 session_start();


// Ensure user is logged in
if (!isset($_SESSION['custId'])) {
    echo "<script>alert('Please log in first.'); window.location.href='sign-Up.php';</script>";
    exit();
}

// Get custId from session
$custID = $_SESSION['custId'];

// Fetch user profile data
$sql = "SELECT * FROM customer WHERE custId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $custID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('No user found! Redirecting to sign-up page.'); window.location.href='sign-Up.php';</script>";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Collect the form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender =$_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    
    // Update the profile in the database
    $sql = "UPDATE customer SET custName=?,custAddress=?, custPhoneNumber=?,custEmail=?, dob=?,gender=? WHERE custId=?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssi", $name, $address,$phone,$email,$dob,$gender, $custID);
        
        if ($stmt->execute()) {
            header("location: profile.php?success=edit");
            exit;
        } else {
            echo "Something went wrong. Please try again.";
        }
        
        $stmt->close();
    }
}

// Close the connection
$conn->close();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>

    <div class="profile-container">
        <div class="profile-details">
            <h2>User Profile</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="Name">Full Name:</label>
                    <input type="text" id="Name" name="name" value="<?php echo htmlspecialchars($user['custName']); ?>">
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>">
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="radio" id="male" name="gender" value="male" <?php echo ($user['gender'] == 'male') ? 'checked' : ''; ?>> Male
                    <input type="radio" id="female" name="gender" value="female" <?php echo ($user['gender'] == 'female') ? 'checked' : ''; ?>> Female
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['custPhoneNumber']); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['custEmail']); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" rows="3" ><?php echo htmlspecialchars($user['custAddress']); ?></textarea>
                </div>

                <!-- Buttons below the profile details -->
                <div class="buttons">
                    <button id="updateBtn">Update Account</button>
                    <button id="saveBtn" type="submit"  name="submit">Save</button>
                    <button id="deleteBtn" >Delete Account</button>
                </div>
            </form>
        </div>

        <!-- Images at the top-right and bottom-right -->
        <div class="images">
            <img src="images/mission.jpg" alt="Profile Picture" class="profile-img-top">
            <img src="images/vision.jpg" alt="Banner" class="profile-img-bottom">
        </div>
    </div>

    <script src="profile.js"></script>
</body>
</html>