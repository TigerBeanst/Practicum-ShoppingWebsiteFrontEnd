<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_url = $_POST['url'];
    $data_id = substr($data_url, 20, -5);

    echo $data_url . "<br>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $data_url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = mb_convert_encoding($data, 'utf-8', 'GB2312');
    $data = str_replace("\r\n", '', $data); //清除换行符
    $data = str_replace("\n", '', $data); //清除换行符
    $data = str_replace("\t", '', $data); //清除制表符
//echo $data;
    /*
     * 京东价格接口 https://p.3.cn/prices/mgets?skuIds=
     */
    /*
     * 数码类 $re = '/<img.*?id="spec-img".*?data-origin="(.*?)".*?alt="(.*?)".*?>/';
     */

    //图书类
    $re = '/<img.*?data-img="1".*?width="350".*?height="350".*?src="(.*?)".*?alt="(.*?)".*?jqimg=".*?"\/>/';
    $str = $data;
    preg_match_all($re, $str, $arr, PREG_SET_ORDER, 0);
//print_r($arr[0]);
    var_dump($arr);
    //echo $arr[0][2] . "<br>";
    // echo "http:" . $arr[0][1] . "<br>";
    //$name = $arr[0][2];
    //$img = "http:" . $arr[0][1];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://p.3.cn/prices/mgets?skuIds=" . $data_id);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);
    $re = '/"p":"(.*?)"/';
    $str = $data;
    preg_match_all($re, $str, $arr, PREG_SET_ORDER, 0);
    echo $arr[0][1];
    $price = $arr[0][1];

    $shortdetails = "【填充短描述】" . $name;
    $details = "【填充长描述】" . $name;

}

?>
<form action="pc.php" method="POST">
    <input type="text" name="url">
    <button type="submit">提交</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /*
 * 分类
 */
    $addtime = time();
    $n = 1;
    $nn = 39;
    $owner = 1;
    $sql = "INSERT INTO goods (owner,cate,title,price,short_details,details,add_time,sell_status,img)" .
        "VALUES ($owner,$nn,'$name',$price,'$shortdetails','$details',$addtime,0,'$img');";
    echo $sql . "<br>";
    //echo $name."<br><br>".$price."<br><br>".$shortdetails."<br><br>".$details."<br><br>".$addtime."<br><br>".$img;

}
?>

<input id="demoInput" value="<?php echo $sql; ?>">
<br>
<button id="btn">点我复制</button>
<script>
    const btn = document.querySelector('#btn');
    btn.addEventListener('click', () => {
        const input = document.querySelector('#demoInput');
        input.select();
        if (document.execCommand('copy')) {
            document.execCommand('copy');
            console.log('复制成功');
        }
    })
</script>
