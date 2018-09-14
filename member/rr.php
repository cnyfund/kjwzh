<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '会员图谱 - ';

require_once 'inc_header.php';
?>
<div class="panel panel-default">



<!--<?php

function get_count($memberLogged_userName){
	$price1=get_count1($memberLogged_userName);
	$price2=get_count2($memberLogged_userName);
	return $price1+$price2;
}

function get_count2($memberLogged_userName){
	global $db;
	$sql = "select sum(amout) as price from blypay_order where username in (select h_userName from `h_member` where h_parentUserName = '{$memberLogged_userName}') and amout>0 and state=1";

	$result = $db->query($sql);
	while($list = $db->fetch_array($result))
	{
		$rs_list[]=$list;
	}
	$price = $rs_list[0]['price'];
	
	
		$sql2 = "select h_userName from `h_member` where h_parentUserName = '{$memberLogged_userName}'";

		$result2 = $db->query($sql2);
		$rs_list2 = false;
		while($list2 = $db->fetch_array($result2))
		{
			$rs_list2[]=$list2;
		}
		if($rs_list2){
			foreach($rs_list2 as $vo){
				$price += get_count2($vo['h_userName']);
			}
		}
	
	
	return $price;
}

function get_count1($memberLogged_userName){
	global $db;
	$sql = "select sum(h_price) as price from h_log_point2 where h_userName in (select h_userName from `h_member` where h_parentUserName = '{$memberLogged_userName}') and h_price>0 and h_type='充值'";

	$result = $db->query($sql);
	while($list = $db->fetch_array($result))
	{
		$rs_list[]=$list;
	}
	$price = $rs_list[0]['price'];
	
	
		$sql2 = "select h_userName from `h_member` where h_parentUserName = '{$memberLogged_userName}'";

		$result2 = $db->query($sql2);
		$rs_list2 = false;
		while($list2 = $db->fetch_array($result2))
		{
			$rs_list2[]=$list2;
		}
		if($rs_list2){
			foreach($rs_list2 as $vo){
				$price += get_count1($vo['h_userName']);
			}
		}
	
	
	return $price;
}
	
?>-->






                                   
<div class="panel-heading">
  <div style="float: left;">会员图谱 </div>
	<div style="font-weight:bold;text-align:right;">团队总业绩:<?php echo get_count($memberLogged_userName);?>元</div></div>
  
  <div class="panel-body">
  <ul id="wenjianshu" class="ztree"></ul>
  </div>
</div>


<link rel="stylesheet" href="/ui/zTree_v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="/ui/zTree_v3/js/jquery.ztree.all-3.5.min.js"></script>
<script>
mgo(21);


		var setting = {
			view: {
				selectedMulti: false
			},
			async: {
				enable: true,
				url:"/member/bin.php?act=rr",
				autoParam:["id", "name=n", "icon"],
				otherParam:{"act":"ax"},
				dataFilter: filter
			}
		};

		function filter(treeId, parentNode, childNodes) {
			if (!childNodes) return null;
			for (var i=0, l=childNodes.length; i<l; i++) {
				childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
			}
			return childNodes;
		}

		$(document).ready(function(){
			$.fn.zTree.init($("#wenjianshu"), setting);
		});	
    </script>

<?php
require_once 'inc_footer.php';
?>