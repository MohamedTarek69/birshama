<?php
// Start the session
session_start();

// Read the product data from the three JSON files
$data1 = file_get_contents('products.json');
$data2 = file_get_contents('products2.json');
$data3 = file_get_contents('products3.json');
$products1 = json_decode($data1, true);
$products2 = json_decode($data2, true);
$products3 = json_decode($data3, true);

// Merge the products from all three files into a single array
$products = array_merge($products1, $products2, $products3);

// Initialize the total price to 0
$total_price = 0;

// If the cart is not empty, calculate the total price and store the cart items
if (!empty($_SESSION['cart'])) {
    $cart_items = array();
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        // Find the product with the matching ID
        $product = null;
        foreach ($products as $p) {
            if ($p['id'] == $product_id) {
                $product = $p;
                break;
            }
        }

        // If the product was found, add it to the cart items array
        if ($product) {
            $item_price = $product['price'] * $quantity;
            $total_price += $item_price;
            $cart_items[] = array(
                'id' => $product_id,
                'quantity' => $quantity,
                'total_item_price' => $item_price
            );
        }
    }
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Create an array to store the order data
$order_data = array(
    'total_price' => $total_price,
    'user_id' => $user_id,
    'cart_items' => $cart_items
);

// Read the existing orders from the "orders.json" file
$orders_json = file_get_contents('orders.json');
$orders = json_decode('[' . rtrim($orders_json, "\n") . ']', true);

// Add the new order data to the end of the array
$orders[] = $order_data;

// Encode the entire array as JSON with square brackets
$orders_json = json_encode($orders);

// Write the entire array back to the "orders.json" file
if (file_put_contents('orders.json', $orders_json)) {
    // If the order was saved successfully, set a success message
    $_SESSION['order_message'] = "Order placed successfully.";
} else {
    // If the order failed to save, set an error message
    $_SESSION['order_message'] = "Failed to place order.";
}

// Delete the cart items from the session
unset($_SESSION['cart']);

// Redirect the user to the home page
header('Location: cart.php');
exit;
?>