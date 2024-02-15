<?php session_start(); 
    include ("../functions/myfunctions.php");
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
                        <?php 
                        if(isset($_GET['id']))
                        {
                            $id = $_GET['id'];
                            $category = getByID("categories", $id);

                            if (mysqli_num_rows($category) > 0) 
                            {
                                $data = mysqli_fetch_array($category);
                                ?>
                                <!-- Table Element -->
                                    <div class="card border-0">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                Edit Category
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="category_id" value="<?= $data['id'] ?>">
                                                        <label for="">Category</label>
                                                        <input type="text" name="category" value="<?= $data['category'] ?>" placeholder="Enter Category Name" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">Upload Images</label>
                                                        <input type="file" name="images"  class="form-control">
                                                        <label for="">Current Image</label>
                                                        <input type="hidden" name="old_image" value="<?= $data['images'] ?>">
                                                        <img src="../uploads/<?= $data['images'] ?>" height="50px" width="50px" alt="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Description</label>
                                                        <textarea rows="3" name="description" placeholder="Enter Description" class="form-control"><?= $data['description'] ?></textarea>
                                                    </div>
                                                    <div class="col-md-12 text-end mt-3">
                                                        <button type="submit" class="btn btn-outline-primary" name="update_category_btn">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php
                            }
                            else 
                            {
                                echo "Category Not Found";
                            }
                        }
                        else
                        {
                            echo "Id Missing Wrong from url";
                        } 
                            ?>
                    </div>
                </main>
                <!--footer-->
                <?php include "includes/footer.php"?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        </script>
        <script src="js/script.js"></script>
    </body>

    </html>
