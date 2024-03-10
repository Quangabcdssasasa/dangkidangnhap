<?php
require_once("../1.Controller/KiemTraLogin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="glass-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="#" method="POST">

                <input type="text" id="username" name="username" required placeholder="Username">

                <input type="password" id="password" name="password" required placeholder="Password">

                <div class="options">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <div style="margin-top: 15px; color:white;">
                    <?php
                    if (!empty($responseMessage)) {
                        echo $responseMessage;
                    }
                    ?>
                </div>

                <button type="submit">Login</button>

                <p>Don't have an account? <a href="./Resgiter.php" id="register">Register</a></p>
            </form>
        </div>
    </div>
</body>

</html>