<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '已购计划 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';
?>

<?php
list_();
function list_(){
	global $rewriteOpen,$db;
	global $page,$total_count,$met_pageskin;
	global $mid,$mType,$mTitle,$mPageKey;
	global $cid,$cPageKey;
	global $memberLogged_userName;
	$mid = 12;
	$total_count = $db->counter('h_member_farm', "h_userName = '{$memberLogged_userName}' and h_isEnd = 0", 'id');
	$page = (int)$page;
	//if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select * from `h_member_farm` where h_userName = '{$memberLogged_userName}' and h_isEnd = 0 order by h_addTime desc,id desc LIMIT $from_record, $list_num";

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
                                
			$idIndex = 618100 + $val['id'];
			
			if($val['h_settleLen'] <= 0){
				$bfb = 0;
			}else{
				$bfb = floatval($val['h_settleLen']) / floatval($val['h_life']) * 100;
			}
			echo '<div class="col-sm-6 col-md-3">
    <div class="thumbnail">
      <img src="' , $val['h_pic'] , '">
      <div class="caption">
        <h3>' , $val['h_title'] , $idIndex , '号 <span class="badge">' , $val['h_num'] , '</span></h3>
        <p>
  <div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: ' , $bfb , '%;">
    ' , $val['h_settleLen'] , '天
  </div>
  </div>
  		<p>已产出: <strong>' , ($val['h_point2Day'] * $val['h_num'] * $val['h_settleLen']) , ' 元</strong>/待产出: <strong>' , ($val['h_point2Day'] * $val['h_num'] * ($val['h_life'] - $val['h_settleLen'])) , ' 元</strong></p>
        <p>购买日期:' , $val['h_addTime'] , '</p>
       
      </div>
    </div>
  </div>';
		}
	}

	echo '<div class="clear"></div>';
	if(count($rs_list) > 0) echo $page_list;

	//<div class='clearfix'><div class='btn-group pull-left' role='group'><a class='btn btn-default' href='#' role='button'>首页</a><a class='btn btn-default' href='#' role='button'>上一页</a><a class='btn btn-default' href='#' role='button'>下一页</a><a class='btn btn-default' href='#' role='button'>尾页</a></div><div class='pull-right pt1'>&nbsp;页次：<strong><font color=red>1</font>/1</strong>页 &nbsp;共<b><font color='#FF0000'>19</font></b>条记录</div></div>
}
?>
<?php
require_once 'inc_footer.php';
?>
