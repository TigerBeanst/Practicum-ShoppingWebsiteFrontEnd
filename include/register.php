<?php
session_start();
$reg_error = 0;
if (isset($_GET['error']) && $_GET['error'] == 1) {
    $reg_error = 1;
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
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script src="../include/js/JAreaData.js"></script>
    <title>注册 - WHY网上购物商店</title>
    <link href="../include/css/login.css" rel="stylesheet">
</head>
<body class="text-center">
<form class="form-signin" action="post/addUser.php" method="post" onsubmit="return check()">
    <?php if ($reg_error == 1) {
        $reg_error = 0; ?>
        <div class="alert alert-danger" role="alert">
            用户名已存在，请重新选择
        </div>
    <?php } ?>
    <i class="fas fa-key fa-4x"></i>
    <h1 class="h3 mb-3 font-weight-normal">注册</h1>
    <label for="inputUsername" class="sr-only">用户名</label>
    <input type="text" id="inputUsername" class="form-control" placeholder="用户名" name="username" required autofocus>
    <label for="inputPassword" class="sr-only">密码</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="密码" name="password"
           style="margin-bottom: 0px!important;" required>
    <label for="inputPassworda" class="sr-only">确认密码</label>
    <input type="password" id="inputPassworda" class="form-control" placeholder="确认密码" name="passworda" required>
    <label for="inputName" class="sr-only">姓名</label>
    <input type="text" id="inputName" class="form-control" placeholder="姓名" name="name" required>
    <label for="inputEmail" class="sr-only">邮箱</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="邮箱" name="email"
           style="margin-bottom: 10px!important;" required>
    <div id="area-select-box" class="form-inline"></div>
    <label for="inputAdd" class="sr-only">收货地址</label>
    <input type="address" id="inputAdd" class="form-control" placeholder="收货地址" name="address" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
    <p class="mt-5 mb-3 text-muted">WHY网上购物商店 &copy; 2020</p>
</form>
</body>
<script type="text/javascript">
    var area = $("#area-select-box").JAreaSelect({
        prov: 1,
        city: 72,
        dist: 2839,
    });

    function check() {
        var password = document.getElementById("inputPassword").value;
        var passworda = document.getElementById("inputPassworda").value;
        if (password != passworda) {
            alert("两次密码不一致!");
            return false;
        }
    }
</script>
<style>
    .form-inline select[name="province"] {
        width: 90px !important;
    }

    .form-inline select[name="city"] {
        width: 90px !important;
    }

    .form-inline select[name="dist"] {
        width: 120px !important;
    }
</style>
</html>
