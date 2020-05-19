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
$sql = "SELECT count(*) FROM user";
$result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
$row = mysqli_fetch_array($result);
if (!empty($row)) {
    //echo "登录成功";
    $user_all_num = $row[0]; //向Session存入邮箱
} else {
    $error = "出错";
}
?>
<link href="../include/css/user_index.css" rel="stylesheet">
<title>用户管理 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">用户管理（共 <?php echo $user_all_num; ?> 位用户）</h1>
            </div>
            <form action="users_manage_result.php" method="post">
                <div class="input-group" style="max-width: 1000px;margin:0 auto">
                    <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" name="key">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">搜索</button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>
