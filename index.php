<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Center Login</title>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="wave" src="img/wave1.png">
        <div class="container">
            <div class="img">
                <img src="img/login.svg">
            </div>
            <div class="login-content">
                <form action="login.php" method="post">
                    <img src="img/avatar.svg">
                    <h2 class="title">Welcome</h2>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php }?>
                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php }?>
                    <br>
                    <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                            <h5>Username</h5>
                            <input type="text" name="uname" class="input" required>
                    </div>
                    </div>
                    <div class="input-div pass">
                    <div class="i"> 
                            <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                            <h5>Password</h5>
                            <input type="password" name="password" class="input" required id="passwordField">
                    </div>
                    </div>
                    <a href="#">Forgot Password?</a>    
                    <input type="submit" class="btn" value="Login">
                    <a href="signup.php">
                        <button class="btn" type="button">Sign Up</button>
                    </a>
            </div>
        </div>
        <script type="text/javascript" src="main.js"></script>
        <script>
    // Disable pasting into the password field
            document.getElementById('passwordField').addEventListener('paste', function(event) {
                event.preventDefault();
                
                });
        </script>
</body>
</html>



