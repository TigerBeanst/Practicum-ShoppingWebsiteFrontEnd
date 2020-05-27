<template>
    <el-main class="reg">
        <el-card>
            <i class="el-icon-key reg_icon"/>
            <h2>注册</h2>
            <el-form ref="form" :model="form" novalidate="true">
                <el-form-item label="用户名">
                    <el-input type="text" v-model="form.username" required/>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input show-password v-model="form.password" required/>
                </el-form-item>
                <el-form-item label="确认密码">
                    <el-input show-password v-model="form.passwordAgain" required/>
                </el-form-item>
                <el-form-item label="邮箱">
                    <el-input type="email" v-model="form.email" required/>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">注册</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </el-main>
</template>

<script>
    import md5 from 'js-md5';

    export default {
        name: "Login",
        data() {
            return {
                form: {
                    username: '',
                    password: '',
                    passwordAgain: '',
                    email: ''
                }
            }
        },
        methods: {
            onSubmit() {
                if (this.form.username == "" || this.form.password == "" || this.form.passwordAgain == "" || this.form.email == "") {
                    this.$message.error("各项均不得为空！")
                } else {
                    if (this.form.password == this.form.passwordAgain) {
                        //确认密码成功
                        this.$axios.post("/api/user/register.php", {
                            username: this.form.username,
                            password: md5(this.form.password),
                            email: this.form.email
                        })
                            .then(res => {
                                if (res.data['reg_status'] == 1) {
                                    //登录成功
                                    this.$message.success('注册成功！欢迎您，' + this.form.username);
                                    localStorage.clear();
                                    this.resetSetItem('login_status', true);
                                    this.resetSetItem('username', this.form.username);
                                    this.$router.push('/index');
                                } else if (res.data['reg_status'] == -1) {
                                    this.$message.error('用户名已存在！请选择其它用户名。');
                                } else {
                                    console.log(res);
                                    this.$message.error('未知错误！');
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    } else {
                        //两次密码不一致
                        this.$message.error("两次密码不一致！")
                    }
                }
            }
        }
    }
</script>

<style scoped>
    .reg {
        margin: 100px auto 0 auto;
        width: 400px;
    }

    .reg_icon {
        font-size: 40px
    }
</style>
