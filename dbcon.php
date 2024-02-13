<?php 
$lname = "localhost";
$rname = "root";
$password = "";

$db_name = "actioncenter_db";

$con = mysqli_connect($lname, $rname, $password, $db_name);

if (!$con) {
    echo "Connection Failed!";
}

?>