<?php

$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "include/db/database.config.php";
session_start();
//如果登录了
$login_ss = false;
if (isset($_SESSION['login_status'])) {
    $login_ss = true;
    $login_button = "注销";
    $login_url = $url . "user/logout.php";
} else {
    $login_ss = false;
    $login_button = "登录";
    $login_url = $url . "include/login.php";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.bootcss.com/font-awesome/5.8.2/css/all.min.css" rel="stylesheet">

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a class="logo_a" href="<?php echo $url; ?>"><i
                        class="fas fa-shopping-cart"></i> WHY网上购物商店</a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <span class="p-2 text-dark"><?php if ($login_ss) {
                    echo "欢迎回来，" . $_SESSION['name'];
                } ?></span>
        </nav>
        <a class="btn btn-outline-primary" href="<?php echo $login_url; ?>"><?php echo $login_button; ?></a>
    </div>
    <style>
        .logo_a {
            color: black;
        }
        .logo_a:hover {
            text-decoration: none;
            color: black;
        }
    </style>
