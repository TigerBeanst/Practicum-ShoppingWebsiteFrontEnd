<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $store_title = "首页 - WHY网上购物商城";
        $this->assign("store_title",$store_title);
        return $this->fetch();
    }
}
