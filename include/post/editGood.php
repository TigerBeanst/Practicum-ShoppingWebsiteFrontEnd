<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";
$good_modify_cate = $_POST["city"];
$good_modify_title = $_POST["good_title"];
$good_modify_shortdetails = $_POST["good_shortdetails"];
$good_modify_img = $_POST["good_img"];
$good_modify_price = $_POST["good_price"];
$good_modify_detaials = $_POST["good_detaials"];
$good_modify_id = $_POST["good_id"];
$sql = "UPDATE goods SET cate = {$good_modify_cate}, title = '{$good_modify_title}', price = {$good_modify_price}, short_details = '{$good_modify_shortdetails}', details = '{$good_modify_detaials}', img = '{$good_modify_img}' WHERE id = {$good_modify_id};";
$result = mysqli_query($conn, $sql) or die("有错" . $sql);

header("location: {$url}user/good_show.php?id=" . $good_modify_id);
