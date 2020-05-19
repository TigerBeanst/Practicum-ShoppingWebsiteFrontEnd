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
?>
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/good_manage_add.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/wangEditor/10.0.13/wangEditor.min.js"></script>
<script src="../include/js/wangEditor-codeMode-plugin.min.js"></script>
<script src="../include/js/JAreaData_cate.js"></script>
<title>添加商品 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">添加商品</h1>
            </div>
            <div class="main-body">
                <form action="../include/post/addGood.php" method="post">
                    <div class="mb-3">
                        <label for="good_cate">商品分类</label>
                        <div id="area-select-box" class="form-inline"></div>
                    </div>
                    <div class="mb-3">
                        <label for="good_title">商品名称</label>
                        <input type="text" class="form-control" id="good_title" name="good_title" required>
                    </div>
                    <div class="mb-3">
                        <label for="good_shortdetails">短描述</label>
                        <input type="text" class="form-control" id="good_shortdetails" name="good_shortdetails" required>
                    </div>
                    <div class="mb-3">
                        <label for="good_img">图片链接</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-describedby="button-addon2" name="good_img" id="good_img" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-preview-goodimg">预览</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="good_price">价格</label>
                        <input type="number" class="form-control" id="name" name="good_price" step="0.01" required>
                        <small id="emailHelp" class="form-text text-muted">仅限两位小数，超出部分将被截断。</small>
                    </div>
                    <label for="good_shortdetails">商品详情</label>
                    <div id="editor"></div>
                    <br>
                    <input type="textarea" class="form-control" id="good_detaials" name="good_detaials" hidden required>
                    <button class="btn btn-lg btn-block btn-primary" type="submit" id="add_submit">保存</button>
                    <br>
                </form>
            </div>
        </main>
    </div>
</div>

<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#editor')
    editor.customConfig.uploadImgShowBase64 = true
    editor.customConfig.onchange = function (html) {
        // html 即变化之后的内容
        document.getElementById('good_detaials').value = html
    }
    editor.create()
    E.codeMode.init(editor);


    var area = $("#area-select-box").JAreaSelect({
        prov: 1,
        city: 21,
    });
    document.getElementById("button-preview-goodimg").addEventListener('click', function (){
        var good_img_url = document.getElementById("good_img").value
        window.open(good_img_url)
    }, false)
</script>
<style>
    #dist {
        display: none;
    }
</style>
