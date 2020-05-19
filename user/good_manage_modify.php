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
$sql = "SELECT * FROM goods WHERE id=$id";
$result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
$row = mysqli_fetch_array($result);
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
    $sql = "SELECT cate.id FROM cate,cate_s WHERE cate_s.sid={$row['cate']} AND cate_s.cid = cate.id";
    $result = mysqli_query($conn, $sql) or die($id . "啊啊啊" . $sql);
    $row = mysqli_fetch_array($result);
    $_SESSION['goods_cate_id'] = $row['id'];
} else {
    $error = "出错";
}
$delete_url = $url."include/post/deleteGood.php?id=";
?>
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/good_manage_modify.css" rel="stylesheet">
<script src="../include/js/JAreaData_cate.js"></script>
<script src="https://cdn.bootcss.com/wangEditor/10.0.13/wangEditor.min.js"></script>
<script src="../include/js/wangEditor-codeMode-plugin.min.js"></script>
<title>修改商品 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">修改商品
                    <button type="button" data-toggle="tooltip" data-placement="top" data-html="true" title="确定要删除商品吗？<br>此操作不可撤销"
                            id="delete_good" class="btn btn-danger"><i
                                class="fas fa-trash-alt"></i> 删除
                    </button>
                </h1>
            </div>
            <div class="main-body">
                <form action="../include/post/editGood.php" method="post">
                    <div class="mb-3">
                        <label for="good_cate">商品分类</label>
                        <div id="area-select-box" class="form-inline"></div>
                    </div>
                    <div class="mb-3">
                        <label for="good_title">商品名称</label>
                        <input type="text" class="form-control" id="good_title" name="good_title" required
                               value="<?php echo $_SESSION['goods_title']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="good_shortdetails">短描述</label>
                        <input type="text" class="form-control" id="good_shortdetails" name="good_shortdetails" required
                               value="<?php echo $_SESSION['goods_shortdetails']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="good_img">图片链接</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-describedby="button-addon2" name="good_img"
                                   id="good_img" required value="<?php echo $_SESSION['goods_img']; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-preview-goodimg">预览
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="good_price">价格</label>
                        <input type="number" class="form-control" id="name" name="good_price" step="0.01" required
                               value="<?php echo $_SESSION['goods_price']; ?>">
                        <small id="emailHelp" class="form-text text-muted">仅限两位小数，超出部分将被截断。</small>
                    </div>
                    <label for="good_shortdetails">商品详情</label>
                    <div id="editor">
                        <?php echo $_SESSION['goods_details']; ?>
                    </div>
                    <br>
                    <input type="textarea" class="form-control" id="good_detaials" name="good_detaials" required hidden>
                    <input type="text" class="form-control" id="good_id" name="good_id" value="<?php echo $id;?>" required hidden>
                    <button class="btn btn-lg btn-block btn-primary" type="submit" id="add_submit">保存</button>
                    <br>
                </form>
            </div>
        </main>
    </div>
</div>

<script type="text/javascript">
    var click_time = false;
    $('#delete_good').click(function () {
        if (click_time == true) {
            window.location.href = "<?php echo $delete_url . $id;?>";
        } else {
            $('#delete_good').tooltip('show');
            click_time = true
        }
    });

    var area = $("#area-select-box").JAreaSelect({
        prov: <?php echo $_SESSION['goods_cate_id'];?>,
        city: <?php echo $_SESSION['goods_cate_s_id'];?>,
        dist: 66671,
    });

    var E = window.wangEditor;
    var editor = new E('#editor');
    editor.customConfig.uploadImgShowBase64 = true;
    var $text1 = $('#good_detaials');
    editor.customConfig.onchange = function (html) {
        // 监控变化，同步更新到 textarea
        $text1.val(html)
    }
    editor.create();
    $text1.val(editor.txt.html());
    E.codeMode.init(editor);

    document.getElementById("button-preview-goodimg").addEventListener('click', function () {
        var good_img_url = document.getElementById("good_img").value;
        window.open(good_img_url)
    }, false)

</script>
<style>
    #dist {
        display: none;
    }
</style>
