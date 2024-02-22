<?php 
session_start();

include "dbcon.php";

// Check if the user is logged in
if(!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php?error=You are not Able to Access the Page");
    exit();
}

// Check if the user's role is authorized to access this page
$allowed_roles = ['admin', 'superadmin'];
if(!in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: dashboard.php");
    exit();
}
?>
