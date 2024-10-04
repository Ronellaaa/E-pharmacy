<?php
include 'db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['orderId'])) {
        $orderId = $_POST['orderId']; 
        $paymentMethod = $_POST['paymentMethod'];
        $paymentStatus = 'Pending';

        // Cash on Delivery cancels form completion
        if ($paymentMethod === 'COD') {
            $paymentStatus = 'Pending Confirmation';
        }

        // Fetching order details
        $sql = "SELECT totalAmount FROM orders WHERE orderId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $orderId); 
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();

        if ($order) {
            $totalAmount = $order['totalAmount'];

            // Insert payment details
            $stmt = $conn->prepare("INSERT INTO payments (orderId, paymentMethod, paymentStatus, amount) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issd", $orderId, $paymentMethod, $paymentStatus, $totalAmount);
            $stmt->execute();

            if ($paymentMethod === 'Online') {
                $stmt = $conn->prepare("UPDATE orders SET payment_status = 'Completed' WHERE orderId = ?");
                $stmt->bind_param("i", $orderId);
                $stmt->execute();

                echo "Payment successful!";
            } else {
                echo "Cash on Delivery selected. Please confirm.";
            }
        } else {
            echo "Order not found.";
        }
    } else {
        echo "No order ID provided.";
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="real-payment.css">
</head>
<body>
    <div class="container">
        <form id="paymentForm" action="payment.php" method="POST">
            <input type="hidden" name="orderId" id="orderId" value="123"> <!-- Example order ID -->
            
            <div class="row">
                <div class="col">
                    <h3 class="title">Billing Address</h3>
                    <div class="inputBox">
                        <span>Full Name :</span>
                        <input type="text" name="fullName" required>
                    </div>
                    <div class="inputBox">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="example@example.com" required>
                    </div>
                    <div class="inputBox">
                        <span>Address :</span>
                        <input type="text" name="address" placeholder="Room - Street - Locality" required>
                    </div>
                    <div class="inputBox">
                        <span>City :</span>
                        <input type="text" name="city" placeholder="Mumbai" required>
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
                        <input type="text" id="cardName" name="cardName" placeholder="Mr. John Doe" required>
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
                        <input type="radio" name="paymentMethod" value="Online" id="onlinePaymentBtn"> Online Payment
                        <input type="radio" name="paymentMethod" value="Cash on Delivery" id="cashOnDeliveryBtn"> Cash on Delivery
                    </div>
                </div>
            </div>
            
            <input type="submit" value="Proceed to Checkout" class="submit-btn">
            <input type="button" value="Cancel Payment" class="cancel-btn" id="cancelPaymentBtn">
        </form>
    </div>    
    
    <script src="real-payment.js"></script>
</body>
</html>
