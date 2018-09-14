<?php
header("Content-type: text/html; charset=utf-8");
/* 自动结算 */
require_once 'include/conn.php';
$webInfo = $db->get_one("SELECT * FROM `h_config`");
echo "开始自动结算 ".date('Y-m-d H:i:s') ."<br>";
$query = "select * from `h_member_farm` where h_isEnd=0 and timestampdiff(day,h_addTime,sysdate()) >= 0 and (timestampdiff(day,h_lastSettleTime,sysdate()) > 0 or h_lastSettleTime is null) order by h_addTime desc,id desc LIMIT 50";
$result = $db->query($query);
$rs_list = array();
while($list = $db->fetch_array($result))
{
	$rs_list[]=$list;
}

$info = array();
if(empty($rs_list)){
  exit("没有需要结算的数据!");
}else{
	foreach ($rs_list as $key=>$val){
			//计算上次结算与今天的时间差（天数）
			//如果上次未结算，默认为购买时便已结算（虚拟）
			if(is_null($val['h_lastSettleTime'])){
				$val['h_lastSettleTime'] = $val['h_addTime'];
			}
			$dateDiffDay = FDateDiff0($val['h_lastSettleTime'],time(),'d');
			
			//剩余需要结算的天数
			$ShengYuDay = $val['h_life'] - $val['h_settleLen'];//剩余生存天数
			
			if($dateDiffDay > 0 && $dateDiffDay <= $ShengYuDay){
		       $mustSettleDay = $dateDiffDay;	
		    }elseif($dateDiffDay > 0 && $dateDiffDay > $ShengYuDay){
		       $mustSettleDay = $ShengYuDay;
		    }else{
		       $mustSettleDay = 0;
		    }
			  
			if($mustSettleDay >0){
				settle_farm_day($val['h_userName']); //结算
				$info[] = "用户 {$val['h_userName']} 结算成功！\r\n";
			}
	}
}
if(empty($info)){
	exit("没有需要结算的数据!");
}else{
	echo implode('<br>',$info);
}