<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

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
    <div class="con_title">
        <div class="box">
			<span style="width:19.6%;">编号</span>
			<span style="width:19.6%;">金额</span>
			<span style="width:19.6%;">方式</span>
			<span style="width:19.6%;">说明</span>    
			<span style="width:19.6%;">时间</span>

        </div>
    </div>
    	<ul class="con_rec">
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
	$query = "select * from `h_recharge` where h_userName = '{$memberLogged_userName}' order by h_addTime desc,id desc LIMIT $from_record, $list_num";
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
			if($val['h_state']==0) {$ss='等待审核';}
if($val['h_state']==1) {$ss='充值成功';}
if($val['h_state']==2) {$ss='充值失败';}

$pp='';
if($val['h_bank']==1) {$pp='微信';}
if($val['h_bank']==2) {$pp='支付宝';}
			echo '  <li>
				<span style="width:19.6%;">' , $val['id'] , '</span>
				<span style="width:19.6%;">' , $val['h_money'] , '</span>
				<span style="width:19.6%;">' , ($pp) , '</span>
				<span style="width:19.6%;">' , $ss , '<br />' , $val['h_reply'] , '</span>
				<span style="width:19.6%;">' , $val['h_addTime'] , '</span>
			  </li>';
		}
	}
	else
	{
		echo '<li>暂无记录</li>';
	}

	if(count($rs_list) > 0) echo "<li>{$page_list}</li>";
}
?>
 

</ul></div>

<?php
require_once 'inc_footer.php';
?>
