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
                <?php include "sidebar.php"?>
        <div class="main">
           <!--navbar-->
                <?php include "navbar.php"?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <!-- Table Element -->
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
                                        <th>Action</th>
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
                                                            <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary">Edit</a>
                                                            <form action="code.php" method="POST">
                                                                <input type="hidden" name="category_id" value="<?= $item['id']; ?>">
                                                               <button type="submit" class="btn btn-danger" name="delete_category_btn">Delete</button>
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
            <?php include "footer.php"?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
<?php 
