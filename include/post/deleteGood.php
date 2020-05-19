<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";
$good_id = $_GET["id"];
$sql = "DELETE FROM goods WHERE id = {$good_id}";
$result_num = 1;
$result = mysqli_query($conn, $sql) or die($result_num = 0);
header("location: ../../user/good_manage_result.php?result={$result_num}");
