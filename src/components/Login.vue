<template>
    <el-main class="login">
        <el-card>
            <i class="el-icon-position login_icon"/>
            <h2>登录</h2>
            <el-form ref="form" :model="form" @submit.native.prevent>
                <el-form-item label="用户名">
                    <el-input type="text" v-model="form.username" required/>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input show-password v-model="form.password" required/>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit" native-type="submit">登录</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </el-main>
</template>

<script>
    import Index from "../views/Header";
    import md5 from 'js-md5';
    export default {
        name: "Login",
        data() {
            return {
                form: {
                    username: '',
                    password: '',
                }
            }
        },
        methods: {
            onSubmit() {
                this.$axios.post("/api/user/login.php", {
                    username: this.form.username,
                    password: md5(this.form.password)
                })
                    .then(res=> {
                        if (res.data['login_status'] == 1) {
                            //登录成功
                            this.$message.success('欢迎回来，'+res.data['name']);
                            localStorage.clear();
                            this.resetSetItem('login_status',true);
                            this.resetSetItem('username',res.data['username']);
                            this.resetSetItem('name',res.data['name']);
                            this.resetSetItem('identity',res.data['status']);
                            this.$router.push('/');
                        } else if(res.data['login_status'] == -1) {
                            this.$message.error('用户名或密码错误，请重试！');
                        }else{
                            this.$message.error('未知错误！');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>
    .login {
        margin: 200px auto 0 auto;
        width: 400px;
    }
    .login_icon{
        font-size:40px
    }
</style>
