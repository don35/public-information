<?php
include "dbcon.php";
session_start();

if (isset($_POST['email']) && isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = validate($_POST['email']);
    $uname = validate($_POST['uname']);
    $password = validate($_POST['password']);

    // If user_name already exist
    $stmt = $con->prepare(" SELECT * FROM users WHERE user_name = ? ");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
        header("Location: signup.php?error=Username already exist.");
        exit();
    } else {
        $password = md5($password);
        $stmt = $con->prepare("INSERT INTO users (email, user_name, password) 
            VALUES (?, ?, ?) ");
        $stmt->bind_param('sss', $email, $uname, $password);
        $stmt->execute();

        header("Location: index.php?success=Account Created Successfully");
        exit();
    }
} else {
    header("Location: signup.php?unknown");
    exit();
}
