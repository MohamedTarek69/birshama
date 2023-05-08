<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: welcome.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="page2.css">
</head>
<body>
    <div class="page">
        <header style="grid-column: 1 / 5; grid-row: 1 / 2;">
            <nav>
                <div>
                    <p class="lo">Birshama</p>
                </div>
                <div class="content">
                    <h2>Welcome <?php echo $_SESSION['user']; ?></h2>
                </div>
                <div>
                    <a href="?logout" class="logo">Log out</a>
                    <a href="cart.php" class="logo">Cart</a>
                </div>
            </nav>
        </header>
        <div class="title">
            <h1>our products</h1>
        </div>
        <section class="header">
            <div class="photo1" title="go to skincare page">
                <a href="skin_customar.php" title="go to skincare page">
                    <img class="img1" src="photo_5922289074440359152_x.jpg">
                    <p>
                        <h2>skin care</h2>
                    </p>
                </a>
            </div>
            <div class="photo1" title="go to medicine page">
                <a href="medicine_customar.php">
                    <img class="img2" src="photo_5924847431839760551_y.jpg" title="go to medicine page">
                    <p>
                        <h2>medicine</h2>
                    </p>
                </a>
            </div>
            <div class="photo1" title="go to hair care page">
                <a href="hair_customar.php">
                    <img class="img3" src="photo_5922289074440359235_y.jpg" title="go to hair care page">
                    <p>
                        <h2>hair care</h2>
                    </p>
                </a>
            </div>
        </section>
        <div class="search">
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="query" placeholder="Search..." style="    border-radius: 5px;
    border: 1px solid;
    width: 255px;
    height: 22px;">
                <button type="submit" style="    border-radius: 3px;
    border: 1px solid;
    padding: 4px;">Search</button>
            </form>
            <?php
                if (isset($_GET['query'])) {
                    echo '<div id="searchResults">';
                    // Read the JSON files
                    $file1 = file_get_contents('products.json');
                    $file2 = file_get_contents('products2.json');
                    $file3 = file_get_contents('products3.json');
                    $data = array_merge(json_decode($file1, true), json_decode($file2, true), json_decode($file3, true));

                    // Get the search query
                    $query = $_GET['query'];

                    // Search for the query in the data array
                    $results = array_filter($data, function($item) use ($query) {
                        return strpos(strtolower($item['title']), strtolower($query)) !== false;
                    });

                    // Display the search results
                    if (count($results) > 0) {
                        foreach ($results as $result) {
                            echo '<div>' . $result['title'] . ': ' . $result['description'] . '</div>';
                            if ($result['available']) {
                                echo '<div>Available</div>';
                            } else {
                                echo '<div>Not available</div>';
                            }
                        }
                    } else {
                        echo '<div>No results found</div>';
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>