<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";
$username = $_POST["username"];
$sql = "DELETE FROM user WHERE username= '{$username}'";
$result_num = 1;
$result = mysqli_query($conn, $sql) or die($result_num = 0);
header("location: ../../user/users_manage_result.php?result={$result_num}");
