<?php
session_start();
// Include config file

require 'dbconnection.php';


if (!isset($_SESSION['userId'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

$custId = $_SESSION['userId'];

// Fetch user information for pre-filling the form
$query = "SELECT * FROM customer WHERE custId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $custId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc(); 

if (!$user) {
    echo "<script>alert('No user found!'); window.location.href='sign-Up.php';</script>";
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
        $stmt->bind_param("ssssssi", $name, $address,$phone,$email,$dob,$gender, $custId);
        
        if ($stmt->execute()) {
            header("location: profile.php?success=edit");
            // Check collected data


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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
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
        <a href="./profile.php"> <button class="close-home"><i class="fa-solid fa-x"></i></button></a>
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
<dotlottie-player src="https://lottie.host/289e9c1a-9380-49ac-b00f-dcac0584b334/FB4HUh1Vmj.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
<dotlottie-player src="https://lottie.host/86d0d259-db46-48b3-a819-d1c70cc8c88a/VAEqnFdE5O.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
        </div>
    </div>

    <script src="profile.js"></script>
</body>
</html>