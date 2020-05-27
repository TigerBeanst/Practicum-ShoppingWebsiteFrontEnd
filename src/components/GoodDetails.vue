<template>
    <div class="good_details">
        <el-row class="good_info">
            <el-col :span="8">
                <el-image :src="good_img" fit="contain" class="good_img" lazy/>
            </el-col>
            <el-col :span="16">
                <div class="grid-content good_title">{{good_title}}</div>
                <div class="grid-content good_shortdetail">{{good_title}}</div>
                <div class="grid-content good_price">
                    价格
                    <el-divider/>
                    <p class="good_price_money">￥{{good_price}}</p>
                </div>
                <el-popconfirm @onConfirm="addToShoppingCart"
                               confirmButtonText='好的'
                               cancelButtonText='不用了'
                               icon="el-icon-info"
                               iconColor="blue"
                               title="确定加入购物车？"
                               style="vertical-align:middle">
                    <el-button slot="reference" type="info" icon="el-icon-shopping-cart-2" class="good_add_cart">加入购物车
                    </el-button>
                </el-popconfirm>
                <el-button style="margin-top: 10px;vertical-align:middle;float: right;padding: 5px 20px;"><img
                        :src="shop_logo" class="shop_img"
                        style="vertical-align:middle;"/><span
                        style="vertical-align:middle;margin-left: 5px">{{shop_name}}</span></el-button>
            </el-col>
        </el-row>
        <div class="good_detail_all">
            <el-breadcrumb class="breadF" separator="/">
                <el-breadcrumb-item class="bread">{{good_cate}}</el-breadcrumb-item>
                <el-breadcrumb-item class="bread">{{good_cate_s}}</el-breadcrumb-item>
                <el-breadcrumb-item class="bread">商品详情</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="good_d">
                <span v-html="good_details"/>
            </div>
        </div>
        <el-backtop :bottom="50"/>
    </div>

</template>

<script>
    export default {
        name: "GoodDetails",
        data() {
            return {
                id: 0,
                good_title: '',
                good_shortdetail: '',
                good_price: 0.00,
                good_img: '',
                good_cate: '',
                good_cate_s: '',
                good_details: '',
                shop_name: '',
                shop_logo: '',
                shop_id: 0,
            }
        },
        methods: {
            addToShoppingCart() {
                if (localStorage.getItem('login_status') == 'true') {
                    var cartJSON = [];
                    const shopping_cart = localStorage.getItem("shoppingCart");
                    const newItem = {"title": this.good_title, "img": this.good_img, "price": this.good_price,"id":this.good_id};
                    console.log(newItem);
                    if (shopping_cart != null) {
                        console.log("购物车里有东西");
                        cartJSON = JSON.parse(shopping_cart);
                        cartJSON.push(newItem);
                        this.resetSetItem('total_price', parseFloat(localStorage.getItem('total_price')) + this.good_price)
                        this.resetSetItem('total_goods', parseInt(localStorage.getItem('total_goods')) + 1)
                    } else {
                        console.log("购物车里没有东西");
                        cartJSON.push(newItem);
                        this.resetSetItem('total_price', this.good_price)
                        this.resetSetItem('total_goods', 1)
                    }
                    this.resetSetItem("shoppingCart", JSON.stringify(cartJSON))
                    this.$message.success("已将该商品加入购物车！");
                } else {
                    this.$message.error("请先登录！")
                }
            }
        },
        created() {
            this.$axios.get("/api/good/getGoodDetails.php", {
                params: {
                    id: this.$route.params.id
                }
            })
                .then(res => {
                    console.log(res)
                    if (res.data['get_good_status'] == 1) {
                        this.good_id = res.data[0]['id'];
                        this.good_title = res.data[0]['title'];
                        this.good_shortdetail = res.data[0]['short_details'];
                        this.good_price = parseFloat(res.data[0]['price']);
                        this.good_img = res.data[0]['img'];
                        this.good_cate = res.data[0]['cname'];
                        this.good_cate_s = res.data[0]['sname'];
                        this.good_details = res.data[0]['details'];
                        this.shop_name = res.data[0]['shop_name'];
                        this.shop_id = res.data[0]['shopid'];
                        this.shop_logo = res.data[0]['logo_img'];
                    } else if (res.data['get_good_status'] == -1) {
                        this.$message.error('获取失败');
                    } else {
                        this.$message.error('未知错误！');
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
</script>

<style scoped>
    .good_details, .good_detail_all {
        margin: 30px auto;
        width: 80%;
    }

    .good_info {
        height: 300px;
        text-align: left;
    }

    .good_img {
        height: 300px;
        width: auto;
    }

    .shop_img {
        height: 30px;
    }

    .good_title {
        margin-top: 10px;
        font-size: 1.25rem;
        font-weight: 600;
        line-height: 1.2;
    }

    .good_shortdetail {
        margin-top: 5px;
        font-size: 0.9rem;
        line-height: 1.2;
    }

    .good_price {
        margin-top: 10px;
        padding: 18px;
        background: #343a40;
        border-radius: 4px;
        min-height: 36px;
        color: #fff;
    }

    .good_price_money {
        font-weight: 600;
        font-size: 1.5rem;
    }

    .good_add_cart {
        margin-top: 10px;
    }

    .good_detail_all {
        margin-top: 30px;
    }

    .good_d {
        margin-top: 30px;
    }

    .bread {
        font-size: 16px;
    }

    .breadF {
        margin-left: 10px;
    }
</style>
