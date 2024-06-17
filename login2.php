<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Account Register</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font: 20px Montserrat, sans-serif;
            line-height: 1.8;
            color: #f5f6f7;
        }

        .video-bg {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .container {
            position: relative;
            z-index: 1;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5); /* optional, for better readability */
            border-radius: 10px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <video autoplay loop playsinline class="video-bg">
        <source src="assets/video/intro.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <form id="registerForm" action="action.php" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" id="password" value="" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" id="cpassword" value="" required>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Already have account ? <a href="login.php">Login</a></p>
            <p id="errorMessage" class="error" style="display:none;">Passwords do not match!</p>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var cpassword = document.getElementById('cpassword').value;
            var errorMessage = document.getElementById('errorMessage');

            if (password !== cpassword) {
                errorMessage.style.display = 'block';
                event.preventDefault();
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
</body>
</html>
