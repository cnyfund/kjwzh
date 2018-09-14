<?php
 header("Content-type:text/html;charset=utf-8");
 require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
/* $h_userName="18673419184";
 $h_money=1.00;
 $sql = "update `h_member` set ";
            $sql .= "h_point2 = h_point2 + {$h_money} ";
            $sql .= "where h_userName = '" . $h_userName . "' ";
            $db->query($sql);
 
 exit("###");
 */
 
 
 
 $data=$_GET;
 $key = "ceb685c938544312b35c4190dc857a5e";          //商户密钥，千应官网注册时密钥
 $orderid = $data["oid"];        //订单号
 $status = $data["status"];      //处理结果：【1：支付完成；2：超时未支付，订单失效；4：处理失败，详情请查看msg参数；5：订单正常完成（下发成功）；6：补单；7：重启网关导致订单失效；8退款】
 $money = $data["m1"];            //实际充值金额
 $sign = $data["sign"];          //签名，用于校验数据完整性
 $orderidMy = $data["oidMy"];    //千应录入时产生流水号，建议保存以供查单使用
 $orderidPay = $data["oidPay"];  //收款方的订单号（例如支付宝交易号）; 
 $completiontime = $data["time"];//千应处理时间
 $attach = $data["token"];       //上行附加信息
 $param="oid=".$orderid."&status=".$status."&m=".$money.$key;  //拼接$param

 $paramMd5=md5($param);          //md后加密之后的$param


 $str =print_r($data,true);
 file_put_contents( "success2.txt",$str."\n", FILE_APPEND);
/*

 $str =$paramMd5."###".$sign;
 file_put_contents( "success.txt",$str."\n", FILE_APPEND);*/



if(strcasecmp($sign,$paramMd5)==0){
 	if($status == "1" || $status == "5" || $status == "6"){      
             
            //可在此处增加操作数据库语句，实现自动下发，也可在其他文件导入该php，写入数据库
			
			
        $h_money = number_format($money, 2, ".", "");
        $str ="订单号:".$orderid.date("Y-m-d H:i:s");
 		file_put_contents( "success2.txt",$str."\n", FILE_APPEND);
		
        $sql = "select * from `blypay_order` where `orderid`='{$orderid}' and `state`='0' LIMIT 1";
        $rs = $db->get_one($sql);
		
		/* $str =print_r($rs,true);
 		 file_put_contents( "success.txt",$str."\n", FILE_APPEND);*/
		
		
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
			
		
 		echo "商户收款成功，订单正常完成！";
 	}
 	else if($status == "4"){
 		echo "订单处理失败，因为：" . $msg;
 	}
 	else if ($status == "8")
       {
        echo "订单已经退款！";
       }
 }else{
 	echo "签名无效，视为无效数据!";
 }
?>