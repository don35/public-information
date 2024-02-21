<?php include "../functions/myfunctions.php"; ?>
<?php include "../dbcon.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batangas State University Action Center</title>
    <link rel="stylesheet" type="text/css" href="path/to/sweetalert.css">
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
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mb-0">Select Role</label>
                                                        <select name="role" class="form-select mb-2">
                                                            <option selected>Select Role</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="superadmin">Super Admin</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mb-0">User Name</label>
                                                        <input type="text" name="name" class="form-control mb-2" required >
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="mb-0">Password</label>
                                                        <input type="password" name="password" placeholder="Enter Name" class="form-control mb-2" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="mb-0">Name</label>
                                                        <input type="text" name="username" placeholder="Enter Name" class="form-control mb-2" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="mb-0">Email</label>
                                                        <input type="email" name="email" placeholder="Enter Email" class="form-control mb-2" required>
                                                    </div>
                                                </div>
                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary " name="add_accounts_btn" id="addCategoryBtn">ADD</button>
                                            
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
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Password</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                        <?php 
                                        $sql = "SELECT * FROM users";
                                        $result = mysqli_query($con, $sql);

                                        // Check if there are any accounts
                                        if (mysqli_num_rows($result) > 0) {
                                            // Loop through each account and display it in a table row
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['username'] . "</td>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                echo "<td>" . $row['role'] . "</td>";
                                                echo "<td>" . $row['password'] . "</td>";
                                               
                                                ?>
                                                    <td>
                                                        <a href="edit-account.php?id=<?= $row['id']; ?>" class="btn btn-outline-primary">Edit</a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-danger delete_acc_btn" value="<?= $row['id']; ?>">Delete</button>
                                                    </td>
                                                <?php
                                            }
                                        } else {
                                            // If no accounts are found, display a message
                                            echo "<tr><td colspan='8'>No accounts found</td></tr>";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/script.js"></script>  
</body>
</html>
<?php 
