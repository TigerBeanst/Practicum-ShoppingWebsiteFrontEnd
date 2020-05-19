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
if (isset($_GET['result'])) {
    $delete_result = $_GET['result'];
}
$keyword_of_news = $_POST['key'];
$sql = "SELECT * FROM user WHERE name LIKE '%{$keyword_of_news}%' or username LIKE '%{$keyword_of_news}%'";
$result = mysqli_query($conn, $sql);
$modify_url = $url . "user/user_manage_modify.php?username=";
?>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/locale/bootstrap-table-zh-CN.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.css" rel="stylesheet">
<link href="../include/css/user_index.css" rel="stylesheet">
<title>用户管理 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">搜索结果</h1>
                <?php if ($delete_result == 1) {
                    $info_result = 0; ?>
                    <div class="alert alert-success" role="alert">
                        已删除指定用户！
                    </div>
                <?php } ?>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="input-group" style="max-width: 1000px;margin:0 auto">
                        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">搜索</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped" data-toggle="table"
                   data-pagination="true">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">用户名</th>
                    <th scope="col">姓名</th>
                    <th scope="col">邮箱</th>
                    <th scope="col">身份</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php $n = 1;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php if ($row['status'] == 2) {
                                echo "商户";
                            } else if ($row['status'] == 3) {
                                echo "管理员";
                            } else if ($row['status'] == 0) {
                                echo "封禁用户";
                            } else {
                                echo "用户";
                            } ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"
                                    onclick="window.location.href='<?php echo $modify_url . $row['username']; ?>'"><i
                                        class="fas fa-pen"></i> 编辑
                            </button>
                        </td>
                    </tr>
                    <?php $n++;
                } ?>
                </tbody>
            </table>

        </main>
    </div>
</div>
