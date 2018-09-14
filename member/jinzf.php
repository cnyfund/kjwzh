<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

$pageTitle = '投资进场 - ';

require_once 'inc_header.php';
?>

<div class="countgo">
<div class="zt">
<!--MAN -->
<div class="remain">

<div class="panel panel-default">
  <div class="panel-heading">金额在线支付</div>
  
   <!--ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#t1" aria-controls="home" role="tab" data-toggle="tab">支付宝支付</a></li>
    <li role="presentation"><a href="#t2" aria-controls="profile" role="tab" data-toggle="tab">微信支付</a></li>
    <li role="presentation"><a href="#t3" aria-controls="messages" role="tab" data-toggle="tab">线下支付</a></li>
  </ul-->
   <form name="myform" action="http://pay1.youyunnet.com/pay/" method="post" target="_blank">
 
 <input name="url" type="hidden" id="url" value="http://www.5yfanli.com/member/index.php" />
 <input name="pid" type="hidden" id="pid" value="2985587757" />
 <input name="data" type="hidden" id="data" value="<?php echo $_COOKIE['m_username']?>" />
<div class="panel-body">

<br />
<input type="hidden" name="act" id="act" value="rrr">
 <div class="form-group">
    <label for="x2" class="col-sm-2 control-label">支付金额<?php echo $jiner ?></label>
    <div class="col-sm-10">
      <!--input class="form-control form-long-w1" id="ccc" name="ccc" placeholder="支付金额" value="" maxlength="10"-->
	  <select class="form-control form-long-w1" id="ccc" name="money"> 
	  <?php if($jiner){ ?>
	  <option value="<?php echo $jiner ?>" selected> <?php echo $jiner ?>元 </option>
	  <?php }else{ ?>
	  <option value="30" selected> 30元 </option>
	  <option value="300"> 300元 </option>
	  <option value="3000"> 3000元 </option> 
	  <?php } ?>
	  </select>
    </div>
  </div>
  
<br>
   <div class="form-group">
    <label for="x2" class="col-sm-2 control-label" >支付方式</label>
    <div class="col-sm-10">
        <!--<input type="radio" name="lb" value="3" checked> &nbsp;<img src="/member/weixinpay.png" height="45px; ">-->
	 <input type="radio" name="lb" value="3" checked> &nbsp;<img src="/member/weixinpay.png" title="微信付款" height="45px; ">
	 <br/><br/>

    </div>
	
  </div>

 <div class="form-group" style="">
    <div class="col-sm-offset-2 col-sm-10">

      <button type="submit" class="btn btn-warning xiugai2_go">立即支付</button>
    </div>
  </div>
<br /><br /><br />
</div>
</form>



</div>
</div>
<!--MAN End-->
<?php
require_once 'inc_footer.php';
?>