<?php include 'config.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
//writelog($_GET,"callback");
$str =$_SERVER['REMOTE_ADDR'];
file_put_contents( "success.txt",$str."\n", FILE_APPEND);

$str =print_r($_REQUEST,true);
 file_put_contents( "success.txt",$str."\n", FILE_APPEND);

$pkeyid = openssl_get_publickey($public_key);
//$Url=urldecode($_SERVER['QUERY_STRING']);
$Yzsign=$_REQUEST['sign'];
$NewUrl="";
//$arr = explode("&", $Url);
$arr=$_REQUEST;
/*$arr=$_GET;
ksort($arr);*/

/*

foreach ($arr as $val )
{
	$arr = explode("=",$val);
	if($arr[0]!="sign" ){
		if($arr[0]!="customizeParam")
		{
		$NewUrl=$NewUrl.$val.'&';
		}
	}
}
$NewUrl=substr($NewUrl,0,strlen($NewUrl)-1);*/

//unset($arr['sign']);

//unset($arr['customizeParam']);

$NewUrl=http_build_query($arr);

$NewUrl="appCode={$arr['appCode']}&channelType={$arr['channelType']}&merchantOrderNo={$arr['merchantOrderNo']}&orderAmount={$arr['orderAmount']}&orderNo={$arr['orderNo']}&orderTime={$arr['orderTime']}&orderTitle={$arr['orderTitle']}&percentInDayDO={$arr['percentInDayDO']}&realAmount={$arr['realAmount']}&transactionResult={$arr['transactionResult']}";

//$NewUrl=substr($NewUrl,0,strlen($NewUrl)-1);
/*
$str ="NewUrl:".$NewUrl;
file_put_contents( "success.txt",$str."\n", FILE_APPEND);*/


//if(rsaVerify($NewUrl,$Yzsign,$pkeyid)){
	
if($arr['transactionResult']=='paid'){		
	
        $h_money = number_format($_REQUEST['orderAmount']/100, 2, ".", "");
        $orderid = $_REQUEST['merchantOrderNo'];
		
		$str ="订单号:".$orderid;
 		file_put_contents( "success.txt",$str."\n", FILE_APPEND);
		
        $sql = "select * from `blypay_order` where `orderid`='{$orderid}' and `state`='0' LIMIT 1";
        $rs = $db->get_one($sql);
		
		 $str =print_r($rs,true);
 		 file_put_contents( "success.txt",$str."\n", FILE_APPEND);
		
		
        if (!empty($rs)) {
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
            $sql .= "h_type = '在线充值', ";
            $sql .= "h_about = '{$h_reply}', ";
            $sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
            $sql .= "h_actIP = '" . $_SERVER["REMOTE_ADDR"] . "' ";
            $db->query($sql);
            $sql = "update `blypay_order` set state='1' where `orderid`='{$orderid}'  and `state`='0'";
            $db->query($sql);
			echo("success");
	 		exit;
			
        }
      echo("支付成功！");
	 		exit;
	 
	  
}else{
	
	if($arr['transactionResult']=='paying'){
		 $gotrue="http://".$_SERVER['SERVER_NAME']."/member/my.php"; 
		  header("Location: $gotrue"); 
          exit;
	}
	
	echo("支付失败!");
}
?>