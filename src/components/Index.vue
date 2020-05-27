<template>
    <div class="bought">
        <h1 style="margin-bottom: 30px"><i class="el-icon-s-goods"/> 欢迎光临</h1>
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
                    <el-button @click="handleClick(scope.row)" type="text" size="small">查看</el-button>
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
                    :total="rawList.length"
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
                tableData: [],
                currentPage1: 1,
                pageSize: 10,
                pageList: [],
                form: {
                    searchBought: '',
                },
            }
        },
        methods: {
            onSearch() {

            },
            handleSizeChange: function(pageSize) {
                this.pageSize = pageSize;
                this.handleCurrentChange(this.currentPage1);
            },
            handleCurrentChange: function(currentPage) {
                this.currentPage1 = currentPage;
                this.currentChangePage(this.rawList, currentPage);
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
