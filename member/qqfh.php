<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '';

require_once 'inc_header.php';
?>
<div class="head">
        <a href="/member/index.php"><input type="image" class="head-icon-left" src="mod/images/common_back.png" style="border-width:0px;"></a>
        <div class="head-title">全球分红</div>
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

	<div class="ssss" style=" padding:0 20px">
	<p style="font-size:16px; font-weight:bold">全球分红奖将于每日晚上24:00后系统自动计算，达到要求将会发送当日总业绩奖励！</p>
	</div>






</div>





</div>
<!--MAN End-->
</div></div>

<?php
require_once 'inc_footer.php';
?>