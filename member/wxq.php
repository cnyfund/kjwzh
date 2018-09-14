<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '';

require_once 'inc_header.php';
?>
<div class="head">
        <a href="/member/index.php"><input type="image" class="head-icon-left" src="mod/images/common_back.png" style="border-width:0px;"></a>
        <div class="head-title">加入官方微信群</div>
        <a href="/member/index.php" class="head-icon-right  "><img src="mod/images/home_right.png"></a>
    </div>
<div class="countgo pull-left"><div class="zt">
<!--MAN -->
<div class="remain">


<?php
$sql = "select *";
$sql .= ",(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers";
$sql .= ",(select sum(h_price) from `h_log_point2` where h_userName = a.h_userName and h_price > 0) as point2sum";
$sql .= " from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>


<div class="wxq">

	<span>扫描二维码添加群主微信，会邀请您加入官方群</span>
   <p></p>
	<img src="mod/images/weixinhao.png"/>





</div>





</div>
<!--MAN End-->
</div></div>

<?php
require_once 'inc_footer.php';
?>