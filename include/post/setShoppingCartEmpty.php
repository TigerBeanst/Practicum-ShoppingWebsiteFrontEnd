<?php
session_start();
unset($_SESSION['shopping_cart_all']);
header("location: ../../user/shopping_cart.php");
