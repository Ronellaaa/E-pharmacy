<?php

require '../../dbconnection.php';
session_start(); // Start session to track logged-in users

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    echo "<script>alert('Please log in first!'); window.location.href='../../login.php';</script>";
    exit();
}

$userId = $_SESSION['userId']; // Get the logged-in user's ID

// Update quantity in cart
if (isset($_POST['update'])) {
    $update = $_POST['update_quan'];
    $cartId = $_POST['cartId'];
    $update_cart = mysqli_query($conn, "UPDATE cart SET quantity='$update' WHERE cartId ='$cartId' AND custId = '$userId'");
    if ($update_cart) {
        header('location:cart.php');
        exit();
    }
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $removeId = $_GET['remove'];
    $delete_row = mysqli_query($conn, "DELETE FROM cart WHERE cartId ='$removeId' AND custId = '$userId'");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/cart.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div id="wrapper">
    <h2 class="title">Shopping Cart</h2>

    <div class="table">
        <table class="tbl-cart">
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
                <th>Remove</th>
            </tr>

            <?php
            // Fetch cart items for the logged-in user only
            $show_cart = mysqli_query($conn, "SELECT * FROM cart WHERE custId = '$userId'");
            $total = 0;

            if (mysqli_num_rows($show_cart) > 0) {
                while ($row = mysqli_fetch_assoc($show_cart)) {
                    $pID = $row["productId"];
                    // Get product details
                   
                    $show_cart2 = mysqli_query($conn, "SELECT image_path, productName FROM products WHERE productId ='$pID'");
                    if (mysqli_num_rows($show_cart2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($show_cart2)) 
                        
                        {
            ?>
            <tr> 
                <td>
                    <?php
                    
                    echo '<img src="/E-pharmacy/' . $row2['image_path'] . '" alt="Image not found">'; ?>
                </td>
                <td><?php echo $row2["productName"]; ?></td>
                <td class="price">Rs. <?php echo $row["price"]; ?>/-</td>
                <td>
                    <form method="post" action="cart.php">
                        <input type="hidden" value="<?php echo $row["cartId"]; ?>" name="cartId">
                        <input type="number" min="1" value="<?php echo $row["quantity"]; ?>" name="update_quan">
                        <input type="submit" value="Update" name="update">
                    </form>
                </td>
                <td>Rs.<?php echo $sub_total = $row["price"] * $row["quantity"]; ?>/-</td>
                <td><a href="cart.php?remove=<?php echo $row["cartId"]; ?>" onclick="return confirm('Want to remove item')" class="deletebtn"><i class="fa fa-trash-o"></i></a></td>
            </tr>
            <?php
                            $total += $sub_total;
                        }
                    }
                }
            }
            ?>
        </table>
    </div>

    <div class="summary">
        <div class="price">
            <p>Grand Total</p>
            <h6>Rs. <?php echo $total; ?>/-</h6>
        </div>
    </div>

    <div class="btn-group">
        <button class="btn"><i class="fa fa-arrow-left"></i><a href="./product.php"> Continue shopping</a></button>
        <button class="btn"><a href="../../payment.php?TOTAL=<?php echo $total; ?>">Checkout </a>&nbsp<i class="fa fa-arrow-right"></i></button>
    </div>
</div>

</body>
</html>