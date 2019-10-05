<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pay/pay.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/curl_util.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/proxyutil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/entities/UserAccount.php';

function redeem_external($db, $user, $api_key, $external_cnyf_address, $redeem_amount, $txid, $webInfo) {
	global $INTESTMODE, $NOTIFYSITEDEV, $NOTIFYSITEPROD;
	global $DEVSITE, $PRODSITE, $APIKEY, $SECRETKEY;

	if (!$db->set_autocommit(FALSE)){
		error_log("Failed to set auto commit to false for redeem");
	}

	$db->begin_trans();
	//扣钱
	$sql = "update `h_member` set ";
	$sql .= "h_point2 = h_point2 - {$redeem_amount} ";
	$sql .= "where h_userName = '" . $user->username . "' and api_key='" . $api_key . "'";
	$db->query($sql);
	
	//记录扣钱
	$sql = "insert into `h_log_point2` set ";
	$sql .= "h_userName = '" . $user->username . "', ";
	$sql .= "h_price = '-" . $redeem_amount . "', ";
	$sql .= "h_type = '申请提现', ";
	$sql .= "h_about = '', ";
	$sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
	$sql .= "h_actIP = '" . getUserIP() . "' ";
	$db->query($sql);
	
	//提现下单
	$out_trade_no = date('YmdHis').rand(100000,999999);

	$sql = "insert into `h_withdraw` set ";
	$sql .= "h_userName = '" . $user->username . "', ";
	$sql .= "h_money = '" . $redeem_amount . "', ";
	$sql .= "h_fee = '" . ($redeem_amount * $webInfo['h_withdrawFee']) . "', ";
	
	//$sql .= "qrcode = '" . $qrcode . "', ";
	$sql .= "h_state = '待审核', ";
	$sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
	$sql .= "h_imgs = '" . $user->weixin_qrcode . "', ";
	$sql .= "out_trade_no = '" . $out_trade_no . "', ";
	$sql .= "h_actIP = '" . getUserIP() . "' ";
	$db->query($sql);
	
	error_log("redeem: create db withdraw records");

	// the fee rate is negative 
	$total_fee = $redeem_amount + $redeem_amount * $webInfo['h_withdrawFee'];
    if ($user->api_account != null) {
        $config['subject'] = '[' . $user->api_account->name . ']:'. $user->username . '请求体现' . $redeem_amount . '元';
    } else {
        $config['subject'] = '投资网站客户' . $user->username . '请求提现' . $redeem_amount . '元';
    }

	if ($INTESTMODE) {
		$config['notify_url'] = $NOTIFYSITEDEV . '/notify.php';
		$config['return_url'] = $NOTIFYSITEDEV . '/return.php';	
	}else {
		$config['notify_url'] = $NOTIFYSITEPROD . '/notify.php';
		$config['return_url'] = $NOTIFYSITEPROD . '/return.php';
	}

	$config['out_trade_no'] = $out_trade_no;
	$config['external_cny_rec_address'] = $external_cnyf_address;
	$config['txid'] = $txid;

	$qrcode_url = '';
	if ($INTESTMODE) {
		$qrcode_url = $NOTIFYSITEDEV . '/member/getpaymentqrcode.php?out_trade_no=' . $out_trade_no;
	} else {
		$qrcode_url = $NOTIFYSITEPROD . '/member/getpaymentqrcode.php?out_trade_no=' . $out_trade_no;
	}

    if ($user->api_account != null) {
        $config['subject'] = '[' . $user->api_account->name . ']:'. $user->username . '请求提现' . $redeem_amount . '元';
    } else {
        $config['subject'] = '投资网站客户' . $user->username . '请求提现' . $amount . '元';
	}
		
	$config['total_fee'] = $total_fee*100;
	$config['attach'] = 'weixin=' . $user->weixin . ';username='.$user->username . ';' . $qrcode_url;
	$config['payment_account'] = "$user->weixin";

	error_log("redeem: finish create api cal request");
	//记录提现记录
	$sql = "insert into `order` set ";
	$sql .= "username = '" . $user->username . "', ";
	$sql .= "out_trade_no = '{$out_trade_no}', ";
	$sql .= "subject = '{$config['subject']}', ";
	$sql .= "total_fee = " . $total_fee . ", ";
	$sql .= "type = 'withdraw', ";
	$sql .= "submit_time = '" . date('Y-m-d H:i:s') . "', ";
	$sql .= "ip = '" . getUserIP() . "' ";
	//echo $sql;
	$db->query($sql);
	
	error_log("redeem: about to call redeem api");
	$resp = new \stdClass();
	try {
		$tradesite = ($INTESTMODE) ? $DEVSITE : $PRODSITE;
		$pay = new pay($APIKEY, $SECRETKEY, $tradesite);
		$data  = $pay->applyredeem($config);
	
		$resp->result_code = $data['return_code'];
		$resp->result_msg = $data['return_msg'];
		if ($data['return_code']=='SUCCESS'){
			error_log("redeem: call to redeem api succeeded");
			$sql = "insert into `log` set ";
			$sql .= "logtime = '" . date('Y-m-d H:i:s') . "',";
			$sql .= "type = 'withdraw api test',";
			$sql .= "data = '" . json_encode($data,320) . "' ";
			$db->query($sql);
	
			$sql = "update `order` SET trx_bill_no='{$data['trx_bill_no']}' where out_trade_no ='{$out_trade_no}'";
			$db->query($sql);
		}
		$db->commit();
	} catch (Exception $pe) {
        $err_message = 'redeem: hit exception' . $pe->getMessage();
		error_log(err_message);
		$db->rollback();
		$resp->result_code = 'EXCEPTION';
		$resp->result_message = $err_msg;
	}

	return $resp;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    return create_json_response("ERROR_BAD_METHOD", "系统只接受POST请求");
}

foreach($_POST as $key=>$post_data){
	error_log("redeem.php: You posted:" . $key . " = " . $post_data);
}

error_log("redeem.php check input");
if (!isset($_POST['api_key']) || empty($_POST['api_key'])) {
    return create_json_response("ERROR_MISS_APIKEY", "你的请求没有包含API KEY");
}
$api_key = $_POST['api_key'];

if (!isset($_POST['auth_token']) || empty($_POST['auth_token'])) {
    return create_json_response("ERROR_MISS_AUTHTOKEN", "你的请求没有包含登陆认证");
}
$auth_token = $_POST['auth_token'];

if (!isset($_POST['auth_check_url']) || empty($_POST['auth_check_url'])) {
    return create_json_response("ERROR_MISS_AUTH_CHECK_URL", "你的请求没有包含登陆核实URL");
}
$auth_check_url = $_POST['auth_check_url'];

if (!isset($_POST['externaluserId']) || empty($_POST['externaluserId'])){
    return create_json_response("ERROR_MISS_USERID", "你的请求没有包含你的客户的用户ID");
}
$userId = $_POST['externaluserId'];

if (!isset($_POST['external_cny_rec_address']) || empty($_POST['external_cny_rec_address'])){
    return create_json_response("ERROR_MISS_EXTERNAL_ADDRESS", "你的请求没有包含你的客户的钱包地址");
}
$external_cnyf_address = $_POST['external_cny_rec_address'];    

if (!isset($_POST['redeem_amount']) || empty($_POST['redeem_amount'])){
    return create_json_response("ERROR_MISS_REDEEM_AMOUNT", "你的请求没有包含提现金额");
}
$redeem_amount = $_POST['redeem_amount'];

if (!is_numeric($redeem_amount)){
    return create_json_response("ERROR_INVALID_REDEEM_AMOUNT", "你的请求的提现金额‘" . $redeem_amount . "'不是数字");
}

if ((int)$redeem_amount < $MINREDEEMAMOUNT) {
    return create_json_response("ERROR_REDEEM_AMOUNT_TOO_SMALL", "你的请求的提现金额需要至少是" . $MINREDEEMAMOUNT . "元");
}

if (!isset($_POST['txid']) || empty($_POST['txid'])){
    return create_json_response("ERROR_MISS_TXID", "你的请求没有包含转币的交易txid");
}
$txid = $_POST['txid'];

if (!isset($_POST['signature']) || empty($_POST['signature'])) {
    return create_json_response("ERROR_MISS_SIGNATURE", "你的请求没有包含签名");
}
$signature = $_POST['signature'];

//now load user and see whether it exist or not, return 404 if it does not
$user = UserAccount::load_api_user($db, $userId, $api_key);
if (is_null($user)) {
    error_log("redeem: Did not find the user " . $userId . " with api_key " . $api_key . ", will register the api user");
    return create_json_response("ERROR_USER_NOTFOUND", "你提供的用户". $userId ."不存在", 404);
}

if (!redeem_signature_is_valid($api_key, $user->api_account->api_secret, $externaluserId, $external_cnyf_address, $redeem_amount, $txid, $signature)) {
    return create_json_response("ERROR_SIGNATURE_NOT_MATCH", "你的请求签名不符");
}

$check_url= $auth_check_url . "?token=" . urlencode($auth_token);
try {
    curl_get($check_url, null, $response, $response_code);
    if ($response_code != 200) {
        error_log("calling " . $check_url . " return (" . $response_code . "):" . $response);
        return create_json_response("ERROR_AUTH_CHECK_FAIL", "你的请求没有通过登陆核实:(". $response_code . "):" . $response);
    }
} catch (PayException $pe) {
    error_log("calling " . $check_url . " hit exception:" . $pe->getMessage());
    return create_json_response("ERROR_CONNECT_AUTH_CHECK_URL_FAIL", "无法链接登陆核实URL");
}

//return 404 if the qrcode is missing
if (is_null($user->weixin_qrcode)) {
    return create_json_response("ERROR_USER_NO_PAYMENT_QRCODE", "你提供的用户" . $userId ."还没有设置付款二维码", 404);
}

$redeemDb = new dbmysql();
$redeemDb->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
$resp = redeem_external($redeemDb, $user, $api_key, $external_cnyf_address, $redeem_amount, $txid, $webInfo);
$redeemDb->close();
$http_resp_code = ($resp->result_code != 'EXCEPTION') ? 200: 500;
return create_json_response($resp->result_code, $resp->result_msg, $http_resp_code);

?>
