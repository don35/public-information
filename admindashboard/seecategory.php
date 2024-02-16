<?php include "../functions/myfunctions.php"; ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
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
                                        Add Category
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="code.php" method="POST" enctype="multipart/form-data" id="addCategoryForm">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="">Category</label>
                                                            <input type="text" name="category" placeholder="Enter Category Name" class="form-control mb-2" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="">Upload Images</label>
                                                            <input type="file" name="images" class="form-control mb-2" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="">Description</label>
                                                            <textarea rows="3" name="description" placeholder="Enter Description" class="form-control mb-2" required></textarea>
                                                        </div>
                                                        <div class="col-md-12 text-end mt-3">
                                                            
                                                        </div>
                                                    </div>
                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="add_category_btn" id="addCategoryBtn">ADD</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </form><br><br>
                    <div class="card border-0">
                        <div class="card-header">  
                            <h4 class="card-title">
                                Categories
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Images</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 
                                        $category = getAll("categories");

                                        if(mysqli_num_rows($category) > 0)
                                        {
                                            foreach ($category as $item) 
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?= $item['id']; ?></td>
                                                        <td><?= $item['category']; ?></td>
                                                        <td><?= $item['description']; ?></td>
                                                        <td>
                                                            <img src="../uploads/<?= $item['images']; ?>" width="50px" height="50px" alt="<?= $item['category']; ?>">
                                                        </td>
                                                        <td>
                                                            <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-outline-primary">Edit</a>
                                                        </td>
                                                        <td>
                                                               <button type="button" class="btn btn-outline-danger delete_category_btn" value="<?= $item['id']; ?>">Delete</button>
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
    <script src="js/script.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
<?php 
