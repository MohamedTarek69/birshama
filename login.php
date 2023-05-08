<?php require("login.class.php") ?>
<?php
if (isset($_POST['submit'])) {
    $user = new LoginUser($_POST['username'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <a href="welcome.html" class="logo">Home</a>

        </nav>
    </header>

    <div class="main">

        <section class="form"><br>
            <h2>login </h2><br>
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="text">
                    <input type="text" placeholder="Enter User Name" name="username" required><br>
                    <input type="password" placeholder="Enter password" name="password" required><br>
                    <button type="submit" class="btn" href="#" name="submit" required>login</button>
                </div>
                <div class="x">
                    <input type="checkbox" name="terms" id="agree " value="male">
                    <label for="agree">agree our terms</label>
                </div>
                <p class="error"><?php echo @$user->error ?></p>
                <p class="success"><?php echo @$user->success ?></p>
            </form>
        </section>
    </div>


</body>

</html>