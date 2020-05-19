<?php
/**
 * @desc 添加商品
 * @apiparam {"name":"id","type":"int" ,"desc":"ID","require":"true"}
 * @return $row['id']
 */
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";
$good_add_cate = $_POST["city"];
$good_add_title = $_POST["good_title"];
$good_add_shortdetails = $_POST["good_shortdetails"];
$good_add_img = $_POST["good_img"];
$good_add_price = $_POST["good_price"];
$good_add_detaials = $_POST["good_detaials"];
$good_add_time = time();
$sql = "INSERT INTO goods (owner,cate,title,price,short_details,details,add_time,sell_status,img) VALUES ({$_SESSION["id"]},{$good_add_cate},'{$good_add_title}',{$good_add_price},'{$good_add_shortdetails}','{$good_add_detaials}',$good_add_time,0,'{$good_add_img}');";
$result = mysqli_query($conn, $sql) or die("有错" . $sql);
$sql = "SELECT id FROM goods WHERE add_time={$good_add_time} AND owner={$_SESSION["id"]}";
$result = mysqli_query($conn, $sql) or die("有错" . $sql);
$row = mysqli_fetch_array($result);
header("location: ../../user/good_show.php?id=" . $row['id']);
