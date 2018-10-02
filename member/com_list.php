<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '直推会员 - ';

require_once 'inc_header.php';
?>

<?php

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
	
?>
<div class="content1">
	<div style="background:#fff;padding:10px;width:100%;"><span style="width:100%;">团队总业绩:<?php echo get_count($memberLogged_userName);?>元</span>
	</div>
    <div class="con_title">

        <div class="box">
			
    <span style="width:19.8%;">玩家编号</span>
    <span style="width:19.8%;">姓名</span>

    <span style="width:19.8%;">状态</span>
    <!--<span style="width:19.8%;">最后登录</span>-->
    <span style="width:39%;">注册时间</span>

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
	$total_count = $db->counter('h_member', "h_parentUserName = '{$memberLogged_userName}'", 'id');
	$page = (int)$page;
	//if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select * from `h_member` where h_parentUserName = '{$memberLogged_userName}' order by h_regTime desc,id desc LIMIT $from_record, $list_num";
	$result = $db->query($query);
        $rs_list = array();
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
				<span style="width:19.8%;">' , $val['h_userName'] , '</span>
				<span style="width:19.8%;">' , $val['h_fullName'] , '</span>
				<span style="width:19.8%;">正常</span>
				 <!--<span style="width:19.8%;">' , $val['h_lastTime'] , '</span>-->
				<span style="width:39%;">' , $val['h_regTime'] , '</span>
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

    <script>
	mgo(22);
    </script>
<?php
require_once 'inc_footer.php';
?>
