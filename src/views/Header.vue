<template>
    <el-container>
        <el-header class="header">
            <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect"
                     :router=true>
                <el-menu-item><i class="el-icon-s-goods"/>WHY网上购物商城</el-menu-item>
                <el-menu-item index="/">首页</el-menu-item>
                <el-menu-item index="/manage/goods" v-if="identity==3 || identity==2">商品管理</el-menu-item>
                <el-menu-item index="/manage/users" v-if="identity==3">用户管理</el-menu-item>
                <el-menu-item index="/manage/merchants" v-if="identity==3">商户管理</el-menu-item>
                <el-menu-item v-if="login_status" style="float: right" v-on:click="logout">注销</el-menu-item>
                <el-submenu v-if="login_status" style="float: right" index="">
                    <template slot="title">{{name}}</template>
                    <el-menu-item index="/merchant/talking" v-if="identity==2"><i class="el-icon-s-custom"/>在线客服</el-menu-item>
                    <el-menu-item index="/manage/goods" v-if="identity==2"><i class="el-icon-s-order"/>商品管理</el-menu-item>
                    <el-menu-item index="/bought" v-if="identity==1"><i class="el-icon-s-claim"/>已买到的</el-menu-item>
                    <el-menu-item index="/setting" v-if="identity==1||identity==3"><i class="el-icon-s-tools"/>资料设置</el-menu-item>
                    <el-menu-item index="/setting" v-if="identity==2"><i class="el-icon-s-tools"/>商户资料设置</el-menu-item>
                </el-submenu>
                <el-menu-item v-if="login_status" style="float: right" @click="drawer = true"><i
                        class="el-icon-shopping-cart-full"/></el-menu-item>
                <el-menu-item v-if="!login_status" index="/register" style="float: right">注册</el-menu-item>
                <el-menu-item v-if="!login_status" index="/login" style="float: right">登录</el-menu-item>
            </el-menu>
            <div class="line"></div>
        </el-header>
        <transition name="slide-fade">
            <router-view/>
        </transition>
        <!--对话框 start-->
        <el-dialog title="购物车结算" :visible.sync="dialogTableVisible">
            <el-table
                    :data="shoppingCartList"
                    stripe
                    style="width: 100%;">
                <el-table-column
                        type="index"
                        width="50">
                </el-table-column>
                <el-table-column
                        prop="title"
                        label="商品">
                    <template slot-scope="scope">
                        <img v-bind:src="scope.row.img" height="30px" width="auto" style="vertical-align:middle;"/>
                        <span style="margin-left: 10px;vertical-align:middle;">{{ scope.row.title }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        width="130"
                        label="价格">
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">￥{{ scope.row.price }}</span>
                    </template>
                </el-table-column>
            </el-table>
            <el-input style="margin-top: 10px" v-model="input" placeholder="请输入优惠券"></el-input>
            <div class="show_price">
                <p>共 {{shopping_total_count}} 件，需支付 ￥{{shopping_total}} 元</p>
            </div>
            <el-dialog
                    width="30%"
                    title="支付方式"
                    :visible.sync="innerVisible"
                    append-to-body>

                <img @click="openPayLoading('微信支付')" v-loading.fullscreen.lock="fullscreenLoading"
                     src="/resource/img/wechat_pay.png"
                     width="150px" height="auto" style="vertical-align: middle;margin-right: 20px"/>
                <img @click="openPayLoading('支付宝支付')" v-loading.fullscreen.lock="fullscreenLoading"
                     src="/resource/img/alipay.png" style="vertical-align: middle;margin-right: 20px"/>
                <img @click="openPayLoading('MasterCard支付')"
                     v-loading.fullscreen.lock="fullscreenLoading" src="/resource/img/Mastercard.png" width="80px"
                     height="auto"
                     style="vertical-align: middle;margin-right: 20px"/>
                <img @click="openPayLoading('Visa支付')" v-loading.fullscreen.lock="fullscreenLoading"
                     src="/resource/img/visa.png" width="80px" height="auto"
                     style="vertical-align: middle;margin-right: 10px"/>

            </el-dialog>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogTableVisible = false">取 消</el-button>
                <el-button type="primary" @click="innerVisible = true">确 定</el-button>
            </span>
        </el-dialog>
        <!--对话框 end-->
        <!--抽屉 start-->
        <el-drawer
                title="购物车"
                size="35%"
                :visible.sync="drawer"
                :direction="direction"
                :before-close="drawerClose">
            <el-table
                    :data="shoppingCartList"
                    stripe
                    style="width: 100%;margin:0 5px;position: absolute;  ">
                <el-table-column
                        type="index"
                        width="50">
                </el-table-column>
                <el-table-column
                        prop="title"
                        label="商品"
                        width="420">
                    <template slot-scope="scope">
                        <img v-bind:src="scope.row.img" height="30px" width="auto" style="vertical-align:middle;"/>
                        <span style="margin-left: 10px;vertical-align:middle;">{{ scope.row.title }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        width="130"
                        label="价格">
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">￥{{ scope.row.price }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        label="操作"
                        width="50">
                    <template slot-scope="scope">
                        <el-button
                                @click.native.prevent="deleteRow(scope.$index, tableData)"
                                type="text"
                                size="small">
                            移除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-button style="bottom: 20px; position: fixed;" type="success" v-on:click="payForCart">结 算</el-button>
        </el-drawer>
        <!--抽屉 end-->
    </el-container>
</template>

<script>

    export default {
        name: "Header",
        data() {
            return {
                input:'',
                activeIndex: 'index',
                login_status: localStorage['login_status'],
                username: localStorage['username'],
                name: localStorage['name'],
                identity: localStorage['identity'],
                drawer: false,
                dialogTableVisible: false,
                innerVisible: false,
                fullscreenLoading: false,
                direction: "rtl",
                shoppingCartList: JSON.parse(localStorage.getItem('shoppingCart')),
                shopping_total: localStorage.getItem('total_price'),
                shopping_total_count: localStorage.getItem('total_goods'),
            };
        },
        created() {
            window.addEventListener('setItem', () => {
                this.login_status = localStorage.getItem('login_status');
                this.username = localStorage.getItem('username');
                this.name = localStorage.getItem('name');
                this.identity = localStorage.getItem('identity');
                this.activeIndex = 'index';
                this.shoppingCartList = JSON.parse(localStorage.getItem('shoppingCart'));
                console.log(localStorage.getItem('shoppingCart'))
                this.shopping_total = localStorage.getItem('total_price');
                this.shopping_total_count = localStorage.getItem('total_goods');
            })
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            logout() {
                localStorage.clear();
                this.login_status = false;
                this.$message("注销成功！")
            },
            drawerClose() {
                this.drawer = false
            },
            deleteRow(index, rows) {
                this.shoppingCartList.splice(index, 1);
                this.resetSetItem("shoppingCart", JSON.stringify(this.shoppingCartList))
            },
            payForCart() {
                this.drawer = false;
                this.dialogTableVisible = true;
            },
            openPayLoading(payway) {
                this.fullscreenLoading = true;
                this.$axios.get("/api/user/bought/setBought.php", {
                    params: {
                        username: this.username,
                        shoppingCart: JSON.stringify(this.shoppingCartList)
                    }
                })
                    .then(res => {
                        console.log(res)
                        if (res.data['get_good_status'] == 1) {
                        } else if (res.data['get_good_status'] == -1) {
                            this.$message.error('获取失败');
                        } else {
                            this.$message.error('未知错误！');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                setTimeout(() => {
                    this.fullscreenLoading = false;
                    this.innerVisible = false;
                    this.dialogTableVisible = false;
                    this.$message.success("您使用 " + payway + " 成功支付 " + this.shopping_total + " 元。")
                }, 2000);
            },
        }
    }
</script>

<style>
    .show_price {
        float: right;
        margin-right: 30px;
        margin-top: 10px;
        font-size: 18px;
    }

    .centerr {
        vertical-align: middle;
    }

    .slide-fade {
        position: absolute;
        left: 0;
        right: 0;
    }

    .slide-fade-enter-active {
        transition: all 1.2s ease;
    }

    .slide-fade-leave-active {

        transition: all .1s cubic-bezier(2.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter, .slide-fade-leave-to {
        left: 0;
        right: 0;
        transform: translateX(50px);
        opacity: 0;
    }
</style>
<style>
    :focus {

        outline: 0;
    }
</style>
