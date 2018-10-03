<?php
require_once 'header.php';

require_once '../include/pager.php';
$clause = array_key_exists("clause", $_GET)? $_GET['clause'] : "";
switch($clause)
{
	case "addinfo":
		menu();
		addinfo();
		break;
	case "saveinfo":
		saveinfo();
		break;
	case "editinfo":
		menu();
		editinfo();
		break;
	case "saveeditinfo":
		saveeditinfo();
		break;
	case "unlockinfo":
		unlockinfo();
		break;
	case "lockinfo":
		lockinfo();
		break;
	case "delinfo":
		delinfo();
		break;
	default:
		menu();
		main();
		break;
}


function saveinfo()
{
	global $db,$id,$h_state,$h_reply;
	
	$query = "update `h_recharge` SET h_state = '$h_state',h_reply = '$h_reply' where id = $id";
	$db->query($query);
	
	if($h_state == 1){
		$rs = $db->get_one("SELECT * FROM `h_recharge` where id = $id");
		if($rs){
			if($rs['h_isReturn'] == 0){
				$num = $rs['h_money'];
				
				//返款
				$sql = "update `h_member` set ";
				$sql .= "h_point2 = h_point2 + {$num} ";
				$sql .= "where h_userName = '" . $rs['h_userName'] . "' ";
				$db->query($sql);
				
				//记录加钱
				$sql = "insert into `h_log_point2` set ";
				$sql .= "h_userName = '" . $rs['h_userName'] . "', ";
				$sql .= "h_price = '" . $num . "', ";
				$sql .= "h_type = '充值', ";
				$sql .= "h_about = '{$h_reply}', ";
				$sql .= "h_addTime = '" . date('Y-m-d H:i:s') . "', ";
				$sql .= "h_actIP = '" . getUserIP() . "' ";
				$db->query($sql);
		
				$query = "update `h_recharge` SET h_isReturn = '1' where id = $id";
				$db->query($query);
			}
		}
	}
	
	FJS_PAC('保存成功');
}


function main()
{
	global $db,$LoginEdUserName;
	
	global $stype,$keyword;
	$where = "";
	if(strlen($keyword) > 0){
		$where .= " and (h_userName like '%{$keyword}%')";
	}
	if(strlen($stype) > 0){
		$where .= " and h_state = '{$stype}'";
	}
	
	global $page;
	$list_num = 15;
	$total_count = $db->counter("`h_recharge`", "1 = 1 {$where}", 'id');$page = (int)$page;$rowset = new Pager($total_count,$list_num,$page);$from_record = $rowset->_offset();$page_list = $rowset->link('?page=');
	$query = "select * from `h_recharge` where 1 = 1 {$where} order by h_addTime desc,id desc LIMIT $from_record, $list_num";
	$result = $db->query($query);
	//$query = "Select * from `h_withdraw` order by h_addTime desc";
	//$result = $db->query($query);
	$rs_list = array();
	while($list = $db->fetch_array($result))
	{
		$rs_list[]=$list;
	}
?>
<iframe style="display: none" name="iframe_qpost" id="iframe_qpost"></iframe>
<table width="98%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" class="tableborder">
  <tr>
    <td height="25" colspan="11" align="center" class="tdtitle">充值记录</td>
  </tr>
  <tr align="center"> 
    <td height="23" class="tdtitle-title">会员</td>
    <td class="tdtitle-title">充值金额</td>
	 <td class="tdtitle-title">充值方式</td>
    <td class="tdtitle-title">支付宝账号</td>
	 <td class="tdtitle-title">微信账号</td>
    <td class="tdtitle-title">申请时间</td>
    <td class="tdtitle-title">状态</td>
    <td class="tdtitle-title">相关操作</td>
  </tr>
<?php
foreach ($rs_list as $key=>$val)
{
?>
  <tr align="center" class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';"> 
    <td height="25"><?php echo $val['h_userName']; ?></td>
    <td><?php echo $val['h_money']; ?></td>
	    <td><?php if ($val['h_bank']==1) echo '微信'; if($val['h_bank']==2) echo '支付宝'; ?></td>
  <td><?php echo $val['h_bank'] , '（' , $val['h_bankFullname'] , '）'; ?></td>
	 <td><?php echo $val['h_bankCardId']; ?></td>
    <td><?php echo $val['h_addTime']; ?></td>
    <td>
<form action="?clause=saveinfo&id=<?php echo $val['id']; ?>" method="post" name="addinfo" target="iframe_qpost">
<select name="h_state"  <?php if($val['h_state'] == 1){echo 'disabled';} ?>>
<option value="0" <?php if($val['h_state'] == "0"){echo 'selected ';} ?>>待审核</option>
<option value="1" <?php if($val['h_state'] == "1"){echo 'selected disabled';} ?>>充值成功</option>
<option value="2" <?php if($val['h_state'] == "2"){echo 'selected';} ?>>审核失败</option>
</select>
<input name="h_reply" size="30" value="<?php echo $val['h_reply']; ?>" placeholder="回复信息，250个字以内" type="text" />
<input name="" type="submit" value="提交" />
</form>
<?php if($val['h_isReturn']){echo '<span style="color:#ff0000">注意：该会员已充值成功，请勿重复操作！</span>';} ?>
	</td>
    <td><!--<a href="?clause=editinfo&id=<?php echo $val[id]; ?>">修改</a> | -->
	<a style="cursor:pointer;" onClick="javascript:hintandturn('确定要删除吗？数据将不可恢复！','?clause=delinfo&id=<?php echo $val['id']; ?>',true);">删除</a></td>
  </tr>
<?php
}
?>
</table>
<?php
	if(count($rs_list) > 0) echo "<div style='text-align:center;'>$page_list</div>";
}



function menu()
{
	global $stype,$keyword;
?>
<table width="98%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" class="tableborder">
  <tr> 
    <td height="25" class="tdtitle" align="center">相关操作</td>
  </tr>
  <tr> 
    <td height="23" class="tdbottom" align="center">
<form action="" method="get">
搜索：
<select name="stype">
<option value="">-=状态=-</option>
<option value="0" <?php if($stype == 0){echo "selected";}?>>待审核</option>
<option value="1" <?php if($stype == 1){echo "selected";}?>>已打款</option>
<option value="2" <?php if($stype == 2){echo "selected";}?>>审核失败</option>
</select>
<input name="keyword" placeholder="会员编号" value="<?php echo $keyword;?>" type="text" />
<input type="submit" class="bttn" value="提交搜索" name="Submit">
</form>
    </td>
  </tr>
</table>
<br />
<?php
}



function unlockinfo()
{
	global $db,$id;

	$query = "update `h_withdraw` set h_isRead = 1 where id = $id";
	$db->query($query);
	
	turnToPage('?');
}

function lockinfo()
{
	global $db,$id;

	$query = "update `h_withdraw` set h_isRead = 0 where id = $id";
	$db->query($query);
	
	turnToPage('?');
}


function delinfo()
{
	global $db,$id;

	$query = "delete from `h_withdraw` where id = $id";
	$db->query($query);
	
	turnToPage('?');
}


footer();
?>
