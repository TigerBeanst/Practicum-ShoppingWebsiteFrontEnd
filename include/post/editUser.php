<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
} else {
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";
$username = $_POST["username"];
$name = $_POST["name"];
$email = $_POST["email"];
$loc_province = $_POST["province"];
$loc_city = $_POST["city"];
$loc_dist = $_POST["dist"];
$loc_location = $_POST["loc_location"];
$check_status = $_POST["check_status"];
$status = 0;
if ($check_status == 'check_admin') {
    $status = 3;
} else if ($check_status == 'check_merchant') {
    $status = 2;
} else if($check_status == 'check_ban'){
    $status = 0;
} else{
    $status = 1;
}
$sql = "UPDATE user SET name='{$name}' , loc_province=$loc_province , loc_city=$loc_city , loc_dist=$loc_dist , loc_location='{$loc_location}' , status=$status WHERE username='{$username}';";
$result = mysqli_query($conn, $sql) or die("有错" . $sql);
echo $sql;
$_SESSION['info_modify'] = true;
header("location: ../../user/user_manage_modify.php?username=$username&check_status=$check_status");
