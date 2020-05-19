<?php
/*
 * 登录界面
 */
session_start();
//如果参数里带错误并且值为1，则为下面展示「用户名或密码错误，请重试」做准备
$login_error = 0;
if (isset($_GET['error']) && $_GET['error'] == 1) {
    $login_error = 1;
}
//如果手动访问此网页时已经登录，直接跳首页
if (isset($_SESSION['login_status'])) {
    header("location: ../user/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.bootcss.com/font-awesome/5.8.2/css/all.min.css" rel="stylesheet">
    <title>登录 - WHY网上购物商店</title>
    <link href="../include/css/login.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" action="post/setLogin.php" method="post">
    <!--如果参数里带error=1，则显示错误 start-->
    <?php if ($login_error == 1) {
        $info_result = 0; ?>
        <div class="alert alert-danger" role="alert">
            用户名或密码错误，请重试
        </div>
    <?php } ?>
    <!--如果参数里带error=1，则显示错误 end-->
    <i class="fas fa-shopping-cart fa-4x"></i>
    <h1 class="h3 mb-3 font-weight-normal">登录</h1>
    <label for="inputEmail" class="sr-only">用户名</label>
    <input type="text" id="inputEmail" class="form-control" placeholder="用户名" name="username" required autofocus>
    <label for="inputPassword" class="sr-only">密码</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="密码" name="password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    <button class="btn btn-lg btn-outline-primary btn-block" onclick="window.location.href='register.php'">注册</button>
    <p class="mt-5 mb-3 text-muted">WHY网上购物商店 &copy; 2020</p>
</form>
</body>
</html>
