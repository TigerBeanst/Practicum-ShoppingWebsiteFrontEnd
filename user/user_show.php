<script src="https://cdn.bootcss.com/popper.js/1.14.7/umd/popper.min.js"></script>
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
$id = $_GET['id'];
$sql = "SELECT * FROM news WHERE id=$id";
$result = mysqli_query($conn, $sql) or die(header("location: ../user/index.php"));
$row = mysqli_fetch_array($result);
if (!empty($row)) {
    //echo "登录成功";
    $_SESSION['news_id'] = $row['id']; //向Session存入邮箱
    $_SESSION['news_title'] = $row['title']; //向Session存入注册时间
    $_SESSION['news_details'] = $row['details']; //向Session存入省份
    $_SESSION['news_addtime'] = $row['add_time']; //向Session存入城市
    $sql = "SELECT name FROM user WHERE id={$row['author']}";
    $result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
    $row = mysqli_fetch_array($result);
    $_SESSION['author_id'] = $row[0]; //向Session存入邮箱
} else {
    $error = "出错";
}
date_default_timezone_set('Asia/Shanghai'); //设置时间戳时区
$admin_status = false;
if ($_SESSION['status'] == 3) {
    //是管理员，显示编辑按钮
    $modify_url = $url."user/news_manage_modify.php?id=";
    $admin_status = true;
}
?>
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/good_show.css" rel="stylesheet">
<title><?php echo $_SESSION['news_title']; ?> - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="card" style="max-width: 1000px;margin:0 auto">
                <div class="card-header">
                    <h4><?php echo $_SESSION['news_title']; ?>
                        <?php if ($admin_status) { ?>
                        <div style="float: right">
                            <button type="button" class="btn btn-dark"
                                    onclick="window.location.href='<?php echo $modify_url . $id; ?>'"><i
                                        class="fas fa-pen"></i> 编辑
                            </button>
                        </div><?php } ?>
                    </h4>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <?php echo $_SESSION['news_details']; ?>
                    </blockquote>
                </div>
                <div class="card-footer text-muted">
                    <i class="fas fa-clock"></i> <?php echo date("Y-m-d H:i:s", $_SESSION['news_addtime']); ?>
                </div>
            </div>
        </main>
    </div>
</div>
