<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";
$name = $_POST["name"];
$email = $_POST["email"];
$loc_province = $_POST["province"];
$loc_city = $_POST["city"];
$loc_dist = $_POST["dist"];
$loc_location = $_POST["loc_location"];
$sql = "UPDATE user SET name='{$name}' , loc_province=$loc_province , loc_city=$loc_city , loc_dist=$loc_dist , loc_location='$loc_location' WHERE username='{$_SESSION['username']}';";
$result = mysqli_query($conn, $sql) or die("有错".$sql);
echo $sql;
$_SESSION['info_modify'] = true;
header("location: ../../user/change_info.php");
