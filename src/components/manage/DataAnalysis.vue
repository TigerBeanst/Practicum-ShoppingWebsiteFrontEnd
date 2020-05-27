<template>
    <div class="setting">
        <h1 style="margin-bottom: 30px"><i class="el-icon-s-tools"/> 数据分析</h1>
        <el-radio-group v-model="radio">
            <el-radio :label="3">品牌销售情况</el-radio>
            <el-radio :label="6">商户销售情况</el-radio>
            <el-radio :label="9">用户投诉情况</el-radio>
        </el-radio-group><br><br>
        <img src="/resource/img/bing.png"
             width="400px" height="auto" style="vertical-align: middle;margin-right: 20px"/>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                radio: 3,
                dialogFormVisible: false,
                form: {
                    username:'hjthjthjt',
                    date:'2020-05-24',
                    name: 'hjthjthjt',
                    email: 'i@jakting.com',
                    desc: '湖南省湘潭市雨湖区湖南科技大学'
                }
            }
        }
    }
</script>

<style scoped>
    .setting {
        margin: 120px auto;
        width: 60%;
    }
</style>
