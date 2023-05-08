<?php
// Read the data from the JSON file
$data = file_get_contents('products2.json');

// Decode the JSON data into an array of objects
$products = json_decode($data, true);

// Get the ID of the product to delete from the form submission
$id = $_POST['id'];

// Loop through the products and find the one with the matching ID
foreach ($products as $key => $product) {
    if ($product['id'] == $id) {
        // Remove the product from the array
        unset($products[$key]);

        // Encode the updated array as JSON
        $json = json_encode($products);

        // Write the JSON data back to the file
        file_put_contents('products2.json', $json);

        // Redirect back to the products page
        header('Location: medicine_admin.php');
        exit;
    }
}

// If we get here, the product wasn't found
echo "Product not found";
?>
