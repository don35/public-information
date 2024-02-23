<?php 
session_start();
include "../dbcon.php";
include "../sqlquery.php";

if (!isset($_SESSION['user_name']) || !isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    // Redirect if user is not logged in
    header("Location: ../index.php");
    exit();
}

// Check if user role is admin or superadmin
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'superadmin') {
    // Redirect if user does not have appropriate role
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Batangas State University Action Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <div class="wrapper">
        <!--side bar-->
                <?php include "includes/sidebar.php"?>
        <div class="main">
           <!--navbar-->
                <?php include "includes/navbar.php"?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="container-fluid">
                        <section>
                            <div class="row">
                            <div class="col-xl-6 col-md-12 mb-4">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                        <h2 class="h1 mb-0 me-4"><?php echo $total_accounts; ?></h2>
                                        </div>
                                        <div>
                                        <h4>Total Added Accounts</h4>
                                        <p class="mb-0">Added Accounts</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-user fa-3x" style="color: #c21818; font-size: 5rem;"></i>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
            <!--footer-->
            <?php include "includes/footer.php"?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>


