<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支付请求处理</title>
<script src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.qrcode.js"></script>
<script type="text/javascript" src="qrcode.js"></script>
</head>
<body>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
$url = "https://www.aw5880.cn/pay/action";
$token = "303a312a793617873711e3fd4b500405";

$post["uid"] = "53439621257";
$post["price"] = $_REQUEST["ccc"];
$post["istype"] = $_REQUEST["istype"];
$post["notify_url"] = "http://{$_SERVER['HTTP_HOST']}/callback.php";
$post["return_url"] = "http://{$_SERVER['HTTP_HOST']}/ok.php";
$post["orderid"] = time()+mt_rand(1000,9999);
$post["orderuid"] = isset($_COOKIE['m_username'])?$_COOKIE['m_username']:$_POST['data'];
$post["goodsname"] = '在线充值';
$post["key"] = md5($post["goodsname"] . $post["istype"] . $post["notify_url"] . $post["orderid"] . $post["orderuid"] . $post["price"] . $post["return_url"] . $token . $post["uid"]);  
// md5(goodsname + istype + notify_url + orderid + orderuid + price + return_url + token + uid);



$addtime = date('Y-m-d H:i:s');
$sql="INSERT INTO `blypay_order` (`username`, `orderid`, `amout`, `addtime`, `state`, `bank`) VALUES ('{$username}', '{$sdorderno}', '{$total_fee}', '{$addtime}', '0', '{$pay}');";
$result = $db->query($sql);


$return = phpPost($url, $post);
$info = json_decode($return, true);


if($info["code"] != 200){
    echo ('<script>alert("' . $info['msg'] . '");//window.history.go(-1);</script>');
}


function phpPost($url, $post_data=array(), $timeout=5,$header=""){
    $header=empty($header)?defaultHeader():$header;
    $post_string = http_build_query($post_data);
    $header.="Content-length: ".strlen($post_string);
    $opts = array(
        'http'=>array(
            'protocol_version'=>'1.0',//http协议版本(若不指定php5.2系默认为http1.0)
            'method'=>"POST",//获取方式
            'timeout' => $timeout ,//超时时间
            'header'=> $header,
            'content'=> $post_string)
        );
    $context = stream_context_create($opts);
    return  @file_get_contents($url,false,$context);
}
//默认模拟的header头
function defaultHeader(){
        $header="User-Agent:Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12\r\n";
        $header.="Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n";
        $header.="Accept-language: zh-cn,zh;q=0.5\r\n";
        $header.="Accept-Charset: GB2312,utf-8;q=0.7,*;q=0.7\r\n";
        return $header;
}

if($post["istype"] == "20001"){
    echo "微信支付<br>";
}elseif($post["istype"] == "10001"){
    echo "支付宝支付<br>";
}

?>

<b style="color:red;">订单号：<?php echo $info["orderid"]; ?></b> <br />
收单平台订单号：<?php echo $info["ordno"]; ?> <br />
充值金额：<?php echo $info["data"]["price"]; ?> <br />
<!--<b style="color:red;">实际支付金额：<?php echo $info["data"]["realprice"]; ?></b> <br />-->

<?php  
if(isset($info["data"]["qrcode"]) and $info["data"]["qrcode"]){
?>
支付二维码：<br />
<div id="qrcodeCanvas"></div>
<img  id="show_qrcode" src="https://pan.baidu.com/share/qrcode?w=410&h=410&url=<?php echo $info["data"]["qrcode"]; ?>" width="410" height="410" style="display: block;"/>
</div>
<div style="margin-top:5em;">
<a href='/member/'>返回首页 </a>
</div>

<script>
	jQuery('#qrcodeCanvas').qrcode({
		text	: "<?php echo $info["data"]["qrcode"]; ?>",
        width:350,
        height:350
    });
    
    function showalert(){
        $.get("check.php?ordno="+<?php echo $info["orderid"]; ?>,function(data){
            console.log(data);
            if(data == "1"){                
                $("#qrcodeCanvas").html("<b style='color:red;font-size:7em'>支付成功</b>");
                alert("支付成功");
				 window.setTimeout(function(){
					 window.location.href="/member/"; 
				 },3000);
            }else{
                window.setTimeout(showalert, 3000); 
            }
        });
    }

    window.setTimeout(showalert, 3000);     
</script>

<?php
}else{
?>

<!--跳转支付地址：<a href="<?php echo $info["data"]["redirect_uri"]; ?>"><?php echo $info["data"]["redirect_uri"]; ?></a>-->
<br /><br /><br />

<?php
}
?>

</body>
</html>

<!--

<?php echo "<pre>"; print_r(get_defined_vars()); echo "</pre>"; ?>


-->