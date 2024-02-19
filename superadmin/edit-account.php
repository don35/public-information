<?php
session_start(); 
include("../functions/myfunctions.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $account = getByID("users", $id);

    if (mysqli_num_rows($account) > 0) {
        $row = mysqli_fetch_assoc($account);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batangas State University Action Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
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
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">Edit Accounts</h5>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data" id="editAccountForm">
                                <input type="hidden" name="account_id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="role">Role:</label>
                                        <select name="role" id="role">
                                            <option value="admin" <?= ($row['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                            <option value="superadmin" <?= ($row['role'] == 'superadmin') ? 'selected' : '' ?>>Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="username">Username:</label>
                                        <input type="text" name="username" id="username" value="<?= $row['username'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" value="<?= $row['name'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" value="<?= $row['email'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password">
                                    </div>
                                </div>
                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-outline-primary" name="update_account_btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <!--footer-->
            <?php include "includes/footer.php"?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@12"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php 
    } else {
        echo "Account Not Found";
    }
} else {
    echo "ID Missing from URL";
}
?>
