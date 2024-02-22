<?php
session_start();

include('../dbcon.php');
include('../functions/myfunctions.php');

if (isset($_POST['add_account_btn'])) {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $images = $_FILES['images']['name'];    

    $path = "../uploads/";

    $image_ext = pathinfo($images, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $target_path = $path . $filename;

    $cate_query = "INSERT INTO users (role, username, password, name, email, images) VALUES ('$role', '$username', '$hashed_password', '$name', '$email', '$filename' )";

    $cate_query_run = mysqli_query($con, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['images']['tmp_name'], $target_path);

        header("Location: addaccounts.php");
       
    } else {
        
        header("Location: addaccounts.php");
        
    }

}

//for Delete Account
else if(isset($_POST['delete_account_btn'])) 
{
    $account_id = mysqli_real_escape_string($con, $_POST['account_id']);

    $account_query = "SELECT * FROM users WHERE id='$account_id' ";
    $account_query_run = mysqli_query($con, $account_query);
    $account_data = mysqli_fetch_array($account_query_run);
    $image = $account_data['images'];

    $delete_query = "DELETE FROM users WHERE id='$account_id' ";
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

//for Update Account
else if (isset($_POST['update_account_btn'])) 
{
    $account_id = $_POST['account_id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Hash the new password if it is provided
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

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
    $update_query = "UPDATE users SET username='$username', password='$password', name='$name', email='$email', role='$role', images='$update_filename' WHERE id='$account_id' ";

    // Execute the update query
    $update_query_run = mysqli_query($con, $update_query);

    // Check if the query execution was successful
    if($update_query_run)
    {
        // If successful, redirect to the edit-category page with a success message
        header("Location: addaccounts.php?id=$account_id&success=Category%20Updated%20Successfully");
        exit(); // Exit the script to prevent further execution
    }
    else 
    {
        // If there was an error executing the query, display an error message
        echo "Error updating the category.";
        exit(); // Exit the script to prevent further execution
    }
} 



?>





