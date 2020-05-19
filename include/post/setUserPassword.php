<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";
$username = $_SESSION["username"];
$passwordO = md5($_POST["passwordO"]);
$passwordN = md5($_POST["passwordN"]);

$sql = "SELECT password FROM user WHERE username='{$username}';";
$result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
$row = mysqli_fetch_array($result);
if($passwordO == $row[0]){
    //密码正确，开始修改密码
    $sql = "UPDATE user SET password='{$passwordN}' WHERE username='{$username}';";
    $result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
    $row = mysqli_fetch_array($result);
    header("location: ../../user/change_password.php?pw_modify=1");
}else{
    //原密码错误
    header("location: ../../user/change_password.php?pw_modify=2");
}

