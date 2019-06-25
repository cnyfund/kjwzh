<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/pay/pay.php';

$pageTitle = '充值记录 - ';

require_once 'inc_header.php';
?>

<div class="content1">
<div style="background:#fff;padding:10px;width:100%;"><span style="width:100%;">您总已充值:  <?php
    $rs = $db->get_one("select sum(h_money) as sumP from `h_recharge` where h_userName = '{$memberLogged_userName}' and h_state=1");
	if(strlen($rs['sumP']) <= 0){
		$rs['sumP'] = 0;
	}
	
	echo $rs['sumP'];
	?>
        </strong>元</span></div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="info">编号</th>
				<th class="info">金额</th>
				<th class="info">方式</th>
				<th class="info">说明</th>    
				<th class="info">时间</th>
			</tr>
		</thead>
		<tbody>
<?php
list_();
function list_(){
	global $rewriteOpen,$db;
	global $page,$total_count,$met_pageskin;
	global $mid,$mType,$mTitle,$mPageKey;
	global $cid,$cPageKey;
	global $memberLogged_userName;
	$mid = 111;
	$total_count = $db->counter('h_recharge', "h_userName = '{$memberLogged_userName}'", 'id');
	$page = (int)$page;
	//if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select r.id, r.h_state, r.h_bank, r.h_money, r.h_addTime, r.out_trade_no, r.h_reply, o.trx_bill_no  from `h_recharge` as r left join `order` as o on r.out_trade_no = o.out_trade_no where r.h_userName ='{$memberLogged_userName}' order by r.h_addTime desc,id desc LIMIT $from_record, $list_num";
	$result = $db->query($query);
	while($list = $db->fetch_array($result))
	{
		$rs_list[]=$list;
	}
	if($rewriteOpen == 1)
	{
		$page_list = $rowset->link("/$mPageKey/page",".html");
	}
	else
	{
		$page_list = $rowset->link(GetUrl(2) . "?page=");
	}

	if(count($rs_list) > 0)
	{
		foreach ($rs_list as $key=>$val)
		{
			if($val['h_state']==0) {
				if ($val['trx_bill_no']==="") {
					$ss = '请求发送失败';
				} else {
					$ss='等待审核';
				}
			}
			if($val['h_state']==1) {$ss='充值成功';}
			if($val['h_state']==2) {$ss='充值失败';}

			$pp='';
			if($val['h_bank']==1) {$pp='微信';}
			if($val['h_bank']==2) {$pp='支付宝';}
			if ($val['h_bank']==3) {$pp='充币';}
			echo "           <tr>";
			echo "				<td>" . $val['id'] . "</td>";
			echo "				<td>" . $val['h_money'] . "</td>";
			echo "				<td>" . ($pp) . "</td>";
			if ($val['h_state']>0 || ($val['h_state'] == 0 && $val['trx_bill_no']==="")) {
				echo "				<td>" . $ss . "<br/>" . $val['h_reply'] . "</td>";
			} else {
				if (FCBPayConfig::INTESTMODE) {
					$payment_qrcode_url = FCBPayConfig::DEVSITE;
				} else {
					$payment_qrcode_url = FCBPayConfig::PRODSITE; 
				}
				$payment_qrcode_url =  $payment_qrcode_url . "/trading/payment_qrcode_url/?out_trade_no=" . $val['out_trade_no'];
				echo "				<td><a href=\"/member/purchase_qrcode.php?amount=" . $val['h_money'] . "&payment_qrcode_url=" . urlencode($payment_qrcode_url) . "\"/>" . $ss . "</a></td>";
			}
			echo "				<td>" . $val['h_addTime'] . "</td>";
			echo "           </tr>";
		}
	}
	else
	{
		echo "<tr><td colspan=\"5\">暂无记录</td></tr>";
	}

	if(count($rs_list) > 0) echo "<li>{$page_list}</li>";
}
?>
		</tbody>
	</table> 

<?php
require_once 'inc_footer.php';
?>
