<?php
function query($sql){
    /**
     * @desc 数据库查询
     * @param /查询语句sql/全局变量conn连接数据库
     * @return array
     */
    global $conn;
    $result = mysqli_query($conn, $sql);
    return $result;
}

function select($field, $from, $other = "")
{
    /**
     * @desc select语句封装
     * @param /查询字段field/来源字段from/可选的如order之类的[,other]
     * @demo "SELECT * FROM goods [ORDER BY add_time DESC limit 1];"
     * @return array
     */
    return query("SELECT $field FROM $from ".$other);
}

//function select($field, $from, $other = "")
//{
//    /**
//     * @desc select语句封装
//     * @param 查询字段 $field，来源字段 $from，可选的如order之类的[,$other]
//     * @demo "SELECT * FROM goods [ORDER BY add_time DESC limit 1];"
//     * @return array
//     */
//    return "SELECT $field FROM $from $other";
//}
