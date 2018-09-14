<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '玩家公告 - ';
$body_style ="background:#fff;";
require_once 'inc_header.php';
?>

<?php
news_list();
function news_list(){
	global $rewriteOpen,$db;
	global $page,$total_count,$met_pageskin;
	global $mid,$mType,$mTitle,$mPageKey;
	global $cid,$cPageKey;
	$mid = 111;
	$total_count = $db->counter('h_article', "h_menuId = 108", 'id');
	$page = (int)$page;
	if($page_input){$page=$page_input;}
	$list_num = 10;
	$met_pageskin = 5;
	$rowset = new Pager($total_count,$list_num,$page);
	$from_record = $rowset->_offset();
	$query = "select * from `h_article` where h_menuId = 108 order by h_addTime desc,id desc LIMIT $from_record, $list_num";
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

	echo '
<div class="content1">
    <div class="con_title">
        <div class="box">
			<span style="width:80%;">标题</span>
			<span style="width:20%;">发布时间</span>

        </div>
    </div>
    	<ul class="con_rec">';

	if(count($rs_list) > 0)
	{
		foreach ($rs_list as $key=>$val)
		{
			echo '<li>
                <span style="width:80%;">[系统公告] <a href="/member/news-show.php?id=' , $val['id'] , '">' , $val['h_title'] , '</a></span>
                <span style="width:20%;">' , $val['h_addTime'] , '</span>
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

	//<div class='clearfix'><div class='btn-group pull-left' role='group'><a class='btn btn-default' href='#' role='button'>首页</a><a class='btn btn-default' href='#' role='button'>上一页</a><a class='btn btn-default' href='#' role='button'>下一页</a><a class='btn btn-default' href='#' role='button'>尾页</a></div><div class='pull-right pt1'>&nbsp;页次：<strong><font color=red>1</font>/1</strong>页 &nbsp;共<b><font color='#FF0000'>19</font></b>条记录</div></div>
	
	echo '</ul>';
}
?>

                
                
                
            </div>
       
<?php
require_once 'inc_footer.php';
?>