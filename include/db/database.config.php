<?php
/*
 * 数据库配置文件
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
//MySQL 路径
$mysql_url = "localhost";
//MySQL 用户
$mysql_user = "store";
//MySQL 密码
$mysql_pw = "123456";
//MySQL 数据库
$mysql_db = "store";
//连接 MySQL
$conn = mysqli_connect($mysql_url, $mysql_user, $mysql_pw) or die("数据库服务器连接错误" . mysqli_error());
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_select_db($conn, $mysql_db);
include "sql.php";
?>
