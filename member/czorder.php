<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '元充值 - ';

require_once 'inc_header.php';
?>

<div class="countgo pull-left"><div class="zt">
<!--MAN -->
<div class="remain">
<div class="gao1"></div>
<div class="page-header long-header">
  <h3>元充值 <small> 充值详情</small></h3>
</div>
<div>
<ol class="breadcrumb">
  <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <a href="/member/">主页</a></li>
  <li><a href="#">元充值</a></li>
  <li class="active">充值详情</li>
</ol>
</div>
<?php
$sql = "select * from `h_recharge` where h_bankFullname = '{$_GET['oid']}' LIMIT 1";
$rs = $db->get_one($sql);
?>

<div class="panel panel-default">
  <div class="panel-heading">充值详情</div>
  
   <!--ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#t1" aria-controls="home" role="tab" data-toggle="tab">支付宝充值</a></li>
    <li role="presentation"><a href="#t2" aria-controls="profile" role="tab" data-toggle="tab">微信充值</a></li>
    <li role="presentation"><a href="#t3" aria-controls="messages" role="tab" data-toggle="tab">线下充值</a></li>
  </ul-->

<div class="panel-body">


<br />
<input type="hidden" name="act" id="act" value="rrr">
 <div class="AAA">
    <label for="x2" class="col-sm-2 control-label">充值金额</label>
    <div class="col-sm-10">
      <?php echo $rs['h_money']; ?> 元
	 
    </div>
  </div>
<br />
   <div class="AAA">
    <label for="x2" class="col-sm-2 control-label" >充值方式</label>
    <div class="col-sm-10">
      
	 <?php if($rs['h_bank']==1) {echo'<img src="/member/weixinpay.png" height="50px;">'; } 
if($rs['h_bank']==2) {echo'<img src="/member/alipay.png" height="45px; "> '; } 
	 ?><br />
	  
    </div>
  </div>
<br />
     <!--div class="AAA">
    <label for="x2" class="col-sm-2 control-label" >充值状态</label>
    <div class="col-sm-10">
      
	 <?php if($rs['h_state']==1) {echo'充值成功'; } 
	 if($rs['h_state']==0) {echo'等待付款确认'; } 
	  if($rs['h_state']==2) {echo'充值失败'; } 
	 ?><br />
	  
    </div>
  </div-->

<p style=" padding:0 15px"><strong style="color:#FF0000">请用 <?php if($rs['h_bank']==1) {echo'微信'; } 
if($rs['h_bank']==2) {echo'支付宝'; } 
	 ?> 扫描以下二维码进行支付充值金额，支付成功后加客服微信：gxjj333 。1-3分钟内到达账户。</strong><br/>
</p>
<p></p>
<?php if($rs['h_bank']==1) {echo'<img style=" max-width:300px" src="/images/weixin.png"/>'; } 
if($rs['h_bank']==2) {echo'<img style=" max-width:300px" src="/images/.png"/>'; } 
	 ?>
<br/>
</div>




</div>
</div>
<!--MAN End-->
<?php
require_once 'inc_footer.php';
?>