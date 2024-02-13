<?php 
session_start();

include "dbcon.php";
include "../authorization.php";
if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $pass = md5($pass);

    if (empty($uname)) {
        header("Location: index.php?error=Username is Required");
        exit();
    } else if(empty($pass)){
        header("Location: index.php?error=Password is Required");
        exit();
    } else {
        // Prepare the SQL statement
        $sql = "SELECT * FROM users WHERE user_name=? AND password=?";
        $stmt = mysqli_stmt_init($con);

        // Check if the statement could be prepared
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=SQL Error");
            exit();
        } else {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
            // Execute the prepared statement
            mysqli_stmt_execute($stmt);
            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            // Check if there's a row with the given credentials
            if ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: admindashboard/dashboard.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect Username or Password");
                exit();
            }
        }
    }
} else {
    header("Location: index.php?");
    exit();
}
?>
