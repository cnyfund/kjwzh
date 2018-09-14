<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '充值记录 - ';

require_once 'inc_header.php';
?>

<div class="countgo pull-left"><div class="zt">
<!--MAN -->
<div class="remain">
<div class="gao1"></div>
<div class="page-header long-header">
  <h3>元管理 <small> 充值记录</small></h3>
</div>
<div>
<ol class="breadcrumb">
  <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">主页</a></li>
  <li><a href="#">元管理</a></li>
  <li class="active">充值记录</li>
</ol>
</div>


<div class="panel panel-default">
  <div class="panel-heading">充值记录</div>
   

   
<table class="table table-striped table-hover">
  <tr>
    <td>充值Id</td>
    <td>充值金额</td>
    <td>充值方式</td>
    <td>收款支付宝</td>    
    <td>充值状态</td>
    <td>下单时间</td>
  </tr>

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
	if($page_input){$page=$page_input;}
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

if($val['h_bank']==1) {$pp='微信';}
if($val['h_bank']==2) {$pp='支付宝';}
			echo '  <tr>
				<td>' , $val['id'] , '</td>
				<td>' , $val['h_money'] , '</td>
				<td>' , ($pp) , '</td>
				<td>' , $val['h_bank'] , '（' , $val['h_bankFullname'] , '）' , '</td>
				<td>' , $ss , '<br />' , $val['h_reply'] , '</td>
				<td>' , $val['h_addTime'] , '</td>
			  </tr>';
		}
	}
	else
	{
		echo '<tr><td colspan="99">暂无记录</td></tr>';
	}

	if(count($rs_list) > 0) echo "<tr>
                    <td colspan='99'>{$page_list}</td>
                </tr>";
}
?>
 
</table>


</div>
</div>
<!--MAN End-->
</div></div>
    <script>
	mgo(44);
    </script>
    
<?php
require_once 'inc_footer.php';
?>