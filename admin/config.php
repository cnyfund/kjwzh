<?php
require_once 'header.php';

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
	global $h_webName,$h_webKeyword,$h_keyword,$h_description,$h_counter,$h_footer,$h_leftContact;
	global $db;
	
	$h_keyword = replace($h_keyword,"\r\n",'');
	$h_description = replace($h_description,"\r\n",'');

	$query = "update `h_config` SET
			  h_webName = '$h_webName',
			  h_webKeyword = '$h_webKeyword',
			  h_keyword = '$h_keyword',
			  h_counter = '$h_counter',
			  h_footer = '$h_footer',
			  h_description = '$h_description'";
			   
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
      <td height="25" colspan="2" align="center" class="tdtitle">基本配置</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td width="15%" align="center">网站名称</td>
      <td><input name="h_webName" type="text" class="inputclass2" maxlength="50" value="<?php echo $rs[h_webName]; ?>" />
          <font color="#ff0000">*</font></td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td width="15%" align="center">标题栏关键字</td>
      <td><input name="h_webKeyword" type="text" class="inputclass2" maxlength="250" value="<?php echo $rs[h_webKeyword]; ?>" />
          <font color="#ff0000">*</font> 利于搜索引擎收录，250字以内</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">网站关键字</td>
      <td><textarea name="h_keyword" class="textareaclass4"><?php echo $rs[h_keyword]; ?></textarea>
          <font color="#ff0000">*</font> 利于搜索引擎收录，请不要回车换行</td>
    </tr>
    <tr class="tdbottom" onMouseOver="javascript:this.className='tdbottomover';" onMouseOut="javascript:this.className='tdbottom';">
      <td align="center">网站介绍</td>
      <td><textarea name="h_description" class="textareaclass4"><?php echo $rs[h_description]; ?></textarea>
          <font color="#ff0000">*</font> 利于搜索引擎收录，请不要回车换行</td>
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