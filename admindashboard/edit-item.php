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
                            <!-- Table Element -->
                                <?php 
                                    if (isset($_GET['id'])) 
                                    {   
                                        $id = $_GET['id'];
                                        $item = getByID("items", $id);

                                        if (mysqli_num_rows($item) > 0) 
                                        {
                                            $data = mysqli_fetch_array($item);
                                            ?>
                                                <div class="card border-0">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            Edit Item
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="code.php" method="POST" enctype="multipart/form-data" id="addCategoryForm">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="">Select Category</label>
                                                                    <select name="category_id" class="form-select mb-2">
                                                                        <option selected>Select Category</option>
                                                                        <?php 
                                                                            $categories = getAll("categories");

                                                                            if(mysqli_num_rows($categories) > 0)
                                                                            {
                                                                                foreach ($categories as $category) {
                                                                                    ?>
                                                                                        <option value="<?= $category['id']; ?>" <?= $data['category_id'] == $category['id']?'selected':'' ?> ><?= $category['category'];?></option>   
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            else
                                                                            {
                                                                                echo "No Category Available";
                                                                            }
                                                                            
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="mb-0">Upload Image</label>
                                                                    <input type="hidden" name="old_image" value="<?= $data['images']; ?>">
                                                                    <input type="file" name="images" class="form-control mb-2">
                                                                    <label class="mb-0">Current Images</label>
                                                                    <img src="../uploads/<?= $data['images']; ?>" alt="Product Images" height="50px" width="50px">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="hidden" name="item_id" value="<?= $data['id']; ?>">
                                                                    <label class="mb-0">Item Name</label>
                                                                    <input type="text" name="name" value="<?= $data['name']; ?>" placeholder="Enter Name" class="form-control mb-2">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="mb-0">Description</label>
                                                                    <textarea rows="3" name="description" placeholder="Enter Description" class="form-control mb-2"><?= $data['description']; ?></textarea>
                                                                </div>
                                                                <div class="col-md-12 text-end mt-3">
                                                                    <button type="submit" class="btn btn-outline-primary" name="update_item_btn">Update</button> 
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php 
                                        } 
                                        else
                                        {
                                            echo "Item Not Found";
                                        }
                                    }
                                    else
                                    {
                                        echo "ID Missing from URL";
                                    }
                                ?>
                        </div>
                    </main>
                    <!--footer-->
                    <?php include "includes/footer.php"?>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@12"></script>
            <script src="js/script.js"></script>
    </body>
    </html>
