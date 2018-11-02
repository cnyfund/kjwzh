<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '提现记录 - ';

require_once 'inc_header.php';
?>

<div class="content1">
    <div class="con_title">
        <div class="box">
			<span style="width:16.6%;">提现Id</span>
			<span style="width:16.6%;">提现金额</span>
			<span style="width:16.6%;">到账金额</span>
			<span style="width:16.6%;">收款号</span>    
			<span style="width:16.6%;">提现状态</span>
			<span style="width:16.6%;">下单时间</span>

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
	$total_count = $db->counter('h_withdraw', "h_userName = '{$memberLogged_userName}'", 'id');
	$page = (int)$page;
	//seems to be unused
        //if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select * from `h_withdraw` where h_userName = '{$memberLogged_userName}' order by h_addTime desc,id desc LIMIT $from_record, $list_num";
        $rs_list = array();
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
			echo ' <li>
            	<span style="width:16.6%;"><a href="/member/txorder.php?oid=',$val['id'],'">' , $val['id'] , '</a></span>
				<span style="width:16.6%;">' , $val['h_money'] , '</span>
				<span style="width:16.6%;">' , ($val['h_money'] - $val['h_fee']) , '</span>
				<span style="width:16.6%;">' , $val['h_bank'] , '（' , $val['h_bankFullname'] , '）' , '</span>
				<span style="width:16.6%;">' , $val['h_state'] , '<br />' , $val['h_reply'] , '</span>
				<span style="width:16.6%;">' , $val['h_addTime'] , '</span>

            </li>';
		}
	}
	else
	{
		echo '<li><span style="width:100%;">暂无记录</span></li>';
	}

	if(count($rs_list) > 0) echo "<li>
                    <span style=\"width:100%;\">{$page_list}</span>
                </li>";
}
?>
        </ul>
</div>
<?php require_once 'inc_footer.php'; ?>
