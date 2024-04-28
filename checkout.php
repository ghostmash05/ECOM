<?php
    include "components/header.php";
    if (!isset($_SESSION["email"])) {
        header("Location: auth.php");
        exit();
    }

  
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = :email");
    $stmt->bindParam(':email', $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        $prodid = $result['product_id'];
        $quantity = $result['quantity'];

        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = :prodid");
        $stmt->bindParam(':prodid', $prodid);
        $stmt->execute();
        $product = $stmt->fetch();
        $title = $product['product_title'];
        $price = $product['price'];

        $subtotal = $price * $quantity;

    } else {
        echo "Error: Unable to fetch cart data";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="checkout.css">
</head>
<body>
    <div class="container">
        <h2>Order Summary</h2>
        <p>Item Name: <?=$title;?></p>
        <p>Quantity: <?=$quantity;?> </p>
        <p>Subtotal: <?=$subtotal?>&nbspTaka</p>
        <div class="delivary">
            <h2>Delivery Address</h2>
            <form action="process_order.php" method="POST">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required><br><br>

                <label for="city">City:</label>
                <input type="text" name="city" id="city" required><br><br>

                <label for="state">State:</label>
                <input type="text" name="state" id="state" required><br><br>

                <label for="zip">ZIP Code:</label>
                <input type="text" name="zip" id="zip" required><br><br>

                <label for="country">Country:</label>
                <input type="text" name="country" id="country" required><br><br>
            </form>
        </div>
        <div class="payment">
            <h2>Payment Method</h2>
            <form action="process_order.php" method="POST">
                <label for="payment" class="payment">Select Payment Method:</label>
                <select name="payment_opt" id="payment_opt" class="payment_opt">
                    <option value="bkash">Bkash</option>
                    <option value="nagad">Nagad</option>
                    <option value="rocket">Rocket</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash">Cash On Delivery</option>
                </select><br><br>

                <div class="pay">
                    <button type="submit">Pay & Confirm</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>