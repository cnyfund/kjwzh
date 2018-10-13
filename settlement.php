<?php
header("Content-type: text/html; charset=utf-8");
/* 自动结算 */
require_once 'include/conn.php';
$webInfo = $db->get_one("SELECT * FROM `h_config`");
echo "开始自动结算 ".date('Y-m-d H:i:s') ."<br>";
$query = "select distinct h_userName from `h_member_farm` where h_isEnd=0 and timestampdiff(day,h_addTime,sysdate() + interval 8 hour) >= 0 and (timestampdiff(day,h_lastSettleTime,sysdate() + interval 8 hour) > 0 or h_lastSettleTime is null)";
$result = $db->query($query);
$rs_list = array();
while($list = $db->fetch_array($result))
{
	$rs_list[]=$list;
}

$info = array();
if (empty($rs_list)){
  exit("没有需要结算的数据!");
}else{
   foreach ($rs_list as $key=>$val){
      settle_farm_day($val['h_userName']); //结算
      $info[] = "用户 {$val['h_userName']} 结算成功！\r\n";
   }
}
if(empty($info)){
	exit("没有需要结算的数据!");
}else{
	echo implode('<br>',$info);
}
