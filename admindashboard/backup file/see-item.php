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

                    <!-- Table Element -->
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
                                                        <td><?= $item['description']; ?></td>
                                                        <td>
                                                            <img src="../uploads/<?= $item['images']; ?>" width="50px" height="50px" alt="<?= $item['name']; ?>">
                                                        </td>
                                                        <td>
                                                            <a href="edit-item.php?id=<?= $item['id']; ?>" class="btn btn-outline-primary">Edit</a>                                       
                                                        </td>
                                                        <td>
                                                        <form action="code.php" method="POST">
                                                                <input type="hidden" name="items_id" value="<?= $item['id']; ?>">
                                                               <button type="submit" class="btn btn-outline-danger" name="delete_items_btn">Delete</button>
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
