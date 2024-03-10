<?php
require_once("../1.Controller/KiemTraRegister.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="glass-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="./Resgiter.php" method="POST">

                <input type="text" id="sername" name="Username" required placeholder="Username">

                <input type="password" id="password" name="Password" required placeholder="Password">

                <input type="password" id="password" name="ConfirmPassword" required placeholder="Password">

                <input type="text" id="email" name="Email" required placeholder="Email">

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

                <p>Do you have an account? <a href="./Login.php" id="register">Login</a></p>
            </form>
        </div>
    </div>
</body>

</html>