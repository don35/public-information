<?php

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

        header("Location: seecategory.php");
        exit();
    } else {
        header("Location: seecategory.php");
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
        header("Location: seecategory.php?id=$category_id&success=Category%20Updated%20Successfully");
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
    $image = $category_data['images'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if (file_exists("../uploads/" . $image)) 
            {
                unlink("../uploads/" . $image);
            }  
        //header("Location: seecategory.php?", "");
        echo 200;
    }
    else 
    {
        //header("Location: seecategory.php?", "");
        echo 500;
    }
}

//for adding Items
else if(isset($_POST['add_item_btn'])) 
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $images = $_FILES['images']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($images, PATHINFO_EXTENSION);
    $filename = time().'.'. $image_ext;

    if ($name != "" && $description != "") 
    {
        
    

        $item_query = "INSERT INTO items (category_id,name,description,images) 
        VALUES ('$category_id', '$name', '$description', '$filename')";

        $item_query_run = mysqli_query($con, $item_query);

        if($item_query_run)
        {
            move_uploaded_file($_FILES ['images']['tmp_name'], $path.'/'.$filename);
            header("Location: see-item.php"/*Product Added Successfully*/);
            //echo 200;
        }
        else
        {
            header("Location: see-item.php" /*Something Went Wrong*/);
           //echo 500;
        }
    }
}

//for Delete Items
else if(isset($_POST['delete_item_btn'])) 
{
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);

    $item_query = "SELECT * FROM items WHERE id='$item_id' ";
    $item_query_run = mysqli_query($con, $item_query);
    $item_data = mysqli_fetch_array($item_query_run);
    $image = $item_data['images'];

    $delete_query = "DELETE FROM items WHERE id='$item_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if (file_exists("../uploads/" . $image)) 
            {
                unlink("../uploads/" . $image);
            }  
       //header("Location: seeitem.php?", "");
       echo 200;
    }
    else 
    {
        //header("Location: seeitem.php?", "");
        echo 500;
    }

}

//for Update Item
else if (isset($_POST['update_item_btn'])) 
{
    $item_id = $_POST['item_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $image = $_FILES['images']['name'];

    $path = "../uploads";

    $new_image = $_FILES['images']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
    
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $update_filename = time().'.'. $image_ext;
}
    else
    {
    $update_filename = $old_image;
    }

    $update_item_query = "UPDATE items SET name='$name', description='$description', images='$update_filename' WHERE id='$item_id' ";
    $update_item_query_run = mysqli_query($con, $update_item_query);

    if($update_item_query_run)
    {
       if($_FILES['images']['name'] != "")
       {
        move_uploaded_file($_FILES['images']['tmp_name'], $path.'/'.$update_filename);
        if(file_exists("../uploads/".$old_image))
        {
            unlink("../uploads/".$old_image);
        }
    }
    
    header("Location: edit-item.php?id=$item_id");
}
else{
    header("Location: edit-item.php?id=$category_id");
} 
}
?>