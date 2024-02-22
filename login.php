<?php 
session_start();

include "dbcon.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: index.php?error=Username and Password are required");
        exit();
    } else {
        // Prepare the SQL statement
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($con);

        // Check if the statement could be prepared
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?error=SQL Error");
            exit();
        } else {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "s", $uname);
            // Execute the prepared statement
            mysqli_stmt_execute($stmt);
            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            // Check if there's a row with the given username
            if ($row = mysqli_fetch_assoc($result)) {
                // Verify password using password_verify function
                if (password_verify($pass, $row['password'])) {
                    $_SESSION['user_name'] = $row['username'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];

                    // Check user role and redirect accordingly
                    if ($row['role'] == 'admin') {
                        header("Location: admindashboard/dashboard.php");
                        exit();
                    } elseif ($row['role'] == 'superadmin') {
                        header("Location: superadmin/dashboard.php");
                        exit();
                    } else {
                        // Handle other roles or unexpected scenarios
                        header("Location: index.php?error=Invalid Role");
                        exit();
                    }
                } else {
                    // Incorrect password
                    header("Location: index.php?error=Incorrect Password");
                    exit();
                }
            } else {
                // Username not found
                header("Location: index.php?error=Username not found");
                exit();
            }
        }
    }
} else {
    header("Location: index.php?error=Please enter Username and Password");
    exit();
}
?>
