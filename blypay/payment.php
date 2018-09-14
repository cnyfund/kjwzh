<?php
$out_trade_no = time().rand(1000,9999);
$money = $_POST['skl_custom_money'];
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="zh-cn">
<meta name="renderer" content="webkit">
<title>美信云支付 - <?php echo $out_trade_no; ?></title>
<link href="assets/css/wechat_pay.css" rel="stylesheet" media="screen">
<style type="text/css">
img.logo{width:14px;height:14px;margin:0 5px 0 3px;}
li{float: left;margin-left: 16px;margin-bottom: 35px;}
</style>
</head>
<body>
<div class="body">
<h1 class="mod-title">
<span class="text">美信云支付</span>
</h1>
<div class="mod-ct">
<div class="order">
</div>
<div class="amount">￥<?php echo $money; ?></div>
<h2>请选择支付方式：<h2><br/>
<ul>
	<li>
				<a href="zfb.jpg">
			<label>
				<img src="assets/img/alipay.gif" title="支付宝"/>
			</label>
		</a>
	</li>
		</a>
	</li>
		
	<li>
		<a href="wx.png">
			<label>
				<img src="assets/img/weixin.gif" title="微信支付"/>
			</label>
		</a>
	</li>
</ul>

<div class="detail" id="orderDetail">
<dl class="detail-ct" style="display: none;">
<dt>商家</dt>
<dd id="storeName">美信金融</dd>
<dt>购买物品</dt>
<dd id="productName">投资股权</dd>
<dt>商户订单号</dt>
<dd id="billId"><?php echo $out_trade_no; ?></dd>
<dt>创建时间</dt>
<dd id="createTime"><?php echo date("Y-m-d H:i:s"); ?></dd>
</dl>
<a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
</div>
<div class="tip">
<span class="dec dec-left"></span>
<span class="dec dec-right"></span>
<div class="tip-text">
<p>请选择一种支付方式完成支付</p>
</div>
</div>
</div>
</div>
<script src="assets/js/qcloud_util.js"></script>
<script>
    // 订单详情
    $('#orderDetail .arrow').click(function (event) {
        if ($('#orderDetail').hasClass('detail-open')) {
            $('#orderDetail .detail-ct').slideUp(500, function () {
                $('#orderDetail').removeClass('detail-open');
            });
        } else {
            $('#orderDetail .detail-ct').slideDown(500, function () {
                $('#orderDetail').addClass('detail-open');
            });
        }
    });
</script>
</body>
</html>