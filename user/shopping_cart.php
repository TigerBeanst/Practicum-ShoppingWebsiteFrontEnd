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
if (!isset($_SESSION['shopping_cart_all'])) {
    $shopping_cart_all = 0;
} else {
    $shopping_cart_all = $_SESSION['shopping_cart_all'];
}
$delete_cart_url = $url."include/post/deleteShoppingCartItem.php?id=";
$pay_url = $url."user/pay.php?pay=";
?>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/locale/bootstrap-table-zh-CN.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.css" rel="stylesheet">
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/shopping_cart.css" rel="stylesheet">
<title>购物车 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">购物车（共 <?php echo $shopping_cart_all; ?> 件商品）</h1>
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
                    <th scope="col">单价</th>
                    <th scope="col">数量</th>
                    <th scope="col">总价</th>
                    <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($n = 1; $n <= $_SESSION['shopping_cart_all']; $n++) { ?>
                    <tr>
                        <td><?php echo $n; ?></td>
                        <td>
                            <a href="<?php echo $url."user/good_show.php?id=" . $_SESSION['shopping_cart_goods_id'][$n]; ?>"
                               target="_blank"><img src="<?php echo $_SESSION['shopping_cart_goods_img'][$n]; ?>"
                                                    width="30px"
                                                    height="auto"/> <?php echo $_SESSION['shopping_cart_goods_title'][$n]; ?>
                            </a></td>
                        <td>￥<?php echo $_SESSION['shopping_cart_goods_price'][$n]; ?></td>
                        <td><?php echo $_SESSION['shopping_cart_goods_num'][$n]; ?></td>
                        <td>￥<?php echo $_SESSION['shopping_cart_goods_price_all'][$n]; ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="window.location.href='<?php echo $delete_cart_url . $n; ?>'"><i
                                        class="fas fa-trash-alt"></i> 删除
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php if ($_SESSION['shopping_cart_all'] >= 1) { ?>
                <div class="click_cart">
                    <a href="#" class="btn btn-primary btn-lg" role="button" aria-pressed="true" data-toggle="modal"
                       data-target="#pay_for_good"><span
                                class="badge badge-light">共 <?php echo $_SESSION['shopping_cart_all']; ?> 件</span> 结算
                        <span
                                class="badge badge-light">￥<?php echo $_SESSION['shopping_cart_all_goods_price_all']; ?></span></a>
                    <!-- Modal -->
                    <div class="modal fade" id="pay_for_good" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">请选择支付方式</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="margin: 0 auto">
                                    <a href="<?php echo $pay_url; ?>wechat"><img src="../../static/img/wechat_pay.png"
                                                                                 width="150px" height="auto"
                                                                                 style="margin-right: 30px"/></a>
                                    <a href="<?php echo $pay_url; ?>alipay"><img src="../../static/img/alipay.png"/></a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </main>
    </div>
</div>
