<?php

$data = "00030000-0012d000 (0.98 MB) Reserved, READONLY, Private
001d0000-002b0000 (896 KB) Reserved, READONLY, Private
00325000-003e0000 (748 KB) Reserved, READONLY, Mapped
003e3000-003e8000 (20.0 KB) Reserved, READONLY, Mapped
005f3000-00600000 (52.0 KB) Reserved, READONLY, Private
0066f000-01200000 (11.5 MB) Reserved, READONLY, Mapped
01303000-01310000 (52.0 KB) Reserved, READONLY, Private
7f6f5000-7f7f0000 (0.98 MB) Reserved, READONLY, Mapped
7ffe1000-7fff0000 (60.0 KB) Reserved, NOACCESS, Private";

$re = '/(.*?) \((.*?)\) (.*?), (.*?), (.*?)\n/';
$str = $data;
preg_match_all($re, $str, $arr, PREG_SET_ORDER, 0);
//print_r($arr[0]);
/*echo '<pre>';
var_dump($arr);
echo '</pre>';*/


?>
<style type="text/css">
	.table{
		    text-align: center;
    		border-width: 0 1px 1px 0;
    		box-sizing: border-box;
   			border-collapse: collapse;
    		border-width: 1px 0 0 1px;
	}
	.table td{
		    padding: 6px 8px;
	}
</style>
<table class="table" border="1">
 <tbody>
  <tr>
   <td>地址</td>
   <td>大小</td>
   <td>虚拟地址<br>空间类型</td>
   <td>访问权限</td>
   <td>描述</td>
  </tr>
  <?php for($i=0;$i<count($arr);$i++){ ?>
  <tr>
   <td><?php echo $arr[$i][1];?></td>
   <td><?php echo $arr[$i][2];?></td>
   <td><?php echo $arr[$i][3];?></td>
   <td><?php echo $arr[$i][4];?></td>
   <td><?php echo $arr[$i][5];?></td>
  </tr>
<?php }?>
 </tbody>
</table>
