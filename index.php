<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Batangas State University Action Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

    
</head>
<body>
    <div class="row vh-100 g-0">
        <div class="col-lg-6 position-relative d-none d-lg-block">
            <div class="bg-holder" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6)), url(img/background.jpg)">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row align-items-center justify-content-center h-100 g-0 px-4 px-sm-0">
                <div class="col col-sm-6 col-lg-7 col-xl-6">

                <div class="row justify-content-center align-items-center mb-5">
                    <div class="col-md-auto mb-3 mb-md-0 text-center">
                        <a href="#" class="d-flex justify-content-center">
                            <img src="img/logo.png" alt="logo" width="110">
                        </a>
                    </div>
                    <div class="col-md-auto text-center">
                        <a href="#" class="d-flex justify-content-center">
                            <img src="img/logo1.png" alt="logo" width="100">
                        </a>
                    </div>
                </div>

                <div class="text-center mb-5">
                    <h3 class="fw-bold"><span style="color: #C21818;">ACTION </span>Center</h3>
                    <p>Get Access to your Account</p>
                </div>

                <div class="alert alert-danger <?php if (!isset($_GET['error']) && !isset($_GET['success'])) { echo 'd-none'; } ?>" role="alert">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php }?>
                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php }?>
                </div>

                <form action="login.php" method="POST">
                    <div class="input-group nb-3">
                        <span class="input-group-text">
                            <i class='bx bx-user'></i>
                        </span>
                        <input type="text" class="form-control form-control-lg 
                        fs-6" name="uname" class="input" placeholder="Username">
                    </div>
                    <div class="input-group nb-3" style="margin-top: 15px;">
                        <span class="input-group-text">
                            <i class='bx bx-lock-alt'></i>
                        </span>
                        <input type="password" class="form-control form-control-lg 
                        fs-6" name="password" class="input" placeholder="Password">
                    </div>
                    <div class="input-group nb-3" style="margin-top: 15px;">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="formCheck">
                            <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                        </div>
                    </div>
                        <input type="submit" class="btn btn-primary btn-lg w-100 mb-3" style="margin-top: 15px;" value="Login">
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</body>
</html>
