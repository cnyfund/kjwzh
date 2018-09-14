<?php include 'config.php';?>
<?php
$pkeyid = openssl_get_publickey($public_key);
$Url=urldecode($_SERVER['QUERY_STRING']);
$Yzsign=$_GET['sign'];
$NewUrl="";
$arr = explode("&", $Url);
sort($arr);
foreach ($arr as $val )
{
	if(explode("=",$val)[0]!="sign" ){
		if(explode("=",$val)[0]!="customizeParam")
		{
		$NewUrl=$NewUrl.$val.'&';
		}
	}
}
$NewUrl=substr($NewUrl,0,strlen($NewUrl)-1);

if(rsaVerify($NewUrl,$Yzsign,$pkeyid)){
        $h_money = number_format($_GET['orderAmount']/100, 2, ".", "");
        $orderid = $_GET['orderNo'];
        $sql = "select * from `blypay_order` where `orderid`='" . $orderid . "'  and `amout`='" . $h_money . "' and `state`='0' LIMIT 1";
        $rs = $db->get_one($sql);
        if ($rs) {
            $h_bank = $rs["bank"];
            $h_userName = $rs["username"];
            $sql = "insert into h_recharge (h_userName,h_money,h_bank,h_addTime,h_state,h_actIP,h_isReturn) values ('" . $h_userName . "','" . $h_money . "','" . $h_bank . "','" . date('Y-m-d H:i:s') . "','1','" . $_SERVER["REMOTE_ADDR"] . "','1')";
            $result = $db->query($sql);
            if ($result) {
            }
            $sql = "update `h_member` set ";
            $sql .= "h_point2 = h_point2 + {$h_money} ";
            $sql .= "where h_userName = '" . $h_userName . "' ";
            $db->query($sql);
            $h_reply = "在线支付";
            $sql = "insert into `h_log_point2` set ";
            $sql .= "h_userName = '" . $h_userName . "', ";
            $sql .= "h_price = '" . $h_money . "', ";
            $sql .= "h_type = '充值', ";
            $sql .= "h_about = '{$h_reply}', ";
            $sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
            $sql .= "h_actIP = '" . $_SERVER["REMOTE_ADDR"] . "' ";
            $db->query($sql);
            $sql = "update `blypay_order` set state='1' where `orderid`='" . $orderid . "'  and `amout`='" . $h_money . "' and `state`='0'";
            $db->query($sql);
        } else {
        }
        echo "充值成功<br />订单号：" . $out_trade_no . "<br />金额:" . $money . "元";
		exit('<script type="text/javascript" language="javascript">
 window.setTimeout(function(){
	 window.location.href="/member/"; 
 },3000);
</script> '); 
}else{
echo("支付失败!");
}
?>