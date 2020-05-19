<?php
session_start();
$domain = $_SERVER['HTTP_HOST'];
if ($domain == "store.com") {
    $url = "http://store.com/";
}else{
    $url = "http://tool.jakting.com/store/";
}
include "../db/database.config.php";

if(!isset($_SESSION['shopping_cart_all'])){
    $_SESSION['shopping_cart_all'] = 1;
    $_SESSION['shopping_cart_all_goods_price_all'] = 0;
}else{
    $_SESSION['shopping_cart_all']++;
}
$_SESSION['shopping_cart_goods_title'][$_SESSION['shopping_cart_all']] = $_POST["goods_title"];
$_SESSION['shopping_cart_goods_img'][$_SESSION['shopping_cart_all']] = $_POST["goods_img"];
$_SESSION['shopping_cart_goods_id'][$_SESSION['shopping_cart_all']] = $_POST["goods_id"];
$_SESSION['shopping_cart_goods_num'][$_SESSION['shopping_cart_all']] = $_POST["goods_num"];
$_SESSION['shopping_cart_goods_price'][$_SESSION['shopping_cart_all']] = $_POST["goods_price"];
/*$_SESSION['shopping_cart_goods_price_all'][$_SESSION['shopping_cart_all']] = intval($_POST["goods_num"])*intval($_POST["goods_price"]);*/
$_SESSION['shopping_cart_goods_price_all'][$_SESSION['shopping_cart_all']] = bcmul($_POST["goods_num"],$_POST["goods_price"],2);
$_SESSION['shopping_cart_all_goods_price_all'] += $_SESSION['shopping_cart_goods_price_all'][$_SESSION['shopping_cart_all']];

header("location: ../../user/shopping_cart.php");
