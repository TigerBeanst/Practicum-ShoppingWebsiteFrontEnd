<?php
session_start();
if (!isset($_SESSION['login_status'])){
    header("location:../include/login.php");
}
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../header.php";
$sql = "SELECT * FROM user WHERE username='" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $sql) or die("有错");
$row = mysqli_fetch_array($result);
if (!empty($row)) {
    //echo "登录成功";
    $_SESSION['name'] = $row['name']; //向Session存入邮箱
    $_SESSION['email'] = $row['email']; //向Session存入邮箱
    $_SESSION['reg_time'] = $row['reg_time']; //向Session存入注册时间
    $_SESSION['loc_province'] = $row['loc_province']; //向Session存入省份
    $_SESSION['loc_city'] = $row['loc_city']; //向Session存入城市
    $_SESSION['loc_dist'] = $row['loc_dist']; //向Session存入区域
    $_SESSION['loc_location'] = $row['loc_location']; //向Session存入具体地址
} else {
    $error = "出错";
}
date_default_timezone_set('Asia/Shanghai'); //设置时间戳时区

$info_result = 0;
if (isset($_SESSION['info_modify']) && $_SESSION['info_modify'] == true) {
    $_SESSION['info_modify'] = false;
    $info_result = 1;
}
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
                <form action="../include/post/setUserInfo.php" method="post">
                    <div class="mb-3">
                        <label for="username">用户名</label>
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="<?php echo $_SESSION['username']; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="reg_time">注册时间</label>
                        <input type="text" class="form-control" id="reg_time" name="reg_time"
                               value="<?php echo date("Y-m-d H:i:s", $_SESSION['reg_time']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name">姓名</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email">邮箱</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="loc_location">收货地址</label>
                        <div id="area-select-box" class="form-inline"></div>
                        <input type="text" class="form-control" id="loc_location" name="loc_location"
                               value="<?php echo $_SESSION['loc_location']; ?>">
                    </div>
                    <button class="btn btn-lg btn-block btn-primary" type="submit">保存</button>

                </form>
            </div>
        </main>
    </div>
</div>

<script type="text/javascript">
    var area = $("#area-select-box").JAreaSelect({
        prov: <?php echo $_SESSION['loc_province'];?>,
        city: <?php echo $_SESSION['loc_city'];?>,
        dist: <?php echo $_SESSION['loc_dist'];?>,
    });
</script>
