<?php 
session_start();
include "../functions/myfunctions.php"; 
include "../dbcon.php";

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
    <title>Batangas State University Action Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Accounts
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Accounts</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="code.php" method="POST" enctype="multipart/form-data" id="addCategoryForm">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="mb-0">Select Role</label>
                                                            <select id="role" name="role" class="form-select mb-2">
                                                                <option selected>Select Role</option>
                                                                <option value="admin">Admin</option>
                                                                <option value="superadmin">Super Admin</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Upload Images</label>
                                                            <input type="file" id="images" name="images" class="form-control mb-2" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="mb-0">User Name</label>
                                                            <input type="text" id="username" name="username" class="form-control mb-2" placeholder="Enter Username" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="mb-0">Password</label>
                                                            <input type="password" id="password" name="password" placeholder="Enter Name" class="form-control mb-2" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="mb-0">Name</label>
                                                            <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control mb-2" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="mb-0">Email</label>
                                                            <input type="email" id="email" name="email" placeholder="Enter Name" class="form-control mb-2" required>
                                                        </div>
                                                    </div>
                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" id="submit" class="btn btn-primary" name="add_account_btn">ADD</button>
                                                        <!--<button type="submit" class="btn btn-outline-primary add_category_btn">ADD</button>-->
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </form><br><br>
                    <div class="card border-0">
                        <div class="card-header">  
                            <h4 class="card-title">
                                Accounts
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Password</th>
                                        <th>Account Picture</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 
                                        $accounts = getLahat("users");

                                        if(mysqli_num_rows($accounts) > 0)
                                        {
                                            foreach ($accounts as $item) 
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?= $item['id']; ?></td>
                                                        <td><?= $item['username']; ?></td>
                                                        
                                                        <td><?= $item['name']; ?></td>
                                                        <td><?= $item['email']; ?></td>
                                                        <td><?= $item['role']; ?></td>
                                                        <td><?= $item['password']; ?></td>
                                                        <td>
                                                            <img src="../uploads/<?= $item['images']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>" style="display: block; margin: 0 auto;">
                                                        </td>
                                                        <td>
                                                        <a href="edit-account.php?id=<?= $item['id']; ?>" class="btn btn-outline-primary">Edit</a>
                                                        </td>
                                                        <td>
                                                               <button type="button" class="btn btn-outline-danger delete_account_btn" value="<?= $item['id']; ?>">Delete</button>
                                                        </td>
                                                    </tr>    
                                                <?php
                                            }
                                        }
                                        else {
                                        echo "No Records Found";
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <!--footer-->
            <?php include "includes/footer.php"?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/custom.js"></script>
    
    
</body>
</html>
<?php 
