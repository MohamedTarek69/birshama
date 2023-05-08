<?php
session_start();

// Get the product ID and quantity from the form data
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Update the quantity of the product in the cart
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] = $quantity;
}

// Redirect back to the cart page
header('Location: cart.php');
exit();
?>