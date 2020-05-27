import Vue from 'vue'
import VueRouter from 'vue-router'
import Header from "../views/Header";
import Index from "../components/Index";
import Login from "../components/Login";
import Register from "../components/Register";
import GoodDetails from "../components/GoodDetails";
import Bought from "../components/Bought";
import Setting from "../components/Setting";
import GoodManage from "../components/manage/GoodManage";
import UserManage from "../components/manage/UserManage";
import MerchantManage from "../components/manage/MerchantManage";
import DataAnalysis from "../components/manage/DataAnalysis";
import Maintain from "../components/manage/Maintain";

Vue.use(VueRouter);

  const routes = [
  {
    path: '/',
    component: Header,
    meta: {
      title: "首页"
    },
    children:[
      {
        path:'/',
        component:Index,
        meta: {
          title: "首页 - WHY网上购物商城"
        },
      },
      {
        path:'/login',
        component:Login,
        meta: {
          title: "登录 - WHY网上购物商城"
        },
      },
      {
        path:'/register',
        component:Register,
        meta: {
          title: "注册 - WHY网上购物商城"
        },
      },
      {
        path:'/setting',
        component:Setting,
        meta: {
          title: "资料设置 - WHY网上购物商城"
        },
      },
      {
        path:'/good',
        component:Index
      },
      {
        path:'/good/:id',
        component:GoodDetails
      },
      {
        path:'/bought',
        component:Bought,
        meta: {
          title: "已买到的 - WHY网上购物商城"
        },
      },
      {
        path:'/manage/goods',
        component:GoodManage,
        meta: {
          title: "商品管理 - WHY网上购物商城"
        },
      },
      {
        path:'/manage/users',
        component:UserManage,
        meta: {
          title: "用户管理 - WHY网上购物商城"
        },
      },
      {
        path:'/manage/merchants',
        component:MerchantManage,
        meta: {
          title: "已买到的 - WHY网上购物商城"
        },
      },
      {
        path:'/manage/data',
        component:DataAnalysis,
        meta: {
          title: "数据分析 - WHY网上购物商城"
        },
      },
      {
        path:'/manage/maintain',
        component:Maintain,
        meta: {
          title: "网站维护 - WHY网上购物商城"
        },
      }
    ]
  }
];

const router = new VueRouter({
  routes
});

export default router

router.beforeEach((to, from, next) => {
  /* 路由发生变化修改页面title */
  if (to.meta.title) {
    document.title = to.meta.title
  }
  next()
});
