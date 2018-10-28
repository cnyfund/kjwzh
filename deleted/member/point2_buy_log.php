<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '元购买记录 - ';

require_once 'inc_header.php';
?>

<div class="countgo pull-left"><div class="zt">
<!--MAN -->
<div class="remain">
<div class="gao1"></div>
<div class="page-header long-header">
  <h3>元管理 <small> 元购买记录</small></h3>
</div>
<div>
<ol class="breadcrumb">
  <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">主页</a></li>
  <li><a href="#">元管理</a></li>
  <li class="active">元购买记录</li>
</ol>
</div>


<div class="panel panel-default">
  <div class="panel-heading">元购买列表</div>
   
<div class="panel-body">
<strong><span style="color:#F00;">警告:</span></strong><br>
<span style="color:#F00; font-weight:bold;">1.请立即向对方支付宝打款,30分钟内未付款 则视为恶意交易,系统会扣除您的违约金 具体为: 主动放弃交易扣除<?php echo $webInfo['h_point2Quit'];?>元  超过30分钟超时 扣除20元,没有打款而点确认付款的扣除3倍本次交易总额元</span><br>
<span style="color:#F00;">2.向对方支付宝账号打款成功后,请把点击后面的'<strong>我已付款</strong>'按钮 确认付款,等待卖家确认,这时候您可以主动通过微信或者电话联系卖家确认收款</span><br>
<span style="color:#F00;">3.如果付款完成,卖家长时间不确认收货,请联系公司出面解决,届时会对卖家做相应惩罚,并给予您补偿</span><br>
</div>
   
<table class="table table-striped table-hover">
  <tr>
    <td>单号ID</td>
    <td>挂单金额</td>
    <td>卖家收款信息</td>
    <td>卖家联系信息</td>
    <td>状态</td>
    <td>我的购买信息</td>
    <td>操作</td>
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
	$total_count = $db->counter('h_point2_sell', "h_buyUserName = '{$memberLogged_userName}'", 'id');
	$page = (int)$page;
	if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select * from `h_point2_sell` where h_buyUserName = '{$memberLogged_userName}' order by h_addTime desc,id desc LIMIT $from_record, $list_num";
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
			echo '  <tr>
				<td>' , $val['id'] , '</td>
				<td>' , $val['h_money'] , '元</td>
				<td>支付宝帐号：' , $val['h_alipayUserName'] , '<br />支付宝户名：' , $val['h_alipayFullName'] , '</td>
				<td>微信：' , $val['h_weixin'] , '<br />手机：' , $val['h_tel'] , '</td>
				<td>' , $val['h_state'] , '</td>
				<td>';
	echo '购买时间：' , $val['h_buyTime'] , '<br />';
	if($val['h_buyIsPay']){
		echo '<span style="color:#0000ff">已付款</span><br />';
	}else{
		echo '<span style="color:#ff0000">未付款</span><br />';
	}
				echo '</td>
				<td>';
				
				if($val['h_state'] == '等待买家付款'){
					echo '<button onclick="jinbi_fukuan(' , $val['id'] , ')" class="btn btn-success guadan_go" type="button">我已付款</button>';
					echo ' &nbsp; <button onclick="jinbi_fukuan2(' , $val['id'] , ')" class="btn btn-danger" type="button">放弃购买</button>';
				}else{
					echo '-';
				}
				
				echo '</td>
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
	mgo(46);
	var indexdd;
	
	function jinbi_fukuan(rid){
	    layer.msg("确认支付宝打款成功,才能确认付款,否则将受严重惩罚.",{time: 20000, btn: ['确定付款', '我点错了'],btn1: function(){jihuo_fuk(rid)}});	
		}
		
	function jihuo_fuk(c){
		tishi2();
		$.get("/member/bin.php?act=point2_buy_payed&id="+encodeURI(c),function(e){
			tishi2close();
			if(e!=""){
				if(unescape(e)=='付款成功'){
					layer.msg("付款成功,等待卖家确认,3秒后返回",function(){location.reload();});
					}else{
					layer.msg(unescape(e))
					}
				}
			},'html');
		}
		
	function jinbi_fukuan2(rid){
	    layer.msg("确认放弃本次交易,因为您违约,将会扣除您<?php echo $webInfo['h_point2Quit'];?>元?",{time: 20000, btn: ['确定放弃', '我点错了'],btn1: function(){jihuo_fuk2(rid)}});	
		}
		
	function jihuo_fuk2(c){
		tishi2();
		$.get("/member/bin.php?act=point2_buy_quit&id="+encodeURI(c),function(e){
			tishi2close();
			if(e!=""){
				if(unescape(e)=='放弃成功'){
					layer.msg("已经放弃本次交易,3秒后返回",function(){location.reload();});
					}else{
					layer.msg(unescape(e))
					}
				}
			},'html');
		}		
	
   </script>
    
<?php
require_once 'inc_footer.php';
?>