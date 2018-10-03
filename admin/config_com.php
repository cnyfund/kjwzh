<?php
require_once 'header.php';
$clause = array_key_exists("clause", $_GET)? $_GET['clause'] : "";
switch($clause)
{
	case "saveeditinfo":
		saveeditinfo();
		break;
	default:
		editinfo();
		break;
}

function saveeditinfo()
{
	global $h_point2Com1,$h_point2Com2,$h_point2Com3,$h_point2Com4,$h_point2Com5,$h_point2Com6,$h_point2Com7,$h_point2Com8;
	global $h_point2ComReg,$h_point2ComBuy,$h_point3ComBuy,$h_point4ComBuy,$h_point5ComBuy;
	global $db;
	
	$h_point2Com1 = $h_point2Com1 / 100;
	$h_point2Com2 = $h_point2Com2 / 100;
	$h_point2Com3 = $h_point2Com3 / 100;
	$h_point2Com4 = $h_point2Com4 / 100;
	$h_point2Com5 = $h_point2Com5 / 100;
	$h_point2Com6 = $h_point2Com6 / 100;
	$h_point2Com7 = $h_point2Com7 / 100;
	$h_point2Com8 = $h_point2Com8 / 100;
	
	$h_keyword = replace($h_keyword,"\r\n",'');
	$h_description = replace($h_description,"\r\n",'');

	$query = "update `h_config` SET
			  h_point2Com1 = '$h_point2Com1',
			  h_point2Com2 = '$h_point2Com2',
			  h_point2Com3 = '$h_point2Com3',
			  h_point2Com4 = '$h_point2Com4',
			  h_point2Com5 = '$h_point2Com5',
			  h_point2Com6 = '$h_point2Com6',
			  h_point2Com7 = '$h_point2Com7',
			  h_point2Com8 = '$h_point2Com8',
			  h_point2ComReg = '$h_point2ComReg',
			  h_point2ComBuy = '$h_point2ComBuy',
              h_point3ComBuy = '$h_point3ComBuy',
              h_point4ComBuy = '$h_point4ComBuy',
              h_point5ComBuy = '$h_point5ComBuy'
			  ";
			   
	$db->query($query);
	
	HintAndTurn('配置修改成功！',"?");
}



function editinfo()
{
	global $db;
	global $ckeditor_mc_id,$ckeditor_mc_val,$ckeditor_mc_lang,$ckeditor_mc_toolbar,$ckeditor_mc_height;
	$rs = $db->get_one("SELECT * FROM `h_config`");
	if(!$rs)
	{
		//
	}
	else
	{
?>
<form action="?clause=saveeditinfo" method="post" name="addinfo">
  <table width="98%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF" class="tableborder">
    <tr>
      <td height="25" colspan="2" align="center" class="tdtitle">推荐会员提成配置</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td width="15%" align="center">以下为</td>
      <td>下家的分红时获得提成</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第1代</td>
      <td><input name="h_point2Com1" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com1'] * 100; ?>" /> %</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第2代</td>
      <td><input name="h_point2Com2" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com2'] * 100; ?>" /> %</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第3代</td>
      <td><input name="h_point2Com3" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com3'] * 100; ?>" /> %</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第4代</td>
      <td><input name="h_point2Com4" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com4'] * 100; ?>" /> %</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第5代</td>
      <td><input name="h_point2Com5" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com5'] * 100; ?>" /> %</td>
    </tr>
	 <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第6代</td>
      <td><input name="h_point2Com6" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com6'] * 100; ?>" /> %</td>
    </tr>
	 <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第7代</td>
      <td><input name="h_point2Com7" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com7'] * 100; ?>" /> %</td>
    </tr>
	 <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第8代</td>
      <td><input name="h_point2Com8" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2Com8'] * 100; ?>" /> %</td>
    </tr>
    
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">以下为</td>
      <td>推荐会员时获得的提成</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">会员注册</td>
      <td>每推荐1个会员注册，获得 <input name="h_point2ComReg" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2ComReg']; ?>" /> 元（一般推荐关闭，因为会造成大量虚拟会员注册）</td>
    </tr>
    <!--<tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">会员激活</td>
      <td>每当推荐的会员被激活，获得 <input name="h_point2ComRegAct" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2ComRegAct']; ?>" /> 元</td>
    </tr>-->
	
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
	<tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">以下为</td>
      <td>会员初次购买：每当推荐的会员初次购买（直推奖）</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第1代，获得</td>
      <td><input name="h_point2ComBuy" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point2ComBuy']; ?>" />% 元</td>
    </tr>
      <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第2代，获得</td>
      <td><input name="h_point3ComBuy" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point3ComBuy']; ?>" />% 元</td>
    </tr>
      <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">第3代，获得</td>
      <td><input name="h_point4ComBuy" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point4ComBuy']; ?>" />% 元</td>
    </tr>
      <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">无限代，获得</td>
      <td><input name="h_point5ComBuy" type="text" class="inputclass1" maxlength="8" value="<?php echo $rs['h_point5ComBuy']; ?>" />% 元</td>
    </tr>
    
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center" colspan="2"><input type="submit" name="Submit" value=" 保存 " class="bttn"></td>
    </tr>
    
  </table>
</form>

<?php
	}
}

footer();
?>
