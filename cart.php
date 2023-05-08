<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart3.css">
</head>
<body>
    <section id="bloghome" class="mt5">
        <h2 class="shopping cart">Shopping Cart</h2>
        <nav >
        <div class="logo" >
        <a href="customar_view.php" class="logo" >Back</a></div>
        </nav>
        <hr>
    </section>
    
    <section id="cart-container" class="container">
        <table width="100%">
            <thead>
                <tr class="dddd">
                    <td>Remove</td>
                    <td>Image</td>
                    <td>ID</td>
                    <td>Medicine Name</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>

            <tbody>
            <?php
            // Start the session
            session_start();

            // Initialize the total price to 0
            $total_price = 0;

            // If the cart is not empty, display the cart items
            if (!empty($_SESSION['cart'])) {
                // Read the product data from the three JSON files
                $data1 = file_get_contents('products.json');
                $data2 = file_get_contents('products2.json');
                $data3 = file_get_contents('products3.json');
                $products1 = json_decode($data1, true);
                $products2 = json_decode($data2, true);
                $products3 = json_decode($data3, true);

                // Merge the products from all three files into a single array
                $products = array_merge($products1, $products2, $products3);

                // Loop through the cart items and display them in the table
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    // Find the product with the matching ID
                    $product = null;
                    foreach ($products as $p) {
                        if ($p['id'] == $product_id) {
                            $product = $p;
                            break;
                        }
                    }

                    // If the product was found, display the cart item
                    if ($product) {
                        // Calculate the total price for the item
                        $item_price = $product['price'] * $quantity;
                        $total_price += $item_price;

                        echo '<tr>';
                        echo '<td><a class="remove" href="remove_cart_item.php?product_id=' . $product['id'] . '">Remove</a></td>';
                        echo '<td><img class="medicinename" src="' . $product['photo'] . '" alt="' . $product['title'] . '"></td>';
                        echo '<td><h5>' . $product['id'] . '</h5></td>';
                        echo '<td><h5>' . $product['title'] . '</h5></td>';
                        echo '<td><h5>' . $product['price'] . ' L.E</h5></td>';
                        echo '<td>';
                        // Add a form to update the quantity of the item in the cart
                        echo '<form method="post" action="update_cart.php">';
                        echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                        echo '<input type="number" name="quantity" value="' . $quantity . '">';
                        echo '<button type="submit">Update</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '<td><h5>' . $item_price . ' L.E</h5></td>';
                        echo '</tr>';
                    }
                }
            } else {
                // If the cart is empty, display a message
                echo '<tr><td colspan="7">Your cart is empty.</td></tr>';
            }
            ?>

            </tbody>
        </table>
    </section>
    <?php
        // If an order message is set, display it
        if (isset($_SESSION['order_message'])) {
            echo '<p>' . $_SESSION['order_message'] . '</p>';
            unset($_SESSION['order_message']);
        }
    ?>
    <section>
        <div class="box"></div>
        <div class="cart-total">
            <div>
                <h5>CART TOTAL</h5>
            </div>
            <div class="cart-total">
                <h6>Total</h6>
                <p><?php echo $total_price; ?> L.E</p>
            </div>
            <div>
                <h6>User Id</h6>
                <p><?php echo $_SESSION['user_id']; ?></p>
            </div>
            <div>
                <a class="checkout" href="checkout.php">Checkout</a>
            </div>
        </div>
    </section>
</body>
</html>