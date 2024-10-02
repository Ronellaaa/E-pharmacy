<?php
session_start();
include 'dbconnection.php'; 


if (!isset($_SESSION['custId'])) {
    header("Location: profile-update.php"); 
    exit();
}


$custId = $_SESSION['custId'];


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

if (isset($_POST['update_account'])) {
    header("Location: profile-update.php"); 
    exit();
}


// if (isset($_POST['delete_account'])) {
//     $deleteQuery = "DELETE FROM profile WHERE email = ?";
//     $deleteStmt = $conn->prepare($deleteQuery);
//     $deleteStmt->bind_param('s', $email);
    
//     if ($deleteStmt->execute()) {
       
//         session_destroy(); 
//         header("Location:  profile-update.php"); 
//         exit();
//     } else {
//         echo "<script>alert('Failed to delete account!');</script>";
//     }
// }

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
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="Name" name="name" value="<?php echo htmlspecialchars($user['custName']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="radio" id="male" name="gender" value="male" <?php echo ($user['gender'] == 'male') ? 'checked' : ''; ?> disabled> Male
                <input type="radio" id="female" name="gender" value="female" <?php echo ($user['gender'] == 'female') ? 'checked' : ''; ?> disabled> Female
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['custPhoneNumber']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['custEmail']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" disabled><?php echo htmlspecialchars($user['custAddress']); ?></textarea>
            </div>

            <!-- Buttons below the profile details -->
            <div class="buttons">
                <a href="profile-update.php?updateId=<?php echo $user['custId']?>" id="updateBtn">Update btn</a>
                <!-- <button id="updateBtn">Update Account</button> -->
                <button id="saveBtn" type="submit" disabled>Save</button>
                <!-- <button id="deleteBtn">Delete Account</button> -->
                  <a href="profile-delete.php?deleteId=<?php echo $user['custId']?>" id="deleteBtn">Delete btn</a>
            </div>
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
