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
        <div class="header" style="grid-column: 1 / 5; grid-row: 1/2;">
            <div class="logo_ph"><h1>Birshama</h1></div> 
            <nav>
                <div class="back">
                    <a href="admin_view.php" class="logo">Back</a>
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
            echo '<th>Action</th>'; 
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
                // Add delete button with product ID as parameter 
                echo '<form method="post" action="delete_products2.php">'; 
                echo '<input type="hidden" name="id" value="' . $product->id . '">'; 
                echo '<input type="submit" value="Delete">'; 
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