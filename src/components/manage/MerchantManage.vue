<template>
    <div class="bought">
        <h1 style="margin-bottom: 30px"><i class="el-icon-user-solid"/> 商户管理</h1>
        <el-form ref="form" :model="form">
            <el-input placeholder="请输入商户信息" v-model="form.searchBought" class="input-with-select">
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
                    label="商户名">
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
                    name: '一加 WHY官方旗舰店',
                    username: 'oneplus',
                    email:'why@oneplus.com'
                }, {
                    name: '小米 WHY官方旗舰店',
                    username: 'xiaomi',
                    email: 'why@xiaomi.com'
                }, {
                    name: 'OPPO WHY官方旗舰店',
                    username: 'oppo',
                    email: 'why@oppo.com'
                }, {
                    name: '神舟 WHY官方旗舰店',
                    username: 'hasee',
                    email: 'why@hasee.com'
                }, {
                    name: '诺基亚 WHY官方旗舰店',
                    username: 'nokia',
                    email: 'why@nokia.com'
                }, {
                    name: '魅族 WHY官方旗舰店',
                    username: 'meizu',
                    email: 'why@meizu.com'
                }, {
                    name: '华为 WHY官方旗舰店',
                    username: 'huawei',
                    email: '6@store.com'
                }, {
                    name: 'vivo WHY官方旗舰店',
                    username: 'vivo',
                    email: 'why@huawei.com'
                }, {
                    name: 'Apple WHY官方旗舰店',
                    username: 'apple',
                    email: 'why@apple.com'
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
