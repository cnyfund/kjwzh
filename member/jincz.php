<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '金币充值 - ';

$body_style ="background:#fff;";
require_once 'inc_header.php';
?>


     <form name="myform" action="pay.php" method="post" >
 <input name="data" type="hidden" id="data" value="<?php echo $_COOKIE['m_username']?>" />
   
<div class="panel-body" style="margin-top:56px;">
<!--p>请先添加客服1号微信号：<strong style="color:#FF0000">fengyun1060</strong><br/>
转账后提供您的会员编号，3分钟内充值到账</p>
<img style=" max-width:300px" src="/images/cfjy_kefu.jpg" /><br/>
<span>提醒：财富家园预计1月12号之前开通在线支付，自动充值到账提现，请留意公告</span-->
<br />
<input type="hidden" name="act" id="act" value="rrr">
 <div class="form-group">
    <label class="col-sm-2 control-label">充值金额(元)</label>
    <div class="col-sm-10">
	<input name="ccc" type="txt" id="ccc" value="100"  class="form-control form-long-w1" placeholder="充值金额" />
      <!--input class="form-control form-long-w1" id="ccc" name="ccc" placeholder="充值金额" value="" maxlength="10"-->
	  <!--select class="form-control form-long-w1" id="ccc" name="ccc"> 
      <option value="100" selected> 100元 </option>
	  <option value="300" selected> 300元 </option>
      <option value="500"> 500元 </option>
       <option value="1000" > 1000元 </option>
        <option value="3000"> 3000元 </option>
         <option value="5000" > 5000元 </option>
	 
	    
	  </select-->
    </div>
  </div>
  
<br>


   <!--div class="form-group" >
    <label class="col-sm-2 control-label" >充值方式</label>
    <div class="col-sm-10">
      <input type="radio" name="channel" value="qypay" checked="checked"> &nbsp;支付宝支付
      <input type="radio" name="channel" value="wxpay" checked="checked"> &nbsp;微信支付
      

    </div>
  </div-->

 <div class="form-group" style="">
    <div class="col-sm-offset-2 col-sm-10">

      <button type="submit" class="lo_login">立即充值</button>
    </div>
  </div>
<br /><br /><br />
</div>
</form>
<script>
$(".lo_login").click(function () {
	layer.load(0, {time: 60*1000});
});
</script>

<!-- 弹出层部分end -->

<!--MAN End-->
<?php
require_once 'inc_footer.php';
?>