<?php
include "../header.php";
//根据get的参数主动调整首页分类
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $cate_id_get = $_GET['id'];
    if (isset($_GET['id_s'])) {
        $cate_small_id_get = $_GET['id_s'];
    }
}
$good_show_url = $url . "user/good_show.php?id=";
$new_good = mysqli_fetch_array(select("*", "goods", "ORDER BY add_time DESC limit 1"));
?>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap-table/1.14.2/locale/bootstrap-table-zh-CN.min.js"></script>
<link href="https://cdn.bootcss.com/bootstrap-table/1.14.2/bootstrap-table.min.css" rel="stylesheet">
<link href="../include/css/user_index.css" rel="stylesheet">
<link href="../include/css/user_index_own.css" rel="stylesheet">
<title>首页 - WHY网上购物商店</title>
</head>
<div class="container-fluid top_status">
    <div class="row">
        <?php include "sidebar.php"; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">浏览</h1>
            </div>
            <div class="card" style="margin-bottom:20px!important; ">
                <div class="card-header">
                    最新上架
                </div>
                <div class="card-body row no-gutters">
                    <div class="col-md-2">
                        <img src="<?php echo $new_good['img']; ?>" class="card-img"
                             alt="<?php echo $new_good['title']; ?>">
                    </div>
                    <div class="col-md-10">
                        <h5 class="card-title"><?php echo $new_good['title']; ?></h5>
                        <p class="card-text"><?php echo $new_good['short_details']; ?></p>
                        <a href="<?php echo $good_show_url . $new_good['id']; ?>" class="btn btn-primary">查看详情</a>
                    </div>
                </div>
            </div>
            <?php include "../include/index_cate.php"; ?>
            <div class="row">
                <div class="col-1">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <!--循环输出大分类-->
                        <?php for ($category_i = 1; $category_i <= 10; $category_i++) {
                            $active_space = "";
                            $active_true = "false";
                            //如果有输入参数，切换大分类
                            if (isset($cate_id_get)) {
                                if ($cate_id_get == $category_i) {
                                    $active_space = " active";
                                    $active_true = "true";
                                }
                            } else {
                                if ($category_i == 1) {
                                    $active_space = " active";
                                    $active_true = "true";
                                }
                            }
                            ?>

                            <a class="nav-link index_nav<?php echo $active_space; ?>"
                               id="v-pills-<?php echo $category_i; ?>-tab"
                               data-toggle="pill" href="#v-pills-<?php echo $category_i; ?>"
                               role="tab" aria-controls="v-pills-<?php echo $category_i; ?>"
                               aria-selected="<?php echo $active_true; ?>"><?php echo $_SESSION['cate_all'][$category_i][$category_i]; ?></a>
                        <?php } ?>
                        <!--循环输出大分类-->
                    </div>
                </div>
                <div class="col-11">
                    <div class="tab-content" id="v-pills-tabContent">
                        <!--循环输出小分类-->
                        <?php for ($n_tab = 1; $n_tab <= 10; $n_tab++) {
                            //$n_tab 大分类id
                            $active_space_tab = "";
                            if (isset($cate_id_get)) {
                                if ($cate_id_get == $n_tab) {
                                    $active_space_tab = " show active";
                                }
                            } else {
                                if ($n_tab == 1) {
                                    $active_space_tab = " show active";
                                }
                            }
                            ?>
                            <div class="tab-pane fade<?php echo $active_space_tab; ?>"
                                 id="v-pills-<?php echo $n_tab; ?>" role="tabpanel"
                                 aria-labelledby="v-pills-<?php echo $n_tab; ?>-tab">
                                <!--循环输出小分类名称-->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <?php
                                        for ($categorysmall_i = $_SESSION['cate_all'][$n_tab][0]; $categorysmall_i <= $_SESSION['cate_all'][$n_tab][99]; $categorysmall_i++) {
                                            $active_space_tab_n = "";
                                            $active_true_tab = "false";
                                            if (isset($cate_small_id_get)) {
                                                if ($cate_small_id_get == $categorysmall_i) {
                                                    $active_space_tab_n = " active";
                                                    $active_true_tab = "true";
                                                }
                                            } else {
                                                if ($categorysmall_i == $_SESSION['cate_all'][$n_tab][0]) {
                                                    $active_space_tab_n = " active";
                                                    $active_true_tab = "true";
                                                }
                                            }
                                            ?>
                                            <a class="nav-item nav-link index_nav_tab<?php echo $active_space_tab_n; ?>"
                                               id="nav-<?php echo $categorysmall_i; ?>-tab"
                                               data-toggle="tab"
                                               href="#nav-<?php echo $categorysmall_i; ?>" role="tab"
                                               aria-controls="nav-<?php echo $categorysmall_i; ?>"
                                               aria-selected="<?php echo $active_true_tab; ?>"><?php echo $_SESSION['cate_all'][$n_tab][$categorysmall_i]; ?></a>
                                        <?php } ?>
                                    </div>
                                </nav>
                                <!--循环输出小分类名称-->
                                <!--循环输出小分类下的商品-->
                                <div class="tab-content" id="nav-tabContent">
                                    <?php
                                    for ($categorysmall_i = $_SESSION['cate_all'][$n_tab][0]; $categorysmall_i <= $_SESSION['cate_all'][$n_tab][99]; $categorysmall_i++) {
                                        $active_space_tab_n = "";
                                        if (isset($cate_small_id_get)) {
                                            if ($cate_small_id_get == $categorysmall_i) {
                                                $active_space_tab_n = " active show";
                                            }
                                        } else {
                                            if ($categorysmall_i == $_SESSION['cate_all'][$n_tab][0]) {
                                                $active_space_tab_n = " active show";
                                            }
                                        } ?>
                                        <div class="tab-pane fade<?php echo $active_space_tab_n; ?>"
                                             id="nav-<?php echo $categorysmall_i; ?>" role="tabpanel"
                                             aria-labelledby="nav-<?php echo $categorysmall_i; ?>-tab">
                                            <table class="table table-striped" data-toggle="table"
                                                   data-pagination="true">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">商品</th>
                                                    <th scope="col">单价</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $n_id = 1;
                                                $sql = "SELECT * FROM goods WHERE cate = $categorysmall_i;";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result == null) {
                                                    echo "数据库有问题" . $sql;
                                                }
                                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                                                    <tr>
                                                        <td><?php echo $n_id; ?></td>
                                                        <td>
                                                            <a href="<?php echo $url; ?>user/good_show.php?id=<?php echo $row['id']; ?>"><img
                                                                        src="<?php echo $row['img']; ?>"
                                                                        width='30px'
                                                                        height='auto'/> <?php echo $row['title']; ?>
                                                            </a></td>
                                                        <td>￥<?php echo $row['price']; ?></td>
                                                    </tr>
                                                    <?php $n_id++;
                                                } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!--循环输出小分类下的商品-->
                            </div>
                        <?php } ?>
                    </div>
                    <!--循环输出小分类-->
                </div>
            </div>
    </div>
    </main>
</div>
</div>
