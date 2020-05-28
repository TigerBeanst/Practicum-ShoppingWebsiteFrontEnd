<template>
    <div class="bought">
        <h1 style="margin-bottom: 30px"><i class="el-icon-s-order"/> 商品管理 · {{shop_name}}</h1>
        <el-form ref="form" :model="form" @submit.native.prevent>
            <el-input placeholder="请输入商品名称" v-model="form.searchAll" class="input-with-select">
                <el-button slot="append" icon="el-icon-search" @click="onSearch" native-type="submit"/>
            </el-input>
        </el-form>
        <el-table
                :data="pageList"
                border
                style="width: 100%;margin-top: 20px">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    label="状态"
                    width="70">
                <template slot-scope="scope">
                    <span v-if="scope.row.sell_status==1" style="color: green"><i class="el-icon-success"/>上架</span>
                    <span style="color: red" v-else><i class="el-icon-error"/>下架</span>
                </template>
            </el-table-column>
            <el-table-column
                    label="商品">
                <template slot-scope="scope">
                    <img v-bind:src="scope.row.img" height="30px" width="auto" style="vertical-align:middle;"/>
                    <span style="margin-left: 10px;vertical-align:middle;">{{ scope.row.title }}</span>
                </template>
            </el-table-column>
            <el-table-column
                    label="价格"
                    width="100">
                <template slot-scope="scope">
                    <span style="margin-left: 10px;vertical-align:middle;">￥{{ scope.row.price }}</span>
                </template>
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="160">
                <template slot-scope="scope">
                    <el-button @click="jumpToGoodDetails(scope.row.id)" type="text" size="small">编辑</el-button>
                    <el-button @click="jumpToGoodDetails(scope.row.id)" type="text" size="small">统计</el-button>
                    <el-button @click="jumpToGoodDetails(scope.row.id)" type="text" size="small">上架</el-button>
                    <el-button @click="jumpToGoodDetails(scope.row.id)" type="text" size="small">下架</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="block">
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage1"
                    :page-sizes="[10, 20, 30, 40]"
                    :page-size="10"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="tableData.length"
            />
        </div>
    </div>
</template>

<script>
    export default {
        isSearched: false,
        boughtList: [],
        data() {
            return {
                shop_name:'',
                form: {
                    searchAll: '',
                },
                tableData: [],
                currentPage1: 1,
                pageSize: 10,
                pageList: [],

            }
        },
        mounted() {
            this.$axios.get("/api/merchant/manage/getGoodsMerchantList.php",{
                params:{
                    username: localStorage.getItem("username")
                }
            })
                .then(res => {
                    if (res.data['getList_status'] == 1) {
                        //成功
                        //console.log(res.data);
                        var table = [];
                        var i = {};
                        for (i in res.data) {
                            table[i] = res.data[i];
                        }
                        this.tableData = table
                        console.log(table)
                        this.shop_name = res.data['getList_shop'];
                        this.currentChangePage(this.tableData, 1);
                    } else {
                        this.$message.error("未知错误");
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        methods: {
            onSearch() {
                this.$axios.get("/api/merchant/manage/getGoodsMerchantList.php", {
                    params: {
                        query: this.form.searchAll,
                        username: localStorage.getItem("username")
                    }
                })
                    .then(res => {
                        if (res.data['getList_status'] == 1) {
                            //成功
                            //console.log(res.data);
                            var table = [];
                            var i = {};
                            for (i in res.data) {
                                table[i] = res.data[i];
                            }
                            this.tableData = table
                            this.$message.success("找到"+table.length+"件商品");
                            this.currentChangePage(this.tableData, 1);
                        } else {
                            this.$message.error("未知错误");
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            jumpToGoodDetails(id) {
                this.$router.push('/good/' + id)
            },
            handleSizeChange: function (pageSize) {
                this.pageSize = pageSize;
                this.handleCurrentChange(this.currentPage1);
            },
            handleCurrentChange: function (currentPage) {
                this.currentPage1 = currentPage;
                this.currentChangePage(this.tableData, currentPage);
            },
            currentChangePage(list, currentPage) {
                let from = (currentPage - 1) * this.pageSize;
                let to = currentPage * this.pageSize;
                this.pageList = [];
                for (; from < to; from++) {
                    if (list[from]) {
                        this.pageList.push(list[from]);
                    }
                }
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
