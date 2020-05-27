<template>
    <div class="bought">
        <h1 style="margin-bottom: 30px"><i class="el-icon-user-solid"/> 用户管理</h1>
        <el-form ref="form" :model="form">
            <el-input placeholder="请输入用户信息" v-model="form.searchBought" class="input-with-select">
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
                    prop="username"
                    label="用户名"
                    width="250">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="昵称">
            </el-table-column>
            <el-table-column
                    prop="email"
                    label="邮箱"
                    width="150">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="100">
                <template slot-scope="scope">
                    <el-button @click="handleClick(scope.row)" type="text" size="small">查看</el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
    export default {
        isSearched: false,
        boughtList: [],
        data(){
            return{
                form:{
                    searchBought:'',
                },
                tableData: [{
                    name: 'hjthjthjt',
                    username: 'hjthjthjt',
                    email:'i@jakting.com'
                }, {
                    name: '测试1',
                    username: 'test1',
                    email: '1@store.com'
                }, {
                    name: '测试2',
                    username: 'test2',
                    email: '2@store.com'
                }, {
                    name: '测试3',
                    username: 'test3',
                    email: '3@store.com'
                }, {
                    name: '测试4',
                    username: 'test4',
                    email: '4@store.com'
                }, {
                    name: '测试5',
                    username: 'test5',
                    email: '5@store.com'
                }, {
                    name: '测试6',
                    username: 'test6',
                    email: '6@store.com'
                }, {
                    name: '测试7',
                    username: 'test7',
                    email: '7@store.com'
                }, {
                    name: '测试8',
                    username: 'test8',
                    email: '8@store.com'
                }]
            }
        },
        methods:{
            onSearch(){

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
