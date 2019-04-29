<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pay/pay.php';
require_once '../member/logged_data.php';
require_once '../entities/UserAccount.php';

$ccc = isset($_REQUEST['ccc'])?$_REQUEST['ccc']:0;
if($ccc==0){
	exit('<script language="javascript">alert("请填写支付金额");window.history.back(-1);</script>');
}

$weixin = isset($_REQUEST['weixin'])?$_REQUEST['weixin']:'';
if ($weixin ==="") {
	exit('<script language="javascript">alert("请到绑定支付中输入微信昵称");window.history.back(-1);</script>');
}


$total_fee = $ccc*100;

$pay = new pay();
$out_trade_no = date('YmdHis').rand(10000,99999);
$subject = 'chongzhi';
$config['notify_url'] = 'https://'.$_SERVER['HTTP_HOST'].'/notify.php';
#$config['notify_url'] = 'http://localhost:8000/notify.php';
$config['return_url'] = 'https://'.$_SERVER['HTTP_HOST'].'/return.php';
$config['out_trade_no'] = $out_trade_no;
$config['subject'] = $subject;
$config['total_fee'] = $total_fee;
$config['attach'] = 'weixin=' . $weixin;

		//记录充值记录
		$sql = "insert into `order` set ";
		$sql .= "username = '" . $_COOKIE['m_username'] . "', ";
		$sql .= "out_trade_no = '{$out_trade_no}', ";
		$sql .= "subject = '{$subject}', ";
		$sql .= "total_fee = " . $ccc . ", ";
		$sql .= "submit_time = '" . date('Y-m-d H:i:s') . "', ";
		$sql .= "ip = '" . getUserIP() . "' ";
		//echo $sql;
		$db->query($sql);
		
				$pay_time = date('Y-m-d H:i:s');
				$sql = "insert into `h_recharge` set ";
				$sql .= "h_userName = '{$_COOKIE['m_username']}', ";
				$sql .= "h_money = '{$ccc}', ";
				//	$sql .= "h_fee = '" . ($num * $webInfo['h_withdrawFee']) . "', ";
				$sql .= "h_bank = 0, ";
				$sql .= "h_bankFullname = 'out_trade_no:{$out_trade_no}', ";
				$sql .= "h_state = 0, h_isReturn=0, ";
				$sql .= "h_addTime = '{$pay_time}', ";
				$sql .= "out_trade_no = '{$out_trade_no}', ";
				$sql .= "h_actIP = '" . getUserIP() . "' ";
				$rc = $db->query($sql);
$data  = $pay->applypurchase($config);
VAR_DUMP($data);
if($data['return_code']=='FAILED'){
	exit('<script language="javascript">alert("'.$data['return_msg'].'");window.history.back(-1);</script>');
}elseif($data['return_code']=='SUCCESS'){
	header('Location:'.$data['payment_url']);
}
?>
