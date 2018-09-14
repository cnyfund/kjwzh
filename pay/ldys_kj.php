<?php 

include 'config.php';
$channel="ldys_kj";
$username = isset($_COOKIE['m_username'])?$_COOKIE['m_username']:$_POST['data'];
$version='1.0';
$customerid=$userid;
$sdorderno=time()+mt_rand(1000,9999);
$total_fee=$_POST['ccc'];
$pay = 11;
$addtime = date('Y-m-d H:i:s');
$sql="INSERT INTO `blypay_order` (`username`, `orderid`, `amout`, `addtime`, `state`, `bank`) VALUES ('{$username}', '{$sdorderno}', '{$total_fee}', '{$addtime}', '0', '{$pay}');";
$result = $db->query($sql);

//回调地址
$OrderNo=$sdorderno;
$amount=$total_fee*100;
$subject='会员充值';
$desc='会员充值';
$orderCreateTime=date('YmdHis');

$cardType=$_POST['cardType'];
$bankCode=$_POST['bankCode'];
$bankCardNum=$_POST['bankCardNum'];
$bankCardPhone=$_POST['bankCardPhone'];
$cardUserName=$_POST['cardUserName'];
$idCardNum=$_POST['idCardNum'];



$extra = urlencode(json_encode(Array('cardType'=>$cardType,'bankCode'=>$bankCode,'bankCardNum'=>$bankCardNum,'bankCardPhone'=>$bankCardPhone,'cardUserName'=>$cardUserName,'idCardNum'=>$idCardNum)));


$PostUrl="amount=".$amount."&appId=".$AppId."&callBackUrl=".$CallBackUrl."&channel=".$channel.'&'.'c'.'urrency='.$Currency."&desc=".$desc."&extra=".$extra."&orderNo=".$OrderNo."&orderTime=".$orderCreateTime."&subject=".$subject."&toAccountType=".$toAccountType;
//$PostUrlNew="amount=".$amount."&appId=".$AppId."&callBackUrl=".$CallBackUrl."&channel=".$channel.'&'.'c'.'urrency='.$Currency."&desc=".$desc."&extra=".$extra."&orderNo=".$OrderNo."&orderTime=".$orderCreateTime."&subject=".$subject."&toAccountType=".$toAccountType;
$res = openssl_pkey_get_private($private_key);
$sign=rsaSign($PostUrl,$res);

//$data=HttpPost("http://47.92.118.177/api/apiPay/askApiPay",array('sign'=>$sign,'amount'=>$amount,'OrderNo'=>$OrderNo,'desc'=>$desc,'AppId'=>$AppId,'toAccountType'=>$toAccountType,'subject'=>$subject,'extra'=>$extra,'orderTime'=>$orderCreateTime,'channel'=>$channel,'currency'=>'CNY','callBackUrl'=>$CallBackUrl));
$Purl='sign='.urlencode($sign).'&amount='.$amount.'&OrderNo='.$OrderNo.'&desc='.$desc.'&AppId='.$AppId.'&toAccountType='.$toAccountType.'&subject='.$subject.'&extra='.urlencode($extra).'&orderTime='.$orderCreateTime.'&channel='.$channel.'&currency=CNY&callBackUrl='.$CallBackUrl;
$data=HttpPost("http://47.92.118.177/api/apiPay/askApiPay",$Purl);

$data = json_decode($data,true);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>支付处理页面</title>
</head>
<body>
<?php if($data['errMsg']){
	echo $data['errMsg'];
}else{
	$orderNo=$data['orderNo'];
?>
<form action="Pays.php" method="post">
<input type="hidden" name="sign" value="<?=$sign?>" /><br/>
<input type="hidden" name="orderNo" value="<?=$orderNo?>" /><br/>
<input type="hidden" name="cardType" value="<?=$cardType?>" /><br/>
<input type="hidden" name="bankCardNum" value="<?=$bankCardNum?>" /><br/>
<input type="hidden" name="bankCardPhone" value="<?=$bankCardPhone?>" /><br/>
<input type="hidden" name="cardUserName" value="<?=$cardUserName?>" />
<input type="hidden" name="idCardNum" value="<?=$idCardNum?>" />
验证码：<input type="text" name="verifyCode" value="" />

<input type="submit" value="提交" />
</form>
<?php }?>
</body>

</html>