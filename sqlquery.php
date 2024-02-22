<?php 
$sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";
$result_categories = mysqli_query($con, $sql_categories);
$row_categories = mysqli_fetch_assoc($result_categories);
$total_categories = $row_categories['total_categories'];

$sql_items = "SELECT COUNT(*) AS total_items FROM items";
$result_items = mysqli_query($con, $sql_items);
$row_items = mysqli_fetch_assoc($result_items);
$total_items = $row_items['total_items'];

$sql = "SELECT COUNT(*) AS total_accounts FROM users";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$total_accounts = $row['total_accounts'];

?>