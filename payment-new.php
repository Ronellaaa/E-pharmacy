

<?php
require 'dbconnection.php';
session_start();


// Ensure user is logged in
if (!isset($_SESSION['userId'])) {
    echo "<script>alert('Please log in first!'); window.location.href='../../login.php';</script>";
    exit();
}

$userId = $_SESSION['userId'];


// Retrieve orderId from URL
if (!isset($_GET['orderId'])) {
    echo "<script>alert('No order found.'); window.location.href='./project/php/cart.php';</script>";
    exit();
}

$orderId = intval($_GET['orderId']);


// Process payment form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    

    $orderId = intval($_POST['orderId']);
    $paymentMethod = $_POST['paymentMethod'];
    $paymentStatus = ($paymentMethod === 'Online') ? 'Completed' : 'Pending Confirmation';

    
    exit();

    // Fetch the totalAmount from the order
    $stmt = $conn->prepare("SELECT totalAmount FROM orders WHERE orderId = ? AND custId = ?");
$stmt->bind_param("ii", $orderId, $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "<script>alert('Order not found for this user.');</script>";
    exit(); 
} else {
    $order = $result->fetch_assoc();
}



    if ($order) {
        $totalAmount = $order['totalAmount'];

        // Insert payment details
        $stmt = $conn->prepare("INSERT INTO payments (orderId, paymentMethod, paymentStatus, amount) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issd", $orderId, $paymentMethod, $paymentStatus, $totalAmount);
        $stmt->execute();

        // Update order payment status if paid online
        if ($paymentMethod === 'Online') {
            $stmt = $conn->prepare("UPDATE orders SET payment_status = 'Completed' WHERE orderId = ?");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();

            echo "<script>alert('Payment successful!'); window.location.href='../../order-confirmation.php';</script>";
        } else {
            echo "<script>alert('Cash on Delivery selected. Your order is pending confirmation.'); window.location.href='../../orderStatus.php';</script>";
        }
    } else {
        echo "<script>alert('Order not found.'); window.location.href='./project/php/cart.php';</script>";
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="payment-new.css">
</head>
<body>
    <div class="container">
        <form id="paymentForm" action="/E-pharmacy/payment-new.php" method="POST">
        <input type="hidden" name="orderId" id="orderId" value="<?php echo htmlspecialchars($orderId); ?>">
            
            
            
            <div class="row">
                <div class="col">
                    <h3 class="title">Billing Address</h3>
                    <div class="inputBox">
                        <span>Full Name :</span>
                        <input type="text" name="fullName" required>
                    </div>
                    <div class="inputBox">
                        <span>Email :</span>
                        <input type="email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>Address :</span>
                        <input type="text" name="address" placeholder="House Number - Street - Locality" required>
                    </div>
                    <div class="inputBox">
                        <span>City :</span>
                        <input type="text" name="city" required>
                    </div>
                </div>

                <div class="col">
                    <h3 class="title">Payment</h3>
                    <div class="inputBox">
                        <span>Cards Accepted :</span>
                        <img src="payment-images/card_img.png" alt="Cards Accepted">
                    </div>
                    <div class="inputBox">
                        <span>Name on Card :</span>
                        <input type="text" id="cardName" name="cardName" required>
                    </div>
                    <div class="inputBox">
                        <span>Credit Card Number :</span>
                        <input type="text" id="cardNumber" name="cardNumber" placeholder="1111-2222-3333-4444" required>
                    </div>
                    <div class="inputBox">
                        <span>Exp Month :</span>
                        <input type="text" id="expiryMonth" name="expiryMonth" placeholder="MM" required>
                    </div>
                    <div class="flex">
                        <div class="inputBox">
                            <span>Exp Year :</span>
                            <input type="text" id="expiryYear" name="expiryYear" placeholder="YYYY" required>
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" id="cvc" name="cvc" placeholder="123" required>
                        </div>
                    </div>
                    <div class="inputBox">
                        <span>Payment Method :</span>
                        <input type="radio" name="paymentMethod" value="Online" id="onlinePaymentBtn" required> Online Payment
                        <input type="radio" name="paymentMethod" value="Cash on Delivery" id="cashOnDeliveryBtn" required> Cash on Delivery
                    </div>
                </div>
            </div>
            <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">

            <input type="submit" name="submit" value="Proceed to Checkout" class="submit-btn">
            <input type="button" value="Cancel Payment" class="cancel-btn" id="cancelPaymentBtn">
        </form>
    </div>    
    
    <script src="payment-new.js"></script>
</body>
</html>
