<template>
    <div class="setting">
        <h1 style="margin-bottom: 30px"><i class="el-icon-s-tools"/> 网站维护</h1>
        <el-table
                ref="singleTable"
                :data="tableData"
                highlight-current-row
                @current-change="handleCurrentChange"
                style="width: 100%">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    property="date"
                    label="日期"
                    width="120">
            </el-table-column>
            <el-table-column
                    property="name"
                    label="等级"
                    width="120">
            </el-table-column>
            <el-table-column
                    property="address"
                    label="详情">
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                tableData: [{
                    date: '2020-05-24',
                    name: '一般',
                    address: 'SQL 冗余过多，请消除表的重复所引起的数据冗余，磁盘文件级的操作。'
                }, {
                    date: '2020-05-24',
                    name: '警告',
                    address: '突发巨量访问，来自 218.75.230.0 网段。'
                }, {
                    date: '2020-05-24',
                    name: '严重',
                    address: '收到 CC 攻击，正在清洗并启动 Anti-CC 服务。'
                }, {
                    date: '2020-05-24',
                    name: '严重',
                    address: '收到 DDOS 攻击，正在提升防火墙等级。'
                }, {
                    date: '2020-05-24',
                    name: '一般',
                    address: '远程备份服务器发生故障，正在联系服务商。'
                }, {
                    date: '2020-05-24',
                    name: '警告',
                    address: '部分商户优惠券系统发生故障，正在等待修复。'
                }, {
                    date: '2020-05-24',
                    name: '一般',
                    address: '来自 360 的搜索引擎爬虫未按照 Robots.txt 文件索引，已禁止。'
                }, {
                    date: '2020-05-24',
                    name: '一般',
                    address: '湘潭地区 CDN 节点缓存出现问题，正在联系 CDN 服务商。'
                }]
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
