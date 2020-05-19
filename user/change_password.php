<?php
session_start();
if (!isset($_SESSION['login_status'])) {
    header("location:../include/login.php");
}
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../header.php";

date_default_timezone_set('Asia/Shanghai'); //设置时间戳时区

$pw_result = 0;
if (isset($_GET['pw_modify']) && $_GET['pw_modify'] == 1) {
    $pw_result = 1;
}else if(isset($_GET['pw_modify']) && $_GET['pw_modify'] == 2)
    $pw_result = 2;
?>
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/user_change_info.css" rel="stylesheet">
<script src="../include/js/JAreaData.js"></script>
<title>修改资料 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">修改资料</h1>
            </div>
            <div class="main-body">
                <?php if ($pw_result == 1) {
                    $pw_result = 0; ?>
                    <div class="alert alert-success" role="alert">
                        密码修改成功！
                    </div>
                <?php } ?>
                <?php if ($pw_result == 2) {
                    $pw_result = 0; ?>
                    <div class="alert alert-danger" role="alert">
                        旧密码错误！
                    </div>
                <?php } ?>
                <form action="../include/post/setUserPassword.php" method="post" onsubmit="return alter()">
                    <div class="mb-3">
                        <label for="passwordO">旧密码</label>
                        <input type="password" class="form-control" id="passwordO" name="passwordO" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordN">新密码</label>
                        <input type="password" class="form-control" id="passwordN" name="passwordN" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordNN">确认新密码</label>
                        <input type="password" class="form-control" id="passwordNN" name="passwordNN" required>
                    </div>
                    <button class="btn btn-lg btn-block btn-primary" type="submit">保存</button>

                </form>
            </div>
        </main>
    </div>
</div>

<script type="text/javascript">
    function alter() {
        var newpassword = document.getElementById("passwordN").value;
        var newpassworda = document.getElementById("passwordNN").value;

        if (newpassword != newpassworda) {
            alert("两次密码输入不一致");
            return false;
        }
        return true;
    }
</script>
