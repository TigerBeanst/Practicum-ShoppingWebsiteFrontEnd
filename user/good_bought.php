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

$delete_cart_url = $url."include/post/deleteShoppingCartItem.php?id=";
$pay_url = $url."user/pay.php?pay=";

$sql = "SELECT bought_goods FROM user WHERE username='{$_SESSION['username']}';";
$result = mysqli_query($conn, $sql) or die(header("location: ../user/index.php"));
$row = mysqli_fetch_array($result);
$bought_all = $row['bought_goods'];
$bought_num = 0;
$re = '/"id":(.*?),"num":(.*?),"bought_time":(.*?)}/';
preg_match_all($re, $bought_all, $arr, PREG_SET_ORDER, 0);

$goods_all_num = sizeof($arr);  //购买商品总量
//echo "数量".$goods_all_num;
//echo "<pre>";print_r($arr);echo "</pre>";
for ($n = 0; $n <= $goods_all_num - 1; $n++) {
    $bought_num++;
    $bought_good_id[$n] = $arr[$n][1];
    $bought_good_num[$n] = $arr[$n][2];
    $bought_good_buytime[$n] = $arr[$n][3];
    $sql = "SELECT title,price,img FROM goods WHERE id={$bought_good_id[$n]};";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $bought_good_title[$n] = $row['title'];
    $bought_good_price[$n] = bcmul($row['price'], $bought_good_num[$n], 2);
    $bought_good_img[$n] = $row['img'];
}
date_default_timezone_set('Asia/Shanghai');
?>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/locale/bootstrap-table-zh-CN.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.css" rel="stylesheet">
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/shopping_cart.css" rel="stylesheet">
<title>已购买的商品 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">已购买的商品（共 <?php echo $bought_num; ?> 件）</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="window.location.href='../include/post/setShoppingCartEmpty.php'">
                        <i class="far fa-trash-alt"> </i>
                        清空购物车
                    </button>
                </div>
            </div>
            <table class="table table-striped" data-toggle="table"
                   data-pagination="true">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">商品</th>
                    <th scope="col">总价</th>
                    <th scope="col">数量</th>
                    <th scope="col">购买时间</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($n = 1; $n <= $bought_num; $n++) { ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td>
                            <a href="<?php echo $url."user/good_show.php?id=" . $bought_good_id[$n - 1]; ?>"
                               target="_blank"><img src="<?php echo $bought_good_img[$n - 1]; ?>"
                                                    width="30px"
                                                    height="auto"/> <?php echo $bought_good_title[$n - 1]; ?>
                            </a></td>
                        <td>￥<?php echo $bought_good_price[$n - 1]; ?></td>
                        <td><?php echo $bought_good_num[$n - 1]; ?></td>
                        <td><?php echo date("Y-m-d H:i:s", $bought_good_buytime[$n - 1]); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
