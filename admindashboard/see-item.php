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
                                        Add Item
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="mb-0">Select Category</label>
                                                        <select name="category_id" class="form-select mb-2">
                                                            <option selected>Select Category</option>
                                                            <?php 
                                                                $categories = getAll("categories");

                                                                if(mysqli_num_rows($categories) > 0)
                                                                {
                                                                    foreach ($categories as $item) {
                                                                        ?>
                                                                            <option value="<?= $item['id']; ?>"><?= $item['category'];?></option>   
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
                                                        <input type="file" name="images" class="form-control mb-2" required >
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="mb-0">Item Name</label>
                                                        <input type="text" name="name" placeholder="Enter Name" class="form-control mb-2" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="mb-0">Description</label>
                                                        <textarea rows="3" name="description" placeholder="Enter Description" class="form-control mb-2" required></textarea>
                                                    </div>
                                                </div>
                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="add_item_btn" id="addCategoryBtn">ADD</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </form><br><br>
                    <div class="card border-0">
                        <div class="card-header">  
                            <h4 class="card-title">
                                Items
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Date Created</th>
                                        <th>Description</th>
                                        <th>Images</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 
                                        $items = getAll("items");

                                        if(mysqli_num_rows($items) > 0)
                                        {
                                            foreach ($items as $item)  
                                            {
                                                ?>
                                                    <tr>
                                                        <td><?= $item['id']; ?></td>
                                                        <td><?= $item['name']; ?></td>
                                                        <td><?= $item['created_at']; ?></td>
                                                        <td><?= $item['description']; ?></td>
                                                        <td>
                                                            <img src="../uploads/<?= $item['images']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                        </td>
                                                        <td>
                                                            <a href="edit-item.php?id=<?= $item['id']; ?>" class="btn btn-outline-primary">Edit</a>
                                                        </td>
                                                        <td>
                                                        <form action="code.php" method="POST">
                                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                               <button type="submit" class="btn btn-outline-danger" name="delete_category_btn">Delete</button>
                                                            </form>
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
    <script src="js/script.js"></script>
    
</body>
</html>
<?php 
