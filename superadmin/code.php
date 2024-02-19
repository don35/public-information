<?php
session_start();

include('../dbcon.php');
include('../functions/myfunctions.php');

if (isset($_POST['add_accounts_btn'])) {
    // Retrieve form data
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Assuming you have a field for password
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password, name, email, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Error handling if SQL statement preparation fails
        header("Location: addaccounts.php?error=SQL Error");
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sssss", $username, $hashed_password, $name, $email, $role);
        
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        
        // Redirect back to the add accounts page with success message
        header("Location: addaccounts.php?success=Account added successfully");
        exit();
    }
} else {
    // If the form submission was not triggered by clicking the add item button, redirect to the add accounts page
    header("Location: addaccounts.php");
    exit();
}

if(isset($_POST['delete_account_btn']) && isset($_POST['account_id'])) {
    $account_id = $_POST['account_id'];

    // Perform the deletion query
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $account_id);

    if ($stmt->execute()) {
        // Deletion successful
        echo json_encode(array("status" => 200)); // Return success status code
    } else {
        // Deletion failed
        echo json_encode(array("status" => 500)); // Return error status code
    }

    $stmt->close();
    exit(); // Stop further execution
}

?>





