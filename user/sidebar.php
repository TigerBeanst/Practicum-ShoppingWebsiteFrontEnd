<?php
session_start();
$now_url = basename($_SERVER['SCRIPT_NAME']);
date_default_timezone_set('Asia/Shanghai');
?>
<style>
    .nav_right {
        margin-right: 8px !important;
        width: 14px;
        height: auto;
    }
</style>
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link<?php if ($now_url == "index.php" || $now_url == "good_show.php") {
                    echo " active";
                } ?>" href="index.php">
                    <i class="fas fa-compass nav_right"></i>首页
                </a>
            </li>
        </ul>
        <?php if (!isset($_SESSION['login_status'])) { ?>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="../include/login.php">
                        <i class="fas fa-lock nav_right"></i>登录
                    </a>
                </li>
            </ul>
        <?php } else { ?>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>个人中心</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link<?php if ($now_url == "good_bought.php") {
                        echo " active";
                    } ?>" href="good_bought.php">
                        <i class="fas fa-cart-arrow-down nav_right"></i>已购买的商品
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($now_url == "shopping_cart.php") {
                        echo " active";
                    } ?>" href="shopping_cart.php">
                        <i class="fas fa-shopping-cart nav_right"></i>购物车
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>新闻中心</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link<?php if ($now_url == "news_list.php") {
                        echo " active";
                    } ?>" href="news_list.php">
                        <i class="fas fa-newspaper nav_right"></i>新闻阅读
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>资料更改</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link<?php if ($now_url == "change_info.php") {
                        echo " active";
                    } ?>" href="change_info.php">
                        <i class="fas fa-user-edit nav_right"></i>修改资料
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($now_url == "change_password.php") {
                        echo " active";
                    } ?>" href="change_password.php">
                        <i class="fas fa-key nav_right"></i>修改密码
                    </a>
                </li>
            </ul>
            <?php if ($_SESSION['status'] == 3) { ?>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>管理中心</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link<?php if ($now_url == "good_manage.php") {
                            echo " active";
                        } ?>" href="good_manage.php">
                            <i class="fas fa-tasks nav_right"></i>商品管理
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if ($now_url == "good_manage_add.php") {
                            echo " active";
                        } ?>" href="good_manage_add.php">
                            <i class="fas fa-cart-plus nav_right"></i>添加商品
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php if ($now_url == "users_manage.php") {
                            echo " active";
                        } ?>" href="users_manage.php">
                            <i class="fas fa-user-cog nav_right"></i>用户管理
                        </a>
                    </li>
                </ul>
            <?php } ?>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>上次登录</span>
                <i class="fas fa-clock"> <?php echo date("Y-m-d H:i:s", $_SESSION['log_time']); ?></i>
            </h6>
        <?php } ?>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Made By</span>
            WFQ、HJT、YLJ</i>
        </h6>
        <?php if (isset($_SESSION['login_status'])) { ?>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>您的身份</span>
                <?php if ($_SESSION['status'] == 3) {
                    echo "管理员";
                } else if ($_SESSION['status'] == 2) {
                    echo "商户";
                } else if ($_SESSION['status'] == 0) {
                    echo "封禁用户";
                } else {
                    echo "用户";
                } ?></i>
            </h6>
        <?php } ?>

    </div>
</nav>
