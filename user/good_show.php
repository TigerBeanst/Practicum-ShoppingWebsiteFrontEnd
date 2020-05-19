<script src="https://cdn.bootcss.com/popper.js/1.14.7/umd/popper.min.js"></script>
<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
} else {
    $url = "http://tool.jakting.com/store/";
}
include "../header.php";
$id = $_GET['id'];
$sql = "SELECT * FROM goods WHERE id=$id";
$result = mysqli_query($conn, $sql) or die(header("location: ../user/index.php"));
$row = mysqli_fetch_array($result);
session_start();
if (!empty($row)) {
    //echo "登录成功";
    $_SESSION['goods_id'] = $row['id']; //向Session存入邮箱
    $_SESSION['owner_id'] = $row['owner']; //向Session存入邮箱
    $_SESSION['goods_title'] = $row['title']; //向Session存入注册时间
    $_SESSION['goods_price'] = $row['price']; //向Session存入注册时间
    $_SESSION['goods_shortdetails'] = $row['short_details']; //向Session存入省份
    $_SESSION['goods_details'] = $row['details']; //向Session存入省份
    $_SESSION['goods_addtime'] = $row['add_time']; //向Session存入城市
    $_SESSION['goods_sellstatus'] = $row['sell_status']; //向Session存入区域
    $_SESSION['goods_img'] = $row['img']; //向Session存入具体地址
    $_SESSION['goods_cate_s_id'] = $row['cate']; //向Session存入具体地址
    $sql = "SELECT cate.id,cate.name,cate_s.sname FROM cate,cate_s WHERE cate_s.sid={$row['cate']} AND cate_s.cid = cate.id";
    $result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
    $row = mysqli_fetch_array($result);
    $_SESSION['goods_cate_s_name'] = $row['sname'];
    $_SESSION['goods_cate_id'] = $row['id'];
    $_SESSION['goods_cate_name'] = $row['name'];
} else {
    $error = "出错";
}
date_default_timezone_set('Asia/Shanghai'); //设置时间戳时区
$admin_status = false;
if ($_SESSION['status'] == 3) {
    //是管理员，显示编辑按钮
    $modify_url = $url . "user/good_manage_modify.php?id=";
    $admin_status = true;
}
$cate_url = $url . "user/index.php?id=";
?>
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/good_show.css" rel="stylesheet">
<title><?php echo $_SESSION['goods_title']; ?> - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="card mb-3" style="max-width: 1000px;margin:0 auto">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?php echo $_SESSION['goods_img']; ?>" class="card-img"
                             alt="<?php echo $_SESSION['goods_title']; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $_SESSION['goods_title']; ?></h5>
                            <p class="card-text"><?php echo $_SESSION['goods_shortdetails']; ?></p>
                            <form action="../include/post/addShoppingCartItem.php" method="post"
                                  id="add_to_shopping_cart_form">
                                <div class="card text-white bg-dark mb-3">
                                    <div class="card-header">价格
                                        <small class="text"
                                               style="float: right"><?php echo date("Y-m-d", $_SESSION['goods_addtime']); ?>
                                            发布
                                        </small>
                                    </div>
                                    <div class="card-body">
                                    <span class="card-title"
                                          style="font-size: 1.25rem;margin-bottom: .75rem;">￥<?php echo $_SESSION['goods_price']; ?></span>
                                        <div class="card-text number-style"><input name="goods_num" class="form-control"
                                                                                   type="number" value="1" min="1"
                                                                                   max="50"
                                                                                   step="1"/></div>
                                    </div>
                                </div>
                                <input type="text" name="goods_title" class="form-control"
                                       value="<?php echo $_SESSION['goods_title']; ?>" hidden>
                                <input type="text" name="goods_img" class="form-control"
                                       value="<?php echo $_SESSION['goods_img']; ?>" hidden>
                                <input type="text" name="goods_price" class="form-control"
                                       value="<?php echo $_SESSION['goods_price']; ?>" hidden>
                                <input type="text" name="goods_id" class="form-control"
                                       value="<?php echo $_SESSION['goods_id']; ?>" hidden>
                                <button type="button" data-toggle="tooltip" data-placement="bottom" title="确定加入购物车吗？"
                                        id="add_shopping_cart" class="btn btn-dark"><i class="fas fa-cart-plus"></i>
                                    加入购物车
                                </button><?php if ($admin_status) { ?>
                                <button type="button" class="btn btn-dark"
                                        onclick="window.location.href='<?php echo $modify_url . $id; ?>'"><i
                                                class="fas fa-pen"></i> 编辑</button><?php } ?>
                                <div style="float: right">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a
                                                        href="<?php echo $cate_url . $_SESSION['goods_cate_id']; ?>"
                                                        class="text-white"><?php echo $_SESSION['goods_cate_name']; ?></a>
                                            </li>
                                            <li class="breadcrumb-item" aria-current="page"><a
                                                        href="<?php echo $cate_url . $_SESSION['goods_cate_id'] . "&id_s=" . $_SESSION['goods_cate_s_id']; ?>"
                                                        class="text-white"><?php echo $_SESSION['goods_cate_s_name']; ?></a>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="max-width: 1000px;margin:0 auto">
                <div class="card-header">
                    商品详情
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <?php echo $_SESSION['goods_details']; ?>
                    </blockquote>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="../include/js/InputSpinner.js"></script>
<script>
    $("input[type='number']").InputSpinner()

    var click_time = false
    $('#add_shopping_cart').click(function () {
        if (click_time == true) {
            document.getElementById('add_to_shopping_cart_form').submit()
        } else {
            $('#add_shopping_cart').tooltip('show')
            click_time = true
        }
    });

    /*$(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })*/
</script>
