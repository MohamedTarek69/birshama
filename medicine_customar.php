<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine</title>
    <link rel="stylesheet" href="hair2.css">
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="logo_ph"><h1>Birshama</h1></div> 
            <nav>
                <div class="back">
                    <a href="customar_view.php" class="logo">Back</a>
                    <a href="cart.php" class="logo">Cart</a>
                </div>
            </nav>
        </div>
        
        <?php 
            // Read the data from the JSON file 
            $data = file_get_contents('products2.json'); 

            // Decode the JSON data into an array of objects 
            $products = json_decode($data); 

            // Output the products as a table 
            echo '<table>'; 
            echo '<thead>'; 
            echo '<tr>'; 
            echo '<th>Title</th>'; 
            echo '<th>ID</th>'; 
            echo '<th>Photo</th>'; 
            echo '<th>Description</th>'; 
            echo '<th>Price</th>';  
            echo '<th>Add to Cart</th>'; 
            echo '</tr>'; 
            echo '</thead>'; 

            echo '<tbody>'; 
            // Loop through the products and output them as rows in the table 
            foreach ($products as $product) { 
                echo '<tr>'; 
                echo '<td>' . $product->title . '</td>'; 
                echo '<td>' . $product->id . '</td>'; 
                echo '<td><img src="' . $product->photo . '" alt="' . $product->title . '"></td>'; 
                echo '<td>' . $product->description . '</td>'; 
                echo '<td>' . $product->price . '</td>'; 
                echo '<td>'; 
                // Add add-to-cart form with product ID and quantity 
                echo '<form method="post" action="add_to_cart_medicine.php">'; 
                echo '<label for="quantity">Quantity:</label>'; 
                echo '<input type="number" name="quantity" id="quantity" min="1" value="1">'; 
                echo '<input type="hidden" name="product_id" value="' . $product->id . '">'; 
                echo '<button type="submit" name="add_to_cart">Add to Cart</button>'; 
                echo '</form>'; 
                echo '</td>'; 
                echo '</tr>'; 
            } 

            echo '</tbody>'; 
            echo '</table>'; 
        ?>
    </div>
</body>
</html>