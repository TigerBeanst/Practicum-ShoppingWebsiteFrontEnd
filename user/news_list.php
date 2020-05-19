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
$sql = "SELECT count(*) FROM news";
$result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
$row = mysqli_fetch_array($result);
$news_num = $row[0];
$sql = "SELECT * FROM news ORDER BY add_time DESC";
$result = mysqli_query($conn, $sql);
$news_details_url = $url."user/news_show.php?id=";
date_default_timezone_set('Asia/Shanghai');
?>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/locale/bootstrap-table-zh-CN.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.css" rel="stylesheet">
<link href="../include/css/user_index.css" rel="stylesheet">
<title>新闻浏览 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">新闻浏览</h1>
            </div>
            <table class="table table-striped" data-toggle="table"
                   data-pagination="true">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">标题</th>
                    <th scope="col">发布时间</th>
                </tr>
                </thead>
                <tbody>
                <?php $n = 1;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td><a href="<?php echo $news_details_url.$row['id']; ?>"
                               target="_blank"><?php echo $row['title']; ?></a></td>
                        <td><?php echo date("Y-m-d H:i:s", $row['add_time']); ?></td>
                    </tr>
                    <?php $n++;
                } ?>
                </tbody>
            </table>

        </main>
    </div>
</div>
