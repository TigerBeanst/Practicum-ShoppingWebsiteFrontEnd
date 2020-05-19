<?php
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include $url."header.php";
?>
<link href="../include/css/login_request.css" rel="stylesheet">
<title>尚未登录 - WHY网上购物商店</title>
</head>

<body>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">尚未登录</h1>
    <p class="lead">WHY网上购物商店仅限登录用户浏览。<br>请登录或注册账号。</p>
</div>

<div class="container">
    <div class="card-deck mb-3 text-center">
        <button type="button" class="btn btn-lg btn-block btn-primary login_button" onclick="window.location.href='../include/login.php'">登录/注册</button>
    </div>

</div>
</body>
</html>
