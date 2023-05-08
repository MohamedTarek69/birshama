<?php require("contactusscript.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>contact form</title>
</head>
<body>
    <div class="page">
            <div class="header" style="grid-column: 1 / 5; grid-row: 1/2;">
                <div class="logo_ph"><h1>Birshama</h1></div> 
                <nav>
            <div class="back">
                    <a href="welcome.html" class="logo">Back</a>
            </div>
                </nav>
    </div>
    <form method="post">
        <h2>Contact form :</h2>
        <div class="name-1">
        <label for="m-Name">Name :</label><br>
        <input type="text" id="m-Name" placeholder="Enter your Name" required name="name">
        </div>
        <br>
        <div class="email-1">
        <label for="m-email">E-mail address :</label><br>
        <input type="email" id="m-email" placeholder="E-mail" required name="email">
        </div>
        <br>
        <div class="message-1">
            <label for="m-message">message :</label><br>
            <textarea id="m-message" class="message-2" placeholder="Leave a message" required name="subject"></textarea>
        </div>
        <br>
        <div class="btn">
        <input type="submit" value="Submit" name="submit">
        </div>
        
        <br>
        <?php if(isset($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</body>
</html>