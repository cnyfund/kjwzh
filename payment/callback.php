<?php
$logs = fopen("pay.log", "a+");
fwrite($logs, "\r\n" . date("Y-m-d H:i:s") . "  回调信息：" . json_encode($_REQUEST) . " \r\n");
fclose($logs);

$token = "303a312a793617873711e3fd4b500405";

$p_id = $_REQUEST["ordno"];
$orderid = $_REQUEST["orderid"];
$price = $_REQUEST["price"];
$realprice = $_REQUEST["realprice"];
$orderuid = $_REQUEST["orderuid"];
$key = $_REQUEST["key"];

//orderid + orderuid + p_id + price + realprice + token
//{"uid":"53439621257","ordno":"A190332952686266","orderid":"1514267882500","price":"0.01","realprice":"0.01","orderuid":"1514267882500","key":"0ed56c489638b7ef18db22bddb054130"} 
//15142678825001514267882500A1903329526862660.010.01303a312a793617873711e3fd4b500405
$check = md5($orderid . $orderuid . $p_id . $price . $realprice . $token);

if($key == $check){
    //如果key验证成功，并且金额验证成功，只返回success【小写】字符串；
    //业务处理代码..........
	
	
        $sql = "select * from `blypay_order` where `orderid`='" . $orderid . "' and `state`='0' LIMIT 1";
        $rs = $db->get_one($sql);
        if ($rs) {
            $h_bank = $rs["bank"];
            $h_userName = $rs["username"];
            $sql = "insert into h_recharge (h_userName,h_money,h_bank,h_addTime,h_state,h_actIP,h_isReturn) values ('" . $h_userName . "','" . $price . "','" . $h_bank . "','" . date('Y-m-d H:i:s') . "','1','" . $_SERVER["REMOTE_ADDR"] . "','1')";
            $result = $db->query($sql);
            if ($result) {
            }
            $sql = "update `h_member` set ";
            $sql .= "h_point2 = h_point2 + {$price} ";
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
            $sql = "update `blypay_order` set state='1' where `orderid`='" . $orderid . "'  and `state`='0'";
            $db->query($sql);
        }
		
		
    $true = true;
    $logs = fopen($orderid . ".lock", "a+");
    fwrite($logs, $orderid);
    fclose($logs);
}else{
    $true = false;
}

if($true){
    exit("success");
}else{
    exit("fail");
}


?>
