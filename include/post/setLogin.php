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
$sql = "SELECT * FROM user WHERE username='$username' AND password = '$password';";
$result = mysqli_query($conn, $sql) or die("有错".$username."///".$password."///".$sql."路径：".$url."include/db/database.config.php");
$row = mysqli_fetch_array($result);
//$count = mysqli_num_rows($result);
// 只有一个的时候说明用户名和密码匹配
if (!empty($row)) {
    //echo "登录成功";
    $_SESSION['username'] = $username; //向Session存入用户名
    $_SESSION['id'] = $row['id']; //向Session存入昵称
    $_SESSION['name'] = $row['name']; //向Session存入昵称
    $log_time = time();
    $_SESSION['log_time'] = $log_time; //向Session存入昵称
    $sql = "UPDATE user SET log_time = ".$log_time." where username='$username';"; //保存上次登录时间
    $result = mysqli_query($conn, $sql) or die("有错");
    if ($row['status'] == 2) {
        $_SESSION['status'] = 2; //商户
    } else if($row['status'] == 3){
        $_SESSION['status'] = 3; //管理员
    }else if($row['status'] == 0){
        $_SESSION['status'] = 0; //封禁用户
    } else{
        $_SESSION['status'] = 1; //用户
    }
    $_SESSION['login_status'] = 1; //登录状态
    header("location: ../../user/index.php");
} else {

    $error = true;
    header("location: ../../include/login.php?error=1");
}
