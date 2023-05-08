<?php 
	session_start();
	if(!isset($_SESSION['user'])){
		header("location: login.php");	exit();
	}

	if(isset($_GET['logout'])){
		unset($_SESSION['user']);
		header("location: login.php");	exit();
	}

	// Set the default filename for the JSON file
	$filename = 'products.json';

	if (isset($_POST['json_file'])) {
		// Set the filename for the JSON file
		$filename = $_POST['json_file'];
	}

	if (isset($_POST['add_product'])) {
		// Handle the "Add Product" form submission
		$description = $_POST['description'];
		$id = $_POST['id'];
		$title = $_POST['title'];
		$price = $_POST['price'];
		$photo = $_FILES['photo']['name'];
		$photo_path = basename($photo);

		// Set the "available" property based on whether the checkbox is checked or not
		$available = isset($_POST['available']) && $_POST['available'] == '1';

		// Upload the photo file
		move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);

		// Read the data from the JSON file
		$data = file_get_contents($filename);

		// Decode the JSON data into an array of objects
		$products = json_decode($data, true);

		if (is_array($products)) { // check if $products is an array
			// Create a new product object and add it to the array
			$new_product = new stdClass();
			$new_product->description = $description;
			$new_product->id = $id;
			$new_product->title = $title;
			$new_product->price = $price;
			$new_product->photo = $photo_path;
			$new_product->available = $available; // set the "available" property based on the checkbox
			$products[] = $new_product;

			// Encode the updated product data as JSON
			$data = json_encode($products, JSON_PRETTY_PRINT);

			// Write the updated product data to the JSON file
			file_put_contents($filename, $data);

			// Redirect the user back to the user account page
			header('Location: Admin.php');
			exit;
		} else {
			// handle error here
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="add.css">
	<title>User account</title>
</head>
<body>
	<header>
		<div class="content">
			<h2>Welcome <?php echo $_SESSION['user']; ?></h2>
		</div>
		<div class="logout">
			<a href="?logout">Log out</a> 
			<a href="admin_view.php">View Products</a> 
		</div>
	</header>
	<div class="main">
		<div class="form">
			<form method="post" action="" enctype="multipart/form-data">
				<div>
					<label for="description">Description:</label>
					<input type="text" name="description" id="description">
				</div>
				<div>
					<label for="id">ID:</label>
					<input type="text" name="id" id="id">
				</div>
				<div>
					<label for="title">Title:</label>
					<input type="text" name="title" id="title">
				</div>
				<div>
					<label for="price">Price:</label>
					<input type="text" name="price" id="price">
				</div>
				<div>
					<label for="photo">Photo:</label>
					<input type="file" name="photo" id="photo">
				</div>
				<div>
					<label for="available">Available:</label>
					<input type="checkbox" name="available" id="available" value="1">
				</div>
				<div class="add">
					<button type="submit" name="add_product">Add Product / Save</button>
				</div>
				<div>
					<label for="json_file">Select Category:</label>
					<select name="json_file" id="json_file">
						<option value="products.json"<?php if ($filename === 'products.json') { echo ' selected'; } ?>>Hair Cair</option>
						<option value="products2.json"<?php if ($filename === 'products2.json') { echo ' selected'; } ?>>Medicines</option>
						<option value="products3.json"<?php if ($filename === 'products3.json') { echo ' selected'; } ?>>Skin Care</option>
					</select>
				</div>
			</form>
		</div>
	</div>

	<main>
		
	</main>
</body>
</html>