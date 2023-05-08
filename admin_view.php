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
    <title>Admin View</title>
    <link rel="stylesheet" href="page2.css">
</head>

<body>
    <header>
        <nav>
            <div>
                <p class="lo">Birshama</p>
            </div>
            <div class="content">
                <h2>Welcome <?php echo $_SESSION['user']; ?></h2>
            </div>
            <div>
                <a href="?logout" class="logo">Log out</a>
                <a href="Admin.php" class="logo">Back</a>
            </div>
        </nav>
    </header>
    <div class="title">
        <h1>our products</h1>
    </div>
    <section class="header">
        <div class="photo1" title="go to skincare page">
            <a href="skin_admin.php" title="go to skincare page">
                <img class="img1" src="photo_5922289074440359152_x.jpg">
                <p>
                    <h2>skin care</h2>
                </p>
            </a>
        </div>
        <div class="photo1" title="go to medicine page">
            <a href="medicine_admin.php">
                <img class="img2" src="photo_5924847431839760551_y.jpg" title="go to medicine page">
                <p>
                    <h2>medicine</h2>
                </p>
            </a>
        </div>
        <div class="photo1" title="go to hair care page">
            <a href="hair_admin.php">
                <img class="img3" src="photo_5922289074440359235_y.jpg" title="go to hair care page">
                <p>
                    <h2>hair care</h2>
                </p>
            </a>
        </div>
    </section>
</body>

</html>