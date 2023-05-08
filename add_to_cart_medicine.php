<?php
session_start();

// Get the product ID and quantity from the form data
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Read the cart data from the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add the product to the cart
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = $quantity;
}

// Redirect back to the products page
header('Location: medicine_customar.php');
exit();
?>