<?php 
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: ../index.php");
        exit();
    }
?>