<?php
header("Content-type: text/html;charset=utf-8");
require_once 'function.php';
//建立数据库连接
$db_settings = parse_ini_file('dbConfig.php');
@extract($db_settings);
require_once 'mysql.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
require_once 'webConfig.php';
$ddh=trim($_POST['ddh']); 
$money=str_replace(',', '', trim($_POST['money']));
$name=trim($_POST['name']); 
$name=str_replace("id","",$name);
$key=trim($_POST['key']); 
$lb=trim($_POST['lb']); 
//$moneyy= $money;
	if($money == "30"){
	    $moneyy = 1;
	}elseif($money == "300"){
	    $moneyy = 10;
	}elseif($money == "3000"){
	    $moneyy = 100;
	}else{
	    $moneyy = 0;
	}	
$date1 = date('Y-m-d H:i:s',time()); //获取日期时间
if (($ddh=="") or ($money=="") or ($key=="")){
   echo "no";
   exit();	
}
 if ($key !== "15ffc36fa248eff9c77d8681c460757d"){
     echo "key no";
   }else{
   //查询单号是否存在
   $sql = "SELECT * FROM h_pay_order WHERE h_orderId ='{$ddh}'";   
   	$result = $db->query($sql);
	if($db->num_rows($result) == 0){
	    //查询账号是否正确
          $sql2 = "SELECT * FROM h_member WHERE h_userName='{$name}'";
           if($lb=='1')$lbtext='支付宝';
           if($lb=='2')$lbtext='财付通';
           if($lb=='3')$lbtext='微信支付';

   	$result2 = $db->query($sql2);
	if($db->num_rows($result2) == 0){
		 	  echo "no";
		  }else{
		  	  //获取原来的金额
		      $navrow = $db->get_one($sql2);
			  $id=$navrow['id'];//ID
			  //插入订单数据
			$sql = "insert into `h_pay_order` set ";
			$sql .= "h_orderId = '" . $ddh . "' ";
			$db->query($sql);
			
			$sql2 = "update `h_member` set ";
			$sql2 .= "h_jifen=h_jifen+'{$moneyy}', ";
			$sql2 .= "h_point2=h_point2+'{$money}' ";
			$sql2 .= "where h_userName = '" . $name . "' ";
			$sqly = $db->query($sql2);
					   
              if($sqly){
			  	
	if($money == "30"){
	    $goodsIds = 109;
	}elseif($money == "300"){
	    $goodsIds = 107;
	}elseif($money == "3000"){
	    $goodsIds = 108;
	}else{
	    $goodsIds = 109;
	}
	
	$goodsNums = 1;
	$goodsIdsArr = explode(',',$goodsIds);
	$goodsNumsArr = explode(',',$goodsNums);
	if(count($goodsIdsArr) != count($goodsNumsArr)){
	}
	$goodsIN = array();
	for($ci = 0;$ci < count($goodsIdsArr);$ci++){
		$id = intval($goodsIdsArr[$ci]);
		$num = intval($goodsNumsArr[$ci]);
		$goodsIN[$id] = $num;
	}


	$rs = $db->get_one("select * from `h_member` where h_userName = '{$name}'");
	
	$parentUserName = trim($rs['h_parentUserName']);
	$first_buy = $rs['first_buy'] + 0;

	
	//循环检测和购买
	$query = "select * from `h_farm_shop` where id in ({$goodsIds})";
	$result = $db->query($query);
	if($db->num_rows($result) <= 0){
	}
	$moneySum = 0;
	while($rs_list = $db->fetch_array($result)){
		//先遍历金额
		$moneySum += intval($rs_list['h_money']) * $goodsIN[$rs_list['id']];
		
		//判断总数量是否超出
		$rs1 = $db->get_one("select sum(h_num) as sumNum from `h_member_farm` where h_userName = '{$name}' and h_pid = '{$rs_list['id']}' and h_isEnd = 0");
		if($rs1){
			if((intval($rs1['sumNum']) + $goodsIN[$rs_list['id']]) > $rs_list['h_allMaxNum']){
			}
		}
		//判断今天购买是否超量
		//$rs1 = $db->get_one("select sum(h_num) as sumNum from `h_member_farm` where h_userName = '{$name}' and h_pid = '{$rs_list['id']}' and h_isEnd = 0 and timestampdiff(day,h_addTime,sysdate()) = 0");
		$rs1 = $db->get_one("select sum(h_num) as sumNum from `h_member_farm` where h_userName = '{$name}' and h_pid = '{$rs_list['id']}' and h_isEnd = 0 and datediff(h_addTime,sysdate()) = 0");
		if($rs1){
			if((intval($rs1['sumNum']) + $goodsIN[$rs_list['id']]) > $rs_list['h_dayBuyMaxNum']){
			}
		}
		//等级是否符合
		if($rs_list['h_minMemberLevel'] > $rs['h_level']){
		}
	}
	//判断金额是否够
	if($moneySum > intval($rs['h_point2'])){
	}
	//重新遍历并购买
	$moneyAll = 0;
	$db->move_first($result);
	while($rs_list = $db->fetch_array($result)){
		$num = intval($rs_list['h_money']) * $goodsIN[$rs_list['id']];
		
		$moneyAll += $num;
		
		//扣钱
		$sql = "update `h_member` set ";
		$sql .= "h_point2 = h_point2 - {$num} ";
		$sql .= "where h_userName = '" . $name . "' ";
		$db->query($sql);
		
		//记录扣钱
		$sql = "insert into `h_log_point2` set ";
		$sql .= "h_userName = '" . $name . "', ";
		$sql .= "h_price = '-" . $num . "', ";
		$sql .= "h_type = '购买物品', ";
		$sql .= "h_about = '" . $rs_list['h_title'] . "，数量：" . $goodsIN[$rs_list['id']] . "', ";
		$sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
		$sql .= "h_actIP = '" . getUserIP() . "' ";
		$db->query($sql);
		
		//增加物品
		$sql = "insert into `h_member_farm` set ";
		$sql .= "h_userName = '" . $name . "', ";
		$sql .= "h_pid = '" . $rs_list['id'] . "', ";
		$sql .= "h_num = '" . $goodsIN[$rs_list['id']] . "', ";
		$sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
		$sql .= "h_endTime = '" . date('Y-m-d H:i:s',strtotime('+' . ($rs_list['h_life'] + 1) . ' day')) . "', ";
		$sql .= "h_lastSettleTime = NULL, ";
		$sql .= "h_settleLen = '0', ";
		$sql .= "h_isEnd = '0', ";
		$sql .= "h_title = '" . $rs_list['h_title'] . "', ";
		$sql .= "h_pic = '" . $rs_list['h_pic'] . "', ";
		$sql .= "h_point2Day = '" . $rs_list['h_point2Day'] . "', ";
		$sql .= "h_life = '" . $rs_list['h_life'] . "', ";
		$sql .= "h_money = '" . $rs_list['h_money'] . "' ";
		$db->query($sql);
		//echo $sql;
	}
	
	//系统消息
	$sql = "insert into `h_member_msg` set ";
	$sql .= "h_userName = '[系统消息]', ";
	$sql .= "h_toUserName = '" . $name . "', ";
	$sql .= "h_info = '恭喜您购买物品成功，本次共支付{$moneyAll}元', ";
	$sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
	$sql .= "h_actIP = '" . getUserIP() . "' ";
	$db->query($sql);	
	settle_farm_day($name);
	//发放提成，五级
	//这里没这个奖
	if($parentUserName && $first_buy == 0){ //初次购买，给上家提成
	    $rs = $db->get_one("select * from `h_config` limit 1");
		$rate = $rs['h_point2ComBuy'] + 0;
		
		if($rate > 0){//给上家提成
			$num = $moneyAll*$rate/100;
			$num2 = $moneyAll/30;
			$sql = "update `h_member` set ";
			$sql .= "h_jifen=h_jifen+'{$num2}', ";
			$sql .= "h_point2 = h_point2 + {$num} ";
			$sql .= "where h_userName = '" . $parentUserName . "' ";
			$db->query($sql);
			
			//记录加钱
			$sql = "insert into `h_log_point2` set ";
			$sql .= "h_userName = '" . $parentUserName . "', ";
			$sql .= "h_price = '" . $num . "', ";
			$sql .= "h_type = '奖励', ";
			$sql .= "h_about = '玩家" . $name . " 会员提现感恩奖励', ";
			$sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
			$sql .= "h_actIP = '" . getUserIP() . "' ";
			$db->query($sql);
			
			$sql = "update `h_member` set ";
			$sql .= "first_buy=1 ";
			$sql .= "where h_userName = '" . $name . "' ";
			$db->query($sql);
		}
	}
	//进行物品元的结算，以及提成发放
	settle_farm_days($name,$money);
	
				 echo "ok";  
		  }
		  }	
	 	
		
      }
	  else
      {

		echo "ddh error";
      }
}
?>