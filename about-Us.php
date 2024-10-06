
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CareMeds</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="about-Us.css">
</head>

<body>
    <div class="main-container">

    <?php
include_once 'homepage-header.php';
?>

        <div class="background"></div>

        <!-- Purpose Section -->
        <div class="content">
            <div class="text-section">
                <h2>Purpose</h2>
                <p>At CareMeds, our purpose is to provide easy access to quality healthcare services and products. We aim to ensure the well-being of our customers by offering fast and reliable delivery of medical essentials.</p>
            </div>
            <div class="image-section">
                <img src="images/purpose.jpg" alt="Purpose Image" width="400px" height="400px">
            </div>
        </div>

        <!-- What Do We Do? Section -->
        <div class="what-we-do">
            <h2>What do we do?</h2>
            <div class="services">
                <div class="service">
                    <img src="images/service1.jpg" alt="Service 1" class="clickable">
                    <p>Medicine purchasing</p>
                </div>
                <div class="service">
                    <img src="images/service2.jpg" alt="Service 2" class="clickable">
                    <p>Availability of many products</p>
                </div>
                <div class="service">
                    <img src="images/service3.jpg" alt="Service 3" class="clickable">
                    <p>Medication delivery</p>
                </div>
            </div>
        </div>

        <!-- Vision and Mission Section -->
        <div class="content">
            <div class="text-section">
                <h2>Vision</h2>
                <p>Our goal is to completely transform the healthcare sector by providing easily accessible, transparent, and long-lasting health insurance options to both individuals and businesses.</p>
            </div>
            <div class="image-section">
                <img src="images/vision.jpg" alt="Vision Image" width="400px" height="400px">
            </div>
        </div>

        <div class="content">
            <div class="text-section">
                <h2>Mission</h2>
                <p>At CareMeds, we are dedicated to providing innovative solutions that enhance healthcare access, encourage preventative care, and cultivate a well-being oriented culture.</p>
            </div>
            <div class="image-section">
                <img src="images/mission.jpg" alt="Mission Image" width="400px" height="400px">
            </div>
        </div>

       

        <!-- Ensure the JavaScript file is correctly linked -->
        <script src="about-Us.js"></script>
    </div>
     
<?php
include_once 'hompage-footer.php';
?>
</body>
</html>
