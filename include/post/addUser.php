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
$password = md5($_POST["password"]);
$name = $_POST["name"];
$email = $_POST["email"];
$loc_province = $_POST["province"];
$loc_city = $_POST["city"];
$loc_dist = $_POST["dist"];
$loc_location = $_POST["address"];
$sql = "SELECT * FROM user WHERE username='$username';";
$result = mysqli_query($conn, $sql) or die("有错".$username."///".$password."///".$sql."路径：".$url."include/db/database.config.php");
$row = mysqli_fetch_array($result);
if (!empty($row)) {
    //用户存在
    header("location: ../../include/register.php?error=1");
}else{
    //用户不存在，可以注册
    $reg_time = time();
    $sql = "INSERT INTO user (username,password,name,email,loc_province,loc_city,loc_dist,loc_location,status,reg_time,log_time) VALUES ('{$username}','{$password}','{$name}','{$email}','{$loc_province}','{$loc_city}','{$loc_dist}','{$loc_location}',1,{$reg_time},{$reg_time});";
    $result = mysqli_query($conn, $sql) or die("有错");
    $row = mysqli_fetch_array($result);
    $_SESSION['username'] = $username;
    $_SESSION['login_status'] = 1;
    $sql = "SELECT id FROM user WHERE username='$username';";
    $result = mysqli_query($conn, $sql) or die("有错");
    $row = mysqli_fetch_array($result);
    $_SESSION['id'] = $row[0];
    $_SESSION['name'] = $name;
    $_SESSION['log_time'] = $reg_time;
    $_SESSION['status'] = 1;
    header("location: ../../user/index.php");
}
