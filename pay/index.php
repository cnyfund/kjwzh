<?php
header("Content-type: text/html; charset=utf-8");   

$channel = isset($_REQUEST['channel'])?$_REQUEST['channel']:'yb_pc';



if($channel=='qypay'){
		
	 
			header("Content-type:text/html;charset=utf-8");
			require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
			$username = isset($_COOKIE['m_username'])?$_COOKIE['m_username']:$_POST['data'];
			$total_fee=$_REQUEST['ccc'];
			$orderid=date("YmdHis").rand(1000,9999);
			$pay = 10;
			$addtime = date('Y-m-d H:i:s');
			$sql="INSERT INTO `blypay_order` (`username`, `orderid`, `amout`, `addtime`, `state`, `bank`) VALUES ('{$username}', '{$orderid}', '{$total_fee}', '{$addtime}', '0', '{$pay}');";
			$result = $db->query($sql);
			
			$shop_id=4046;         //商户ID，商户在千应官网申请到的商户ID
			$bank_Type=101;   //充值渠道，101表示支付宝快速到账通道
			$bank_payMoney=$total_fee;     //充值金额
			$orderid=$orderid;                  //商户的订单ID，【请根据实际情况修改】
			$callbackurl="http://".$_SERVER['SERVER_NAME']."/0/callback.php";        //商户的回掉地址，【请根据实际情况修改】
			$gofalse="http://".$_SERVER['SERVER_NAME']."/member/jincz.php";                    //订单二维码失效，需要重新创建订单时，跳到该页
			$gotrue="http://".$_SERVER['SERVER_NAME']."/member/my.php";                       //支付成功后，跳到此页面
			$key="ceb685c938544312b35c4190dc857a5e";                      //密钥
			$posturl='https://pay.qianyingnet.com/pay/';                   //千应api的post提交接口服务器地址
			
			$charset="utf-8";                                              //字符集编码方式
			$token=$username;                                                 //自定义传过来的值 千应平台会返回原值
			$parma='uid='.$shop_id.'&type='.$bank_Type.'&m='.$bank_payMoney.'&orderid='.$orderid.'&callbackurl='.$callbackurl;     //拼接$param字符串
			$parma_key=md5($parma . $key);                                 //md5加密
			$PostUrl=$posturl."?".$parma."&sign=".$parma_key."&gofalse=".$gofalse."&gotrue=".$gotrue."&charset=".$charset."&token=".$token;       //生成指定网址
			
			
			//跳转到指定网站
			if (isset($PostUrl)) 
			   { 
				   header("Location: $PostUrl"); 
				   exit;
			   }else{
				echo "<script type='text/javascript'>";
				echo "window.location.href='$PostUrl'";
				echo "</script>";	
			};
	 
	 
	exit; 
	 
	 
	
}


if($channel=='wxpay'){
		
	 
			header("Content-type:text/html;charset=utf-8");
			require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
			$username = isset($_COOKIE['m_username'])?$_COOKIE['m_username']:$_POST['data'];
			$total_fee=$_REQUEST['ccc'];
			$orderid=date("YmdHis").rand(1000,9999);
			$pay = 10;
			$addtime = date('Y-m-d H:i:s');
			$sql="INSERT INTO `blypay_order` (`username`, `orderid`, `amout`, `addtime`, `state`, `bank`) VALUES ('{$username}', '{$orderid}', '{$total_fee}', '{$addtime}', '0', '{$pay}');";
			$result = $db->query($sql);
			
			$shop_id=4046;         //商户ID，商户在千应官网申请到的商户ID
			$bank_Type=102;   //充值渠道，101表示支付宝快速到账通道
			$bank_payMoney=$total_fee;     //充值金额
			$orderid=$orderid;                  //商户的订单ID，【请根据实际情况修改】
			$callbackurl="http://".$_SERVER['SERVER_NAME']."/qypay/callback.php";        //商户的回掉地址，【请根据实际情况修改】
			$gofalse="http://".$_SERVER['SERVER_NAME']."/member/jincz.php";                    //订单二维码失效，需要重新创建订单时，跳到该页
			$gotrue="http://".$_SERVER['SERVER_NAME']."/member/my.php";                       //支付成功后，跳到此页面
			$key="b93ec6fb9e434f2fba114206cbfcd858";                      //密钥
			$posturl='http://pay.qianyingnet.com/pay/';                   //千应api的post提交接口服务器地址
			
			$charset="utf-8";                                              //字符集编码方式
			$token=$username;                                                 //自定义传过来的值 千应平台会返回原值
			$parma='uid='.$shop_id.'&type='.$bank_Type.'&m='.$bank_payMoney.'&orderid='.$orderid.'&callbackurl='.$callbackurl;     //拼接$param字符串
			$parma_key=md5($parma . $key);                                 //md5加密
			$PostUrl=$posturl."?".$parma."&sign=".$parma_key."&gofalse=".$gofalse."&gotrue=".$gotrue."&charset=".$charset."&token=".$token;       //生成指定网址
			
			
			//跳转到指定网站
			if (isset($PostUrl)) 
			   { 
				   header("Location: $PostUrl"); 
				   exit;
			   }else{
				echo "<script type='text/javascript'>";
				echo "window.location.href='$PostUrl'";
				echo "</script>";	
			};
	 
	 
	exit; 
	 
	 
	
}





//联动优势  应用场景ldys_kj 支付渠道编码ldys 
//易宝支付  应用场景yb_pc 支付渠道编码yb
if(!in_array($channel,array('ldys_kj','yb_pc'))){
	exit('支付接口不存在');
}
include $channel.'.html';


?>