<?php
session_start();
include 'dbconnection.php'; 

if (!isset($_SESSION['userId'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}




// Fetch user data based on session userId
$custId = $_SESSION['userId'];
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
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="Name" name="name" value="<?php echo htmlspecialchars($user['custName']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" disabled>
            </div>
            <div class="form-group gender">
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
               <button> <a href="profile-update.php?updateId=<?php echo $user['custId']?>" id="updateBtn">Update btn</a></button>
                <!-- <button id="updateBtn">Update Account</button> -->
                <button id="saveBtn" type="submit" disabled>Save</button>
                <!-- <button id="deleteBtn">Delete Account</button> -->
                <button><a href="profile-delete.php?deleteId=<?php echo $user['custId']?>" id="deleteBtn">Delete btn</a></button>
            </div>
        </div>

        <!-- Images at the top-right and bottom-right -->
        <div class="images">
        <a href="./home-page.php"> <button class="close-home"><i class="fa-solid fa-x"></i></button></a>
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

            <dotlottie-player src="https://lottie.host/50a35443-5e8f-403f-8920-8fe51affb2e4/E8fLiEuelG.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>


        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

<dotlottie-player src="https://lottie.host/efd8cbda-4a3a-4569-89fd-a6eeae65c3df/OKOD7qWrxJ.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay class="profile-img-bottom"></dotlottie-player>
        </div>

    </div>

    <script src="profile.js"></script>
</body>
</html>
