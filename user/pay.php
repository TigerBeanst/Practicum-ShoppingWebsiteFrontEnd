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
$pay_method = $_GET['pay'];
if ($pay_method == "wechat_pay") {
    $pay_name = "微信支付";
} else {
    $pay_name = "支付宝";
}
$sql = "SELECT bought_goods FROM user WHERE username='{$_SESSION['username']}';";
$result = mysqli_query($conn, $sql) or die('header("location: ../user/index.php")'.'///'.$sql);
$row = mysqli_fetch_array($result);
$bought_all = $row['bought_goods'];
$bought_all_word = "{\"bought\":[";
if($bought_all!=""){
    $bought_all = str_replace(",]}","",$bought_all);
    $bought_all_word = $bought_all;
}
$bought_all_word_2 = "]}";
for ($n = 1; $n <= $_SESSION['shopping_cart_all']; $n++) {
    $bought_all_word = $bought_all_word."{\"id\":".$_SESSION['shopping_cart_goods_id'][$n].",\"num\":".$_SESSION['shopping_cart_goods_num'][$n].",\"bought_time\":".time()."},";
}
$bought_all_word = $bought_all_word.$bought_all_word_2;

$sql = "UPDATE user SET bought_goods='{$bought_all_word}' WHERE username='{$_SESSION['username']}';";
$result = mysqli_query($conn, $sql) or die("有错" . $sql);
$shopping_cart_all = $_SESSION['shopping_cart_all'];
unset($_SESSION['shopping_cart_all']);
?>
<link href="../include/css/user_index.css" rel="stylesheet">
<title>支付成功 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if ($pay_method == "wechat") { ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">支付成功</h4>
                    <p>已通过 <strong>微信支付</strong> 支付 <code><?php echo $shopping_cart_all; ?></code> 件商品，共
                        <code><?php echo $_SESSION['shopping_cart_all_goods_price_all']; ?></code> 元</p>
                    <hr>
                    <p class="mb-0"><a href="good_bought.php" class="badge badge-success">已购买的商品</a></p>
                </div>
            <?php } else { ?>
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">支付成功</h4>
                    <p>已通过 <strong>支付宝</strong> 支付 <code><?php echo $shopping_cart_all; ?></code> 件商品，共
                        <code><?php echo $_SESSION['shopping_cart_all_goods_price_all']; ?></code> 元</p>
                    <hr>
                    <p class="mb-0"><a href="good_bought.php" class="badge badge-primary">已购买的商品</a></p>
                </div>
            <?php } ?>
        </main>
    </div>
</div>
