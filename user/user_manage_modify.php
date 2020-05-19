<script src="https://cdn.bootcss.com/popper.js/1.14.7/umd/popper.min.js"></script>
<?php
session_start();
if (!isset($_SESSION['login_status'])) {
    header("location:../include/login.php");
}
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
} else {
    $url = "http://tool.jakting.com/store/";
}
include "../header.php";
$usernameG = $_GET['username'];
$sql = "SELECT * FROM user WHERE username='{$usernameG}'";
$result = mysqli_query($conn, $sql) or die($usernameG . "啊啊啊" . $sql);
$row = mysqli_fetch_array($result);
if (!empty($row)) {
    //echo "登录成功";
//    $_SESSION['id'] = $row['id'];
//    $_SESSION['username'] = $row['username'];
//    $_SESSION['name'] = $row['name'];
//    $_SESSION['reg_time'] = $row['reg_time'];
//    $_SESSION['email'] = $row['email'];
//    $_SESSION['loc_province'] = $row['loc_province'];
//    $_SESSION['loc_city'] = $row['loc_city'];
//    $_SESSION['loc_dist'] = $row['loc_dist'];
//    $_SESSION['loc_location'] = $row['loc_dist'];
} else {
    $error = "出错";
}
date_default_timezone_set('Asia/Shanghai'); //设置时间戳时区

$info_result = 0;
if (isset($_SESSION['info_modify']) && $_SESSION['info_modify'] == true) {
    $_SESSION['info_modify'] = false;
    $info_result = 1;
}
$delete_url = $url . "include/post/deleteUser.php?id=";
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
                <?php if ($info_result == 1) {
                    $info_result = 0; ?>
                    <div class="alert alert-success" role="alert">
                        资料修改成功！
                    </div>
                <?php } ?>
                <form action="../include/post/editUser.php" method="post">
                    <div class="mb-3">
                        <label for="username">用户名</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?php echo $row['username']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="reg_time">注册时间</label>
                        <input type="text" class="form-control" id="reg_time" name="reg_time"
                               value="<?php echo date("Y-m-d H:i:s", $row['reg_time']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email">邮箱</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="loc_location">收货地址</label>
                        <div id="area-select-box" class="form-inline"></div>
                        <input type="text" class="form-control" id="loc_location" name="loc_location"
                               value="<?php echo $row['loc_location']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="loc_location">用户身份</label>
                        <div id="area-select-box" class="form-inline"></div>
                        <?php $status = $row['status'];?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check_status" id="inlineRadio0"
                                   value="check_ban" <?php if($status==0) echo "checked";?>>
                            <label class="form-check-label" for="inlineRadio0" style="color: red">封禁用户</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check_status" id="inlineRadio1"
                                   value="check_user" <?php if($status==1) echo "checked";?>>
                            <label class="form-check-label" for="inlineRadio1">用户</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check_status" id="inlineRadio2"
                                   value="check_merchant"<?php if($status==2) echo "checked";?>>
                            <label class="form-check-label" for="inlineRadio2">商户</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check_status" id="inlineRadio3"
                                   value="check_admin"<?php if($status==3) echo "checked";?>>
                            <label class="form-check-label" for="inlineRadio3">管理员</label>
                        </div>
                    </div>

                    <button class="btn btn-lg btn-block btn-primary" type="submit">保存</button>
                </form>
                <form action="../include/post/deleteUser.php" method="post" id="delete_user_form">
                    <input type="text" class="form-control" id="username" name="username"
                           value="<?php echo $row['username']; ?>" readonly hidden>
                    <button type="button" class="btn btn-danger btn-lg btn-block" id="delete_user" data-toggle="tooltip" data-placement="bottom" title="确定删除此用户吗？此操作无法撤回">删除用户</button>
                </form>

            </div>
        </main>
    </div>
</div>

<script type="text/javascript">
    var area = $("#area-select-box").JAreaSelect({
        prov: <?php echo $row['loc_province'];?>,
        city: <?php echo $row['loc_city'];?>,
        dist: <?php echo $row['loc_dist'];?>,
    });

    var click_time = false
    $('#delete_user').click(function () {
        if (click_time == true) {
            document.getElementById('delete_user_form').submit()
        } else {
            $('#delete_user').tooltip('show')
            click_time = true
        }
    });
</script>
