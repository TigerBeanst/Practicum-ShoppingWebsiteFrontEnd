<?php
session_start();
$delete_id = $_GET['id'];
$_SESSION['shopping_cart_all_goods_price_all'] -= $_SESSION['shopping_cart_goods_price_all'][$delete_id];
for ($n = $delete_id; $n <= $_SESSION['shopping_cart_all']; $n++) {
    $_SESSION['shopping_cart_goods_img'][$n] = $_SESSION['shopping_cart_goods_img'][$n + 1];
    $_SESSION['shopping_cart_goods_title'][$n] = $_SESSION['shopping_cart_goods_title'][$n + 1];
    $_SESSION['shopping_cart_goods_price'][$n] = $_SESSION['shopping_cart_goods_price'][$n + 1];
    $_SESSION['shopping_cart_goods_num'][$n] = $_SESSION['shopping_cart_goods_num'][$n + 1];
    $_SESSION['shopping_cart_goods_price_all'][$n] = $_SESSION['shopping_cart_goods_price_all'][$n + 1];
}
$_SESSION['shopping_cart_all']--;
header("location: ../../user/shopping_cart.php");