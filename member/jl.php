<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '消费记录 - ';

require_once 'inc_header.php';
?>

<div class="content1">
<div style="background:#fff;padding:10px;width:100%;"><span style="width:100%;">您总共支出:  <?php
    $rs = $db->get_one("select sum(h_price) as sumP from `h_log_point2` where h_userName = '{$memberLogged_userName}' and h_price < 0  and h_type='购买产品'");
	if(strlen($rs['sumP']) <= 0){
		$rs['sumP'] = 0;
	}
	
	echo $rs['sumP'];
	?>
        </strong>元</span></div>   
    <div class="con_title">
        <div class="box">
			<span style="width:19.6%;">编号</span>
			<span style="width:19.6%;">类型</span>
			<span style="width:19.6%;">金额</span>
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
	$where = "h_userName = '{$memberLogged_userName}' and h_price < 0 and h_type='购买产品'";
	$total_count = $db->counter('h_log_point2', $where, 'id');
	$page = (int)$page;
	if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select * from `h_log_point2` where {$where} order by h_addTime desc,id desc LIMIT $from_record, $list_num";
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
			echo '  <li>
				<span style="width:19.6%;">' , $val['id'] , '</span>
				<span style="width:19.6%;">' , $val['h_type'] , '</span>
				<span style="width:19.6%;">' , $val['h_price'] , '</span>
				<span style="width:19.6%;">' , $val['h_about'] , '</span>
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