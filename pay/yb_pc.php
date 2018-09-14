<?php include 'config.php';




$username = isset($_COOKIE['m_username'])?$_COOKIE['m_username']:$_POST['data'];
$version='1.0';
$customerid=$userid;
//$sdorderno=time()+mt_rand(1000,9999);
$sdorderno=date("YmdHis").rand(1000,9999);
$total_fee=$_POST['ccc'];
$pay = 10;
$addtime = date('Y-m-d H:i:s');
$sql="INSERT INTO `blypay_order` (`username`, `orderid`, `amout`, `addtime`, `state`, `bank`) VALUES ('{$username}', '{$sdorderno}', '{$total_fee}', '{$addtime}', '0', '{$pay}');";
$result = $db->query($sql);



//回调地址
$OrderNo=$sdorderno;
$amount=$total_fee*100;
$subject='会员充值';
$desc='会员充值';
$orderCreateTime=date('YmdHis');
$paymentModeCode=$_POST['paymentModeCode'];



$extra = urlencode(json_encode(Array('paymentModeCode'=>$paymentModeCode)));


$PostUrl="amount=".$amount."&appId=".$AppId."&callBackUrl=".$CallBackUrl."&channel=".$channel.'&'.'c'.'urrency='.$Currency."&desc=".$desc."&extra=".$extra."&orderNo=".$OrderNo."&orderTime=".$orderCreateTime."&subject=".$subject."&toAccountType=".$toAccountType;

$res = openssl_pkey_get_private($private_key);


$sign=rsaSign($PostUrl,$res);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支付处理页面</title>
</head>
<body>

<form action="http://47.92.118.177/api/wapPayApi/wapPay" method="post">
<input type="hidden" name="sign" value="<?=$sign?>" /><br/>
<input type="hidden" name="amount" value="<?=$amount?>" /><br/>
<input type="hidden" name="orderNo" value="<?=$OrderNo?>" /><br/>
<input type="hidden" name="desc" value="<?=$desc?>" /><br/>
<input type="hidden" name="appId" value="<?=$AppId?>" /><br/>
<input type="hidden" name="toAccountType" value="<?=$toAccountType?>" /><br/>
<input type="hidden" name="subject" value="<?=$subject?>" /><br/>
<input type="hidden" name="extra" value="<?=$extra?>" /><br/>
<input type="hidden" name="orderTime" value="<?=$orderCreateTime?>" /><br/>
<input type="hidden" name="channel" value="<?=$channel?>" /><br/>
<input type="hidden" name="currency" value="CNY" /><br/>
<input type="hidden" name="callBackUrl" value="<?=$CallBackUrl?>" />
</form>
</body>
<script>document.forms[0].submit();</script>
</html>