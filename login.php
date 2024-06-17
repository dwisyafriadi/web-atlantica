<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login Panel</title>
</head>
<body>
    <div class="container">
        <form action="proses.php" method="POST" class="login-email">
            <h2 class="login-text">Login First</h2>

            <div class="input-group">
                <label for="username">Username</label>
                <input type="username" id="email" name="username" placeholder="username" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="input-group">
                <button type="submit" name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">You dont't have account ? <a href="register.php">Register </a></p>
        </form>
    </div>
</body>
</html>
