<?php

session_start();
include('../dbcon.php');
include('../functions/myfunctions.php');

if (isset($_POST['add_category_btn'])) {
    $category = $_POST['category'];
    $description = $_POST['description'];

    $images = $_FILES['images']['name'];

    $path = "../uploads/";

    $image_ext = pathinfo($images, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $target_path = $path . $filename;

    $cate_query = "INSERT INTO categories (category, description, images) VALUES ('$category', '$description', '$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['images']['tmp_name'], $target_path);

        header("Location: addcategory.php");
        exit();
    } else {
        header("Location: addcategory.php");
        exit();
    }
}

//for Update Category
else if (isset($_POST['update_category_btn'])) 
{
    $category_id = $_POST['category_id'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $new_image = $_FILES['images']['name']; // Get the new image file name
    $old_image = $_POST['old_image'];

    // If a new image is provided, use it; otherwise, keep the old image
    $update_filename = ($new_image != "") ? $new_image : $old_image;

    // If the new image is not empty, process the upload
    if (!empty($new_image)) 
    {
        $path = "../uploads"; // Define the upload directory
        $update_path = $path . '/' . $update_filename; // Define the full path for the new image
        
        // Move the uploaded file to the defined directory
        if (move_uploaded_file($_FILES['images']['tmp_name'], $update_path)) 
        {
            // If the move operation was successful, unlink the old image file if it exists
            if (file_exists("../uploads/" . $old_image)) 
            {
                unlink("../uploads/" . $old_image);
            }    
        }
        else 
        {
            // If there was an error moving the file, display an error message
            echo "Error uploading the file.";
            exit(); // Exit the script to prevent further execution
        }
    }

    // Prepare the SQL query to update the category information
    $update_query = "UPDATE categories SET category='$category', description='$description', images='$update_filename' WHERE id='$category_id' ";

    // Execute the update query
    $update_query_run = mysqli_query($con, $update_query);

    // Check if the query execution was successful
    if($update_query_run)
    {
        // If successful, redirect to the edit-category page with a success message
        header("Location: edit-category.php?id=$category_id&success=Category%20Updated%20Successfully");
        exit(); // Exit the script to prevent further execution
    }
    else 
    {
        // If there was an error executing the query, display an error message
        echo "Error updating the category.";
        exit(); // Exit the script to prevent further execution
    }
}

//for Delete Category
else if(isset($_POST['delete_category_btn'])) 
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if (file_exists("../uploads/" . $image)) 
            {
                unlink("../uploads/" . $image);
            }  
        header("Location: seecategory.php?", "DIPA OKAY TO");
    }
    else 
    {
        header("Location: seecategory.php?", "Something Went Wrong");
    }
}

//for adding Items
else if(isset($_POST['add_item_btn'])) 
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $images = $_FILES['images']['name'];

    $path = "../uploads/";

    $image_ext = pathinfo($images, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $target_path = $path . $filename;

    $cate_query = "INSERT INTO items (category_id, name, description, images) VALUES ('$category_id', '$name', '$description', '$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['images']['tmp_name'], $target_path);

        header("Location: add-item.php");
        exit();
    } else {
        header("Location: add-item.php");
        exit();
    }
}

//for Delete Items
else if(isset($_POST['delete_items_btn'])) 
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM items WHERE id='$category_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if (file_exists("../uploads/" . $image)) 
            {
                unlink("../uploads/" . $image);
            }  
        header("Location: seecategory.php?", "DIPA OKAY TO");
    }
    else 
    {
        header("Location: seecategory.php?", "Something Went Wrong");
    }
}
?>