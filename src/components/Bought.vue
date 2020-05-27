<template>
    <div class="bought">
        <h1 style="margin-bottom: 30px"><i class="el-icon-s-claim"/> 已买到的</h1>
        <el-form ref="form" :model="form">
            <el-input placeholder="请输入商品名称" v-model="form.searchBought" class="input-with-select">
                <el-button slot="append" icon="el-icon-search" @click="onSearch" native-type="submit"></el-button>
            </el-input>
        </el-form>
        <el-table
                :data="tableData"
                border
                style="width: 100%;margin-top: 20px">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    label="日期"
                    width="120">
                <template slot-scope="scope">
                    <i class="el-icon-time"></i>
                    <span style="margin-left: 10px">{{ scope.row.date }}</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="province"
                    label="商品">
                <template slot-scope="scope">
                    <img v-bind:src="scope.row.name" height="30px" width="auto" style="vertical-align:middle;"/>
                    <span style="margin-left: 10px;vertical-align:middle;">{{ scope.row.province }}</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="city"
                    label="价格"
                    width="80">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="100">
                <template slot-scope="scope">
                    <el-button @click="dialogVisible = true" type="text" size="small">查看</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-dialog
                title="投诉受理"
                :visible.sync="dialogVisible"
                width="30%"
                :before-close="handleClose">
            <el-table :data="gridData">
                <el-table-column type="index" label="#" width="50"></el-table-column>
                <el-table-column property="date" label="日期" width="100"></el-table-column>
                <el-table-column property="name" label="昵称" width="100"></el-table-column>
                <el-table-column property="address" label="内容"></el-table-column>
            </el-table>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        isSearched: false,
        boughtList: [],
        data() {
            return {
                textarea: '',
                dialogVisible: false,
                form: {
                    searchBought: '',
                },
                gridData: [{
                    date: '2020-05-25',
                    name: 'Test1',
                    address: 'XXX旗舰店发了劣质商品。'
                }, {
                    date: '2020-05-25',
                    name: 'Test2',
                    address: 'XXX旗舰店不肯退款。'
                }],
                tableData: [{
                    date: '2020-05-24',
                    name: 'https://img14.360buyimg.com/n0/jfs/t11416/73/2962554901/208879/1f7e2225/5cdd0dd9N84e2d9cc.jpg',
                    province: '一加 OnePlus 7 Pro 2K+90Hz 流体屏 骁龙855旗舰 4800万超广角三摄 12GB+256GB 星雾蓝 全面屏拍照游戏手机',
                    city: '4999.00'
                }, {
                    date: '2020-05-24',
                    name: 'https://img14.360buyimg.com/n0/jfs/t1/16130/39/12690/305219/5caac12aEbb843fa5/ce6c1dee969fb626.jpg',
                    province: '小米9 4800万超广角三摄 8GB+128GB全息幻彩蓝 骁龙855 全网通4G 双卡双待 水滴全面屏拍照游戏智能手机',
                    city: '3299.00'
                }, {
                    date: '2020-05-24',
                    name: 'https://img14.360buyimg.com/n0/jfs/t1/9361/14/15398/207313/5c6f6780Ea1cb0bde/75da0ed4988f27b2.jpg',
                    province: '诺基亚 NOKIA 9 PureView 6GB+128GB 宇宙蓝 蔡司认证 后置5摄 全网通 4G双卡双待',
                    city: '5499.00'
                }, {
                    date: '2020-05-24',
                    name: 'https://img14.360buyimg.com/n0/jfs/t1/16938/25/8833/287777/5c791914E6649059c/0e2f0c1d7e74ce0e.jpg',
                    province: 'vivo iQOO 6GB+128GB 电光蓝 全面屏智能拍照手机 骁龙855电竞游戏 全网通4G手机',
                    city: '2798.00'
                }, {
                    date: '2020-05-24',
                    name: 'https://img14.360buyimg.com/n0/jfs/t1/25813/29/12657/304911/5c98c8e2E6bcf7d2d/25342f237b56fe97.jpg',
                    province: '华为 HUAWEI P30 Pro 超感光徕卡四摄10倍混合变焦麒麟980芯片屏内指纹 8GB+128GB亮黑色全网通版双4G手机',
                    city: '5488.00'
                }, {
                    date: '2020-05-24',
                    name: 'https://img14.360buyimg.com/n0/jfs/t25648/16/263436507/98444/7399d046/5b6a9e4eN9138565c.jpg',
                    province: 'OPPO Find X冰珀蓝 8GB+256GB 全网通 移动联通电信全网通4G 双卡双待手机',
                    city: '5499.00'
                }, {
                    date: '2020-05-24',
                    name: 'https://img14.360buyimg.com/n0/jfs/t1/4460/2/3458/153299/5b997bf0Ed101778b/2361563781a99acb.jpg',
                    province: 'Apple iPhone XS Max (A2104) 64GB 金色 移动联通电信4G手机 双卡双待',
                    city: '7649.00'
                }, {
                    date: '2020-05-24',
                    name: 'http://img10.360buyimg.com/n1/s450x450_jfs/t1/34894/23/9310/176636/5ccfdc2cEdfb070f4/c6ed7e073c7dde0a.jpg',
                    province: '惠普（HP）暗影精灵4代 游戏台式电脑主机（九代i7-9700F 8G 256GSSD+1TB GTX1660Ti 6G独显 三年上门）',
                    city: '6899.00'
                }, {
                    date: '2020-05-24',
                    name: 'http://img11.360buyimg.com/n1/jfs/t1/28558/8/2454/70904/5c1c86b1Eeb02075f/851af70f09277a85.jpg',
                    province: '神舟(HASEE) K80-CP5 炫龙系列商用办公台式迷你主机(I3 8100 4G 120G) 黑色',
                    city: '3199.00'
                }, {
                    date: '2020-05-24',
                    name: 'http://img13.360buyimg.com/n1/s450x450_jfs/t1/51421/33/1853/219805/5cf91e18E735af719/f63b3ded33e84f53.jpg',
                    province: '雷柏（Rapoo） V500PRO单光版 机械键盘 有线键盘 游戏键盘 104键单光键盘 吃鸡键盘 黑色 红轴',
                    city: '159.00'
                }, {
                    date: '2020-05-24',
                    name: 'http://img13.360buyimg.com/n1/s450x450_jfs/t1/80598/27/1106/171717/5cf4a8a2E789ea12b/2385bfbb4bec0b49.jpg',
                    province: '宏碁(Acer)暗影骑士3英特尔酷睿i5游戏本 15.6英寸笔记本电脑AN5(8G 128G SSD+1T GTX1050 4G IPS 背光键盘)',
                    city: '4999.00'
                }, {
                    date: '2020-05-24',
                    name: 'http://img10.360buyimg.com/n1/s450x450_jfs/t1/20073/40/476/168058/5c0a197dE64b1546e/9eaeaf0366be07e0.jpg',
                    province: '小米（MI）小米机械手感游戏键盘  RGB炫彩背光|铝合金上盖|定制游戏轴体',
                    city: '229.00'
                }, {
                    date: '2020-05-24',
                    name: '王小虎',
                    province: '上海',
                    city: '普陀区'
                }]
            }
        },
        methods: {
            onSearch() {

            }
        }
    }
</script>

<style scoped>
    .bought {
        margin: 50px auto;
        width: 80%;
    }
</style>
