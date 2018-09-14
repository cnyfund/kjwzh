<?php
 header("Content-type:text/html;charset=utf-8");
  require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
$username = isset($_COOKIE['m_username'])?$_COOKIE['m_username']:$_GET['data'];
$total_fee=$_GET['money'];
$orderid=date("YmdHis").rand(1000,9999);
$pay = 10;
$addtime = date('Y-m-d H:i:s');
$sql="INSERT INTO `blypay_order` (`username`, `orderid`, `amout`, `addtime`, `state`, `bank`) VALUES ('{$username}', '{$orderid}', '{$total_fee}', '{$addtime}', '0', '{$pay}');";
$result = $db->query($sql);


                      
$shop_id=4046;         //商户ID，商户在千应官网申请到的商户ID
$bank_Type=101;   //充值渠道，101表示支付宝快速到账通道
$bank_payMoney=$total_fee;     //充值金额
$orderid=$orderid;                  //商户的订单ID，【请根据实际情况修改】
$callbackurl="http://".$_SERVER['SERVER_NAME']."/qypay/callback.php";        //商户的回掉地址，【请根据实际情况修改】
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

?>