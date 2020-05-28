<template>
    <div class="setting">
        <h1 style="margin-bottom: 30px"><i class="el-icon-s-tools"/> 资料设置</h1>
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="用户名">
                <el-input v-model="form.username" disabled/>
            </el-form-item>
            <el-form-item label="注册时间">
                <el-input v-model="form.date" disabled/>
            </el-form-item>
            <el-form-item label="昵称">
                <el-input v-model="form.username"/>
            </el-form-item>
            <el-form-item label="邮箱">
                <el-input v-model="form.email"/>
            </el-form-item>
            <el-form-item label="收货地址">
                <el-input type="textarea" v-model="form.desc"/>
            </el-form-item>
            <el-form-item label="密码">
                <el-input show-password v-model="form.desc"/>
            </el-form-item>
            <el-form-item label="确认密码">
                <el-input show-password v-model="form.desc"/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">保存</el-button>
                <el-button type="info" @click="dialogFormVisible = true">申请成为商户</el-button>
            </el-form-item>
        </el-form>
        <el-dialog title="申请成为商户" :visible.sync="dialogFormVisible" style="width: 50%;margin: auto auto">
            <el-form :model="form">
                <el-form-item label="商户名称" :label-width="formLabelWidth" style="width: 50%">
                    <el-input v-model="form.name" autocomplete="off" ></el-input>
                </el-form-item>
                <el-form-item label="商户LOGO地址" :label-width="formLabelWidth" style="width: 100%">
                    <el-input v-model="form.name" autocomplete="off" ></el-input>
                </el-form-item>
                <el-form-item label="商户介绍" :label-width="formLabelWidth" style="width: 100%">
                    <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="请输入内容"
                            v-model="textarea">
                    </el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="dialogFormVisible = false">申 请</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        data(){
            return{
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
