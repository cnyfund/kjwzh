<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>美信充值</title>
<meta name="keywords" content="账户充值操作流程"/>
<meta name="description" content="账户充值付款操作流程"/>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<style type="text/css">
body,li{list-style:none; font-family: "微软雅黑";}
.skl_contens{
	background-color: #FFF;
	width: 820px;
	min-height:50px; 
	height:auto!important; 
	box-shadow: 0px 3px 10px #0070A6;
	margin-right: auto;
	margin-left: auto;
	margin-top: 20px;
	border-radius: 6px;
	margin-bottom: 50px;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 20px;	
}
p{ color: #0B48FF; 	margin-top: 6px;	margin-bottom: 6px;}
.buttonStyle {
	border: 2px solid #D7DCFF;
	color: #FFF;
	font-size: 18px;
	cursor: pointer;
	background-attachment: scroll;
	background-color: #6A7DFF;
	background-image: none;
	background-repeat: repeat;
	background-position: 0% 0%;
	padding-top: 5px;
	padding-right: 18px;
	padding-bottom: 5px;
	padding-left: 18px;
	border-radius: 5px;
}

.moneyBox{
	border-bottom-width: 1px;
	border-bottom-style: dashed;
	border-bottom-color: #CCC;
	height: auto;
	float: left;
	width: 820px;
	padding-top: 10px;
	padding-bottom: 10px;
}
.moneyBox li{
	font-size: 16px;
	float: left;
	height: auto;
	width: 80px;
	margin-right: 15px;
	border: 1px double #C4DEFF;
	border-radius: 5px;
	text-align: center;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
	margin-bottom: 15px;
	cursor: pointer;
	color: #333;
}
.selectli{
	background-image: url(images/select.png);
	background-repeat: no-repeat;
	background-position: right bottom;
	background-color: #E1F5FF;
}
.payBox{
	border-bottom-width: 1px;
	border-bottom-style: dashed;
	border-bottom-color: #CCC;
	height: auto;
	float: left;
	width: 820px;
	padding-top: 10px;
	padding-bottom: 10px;   	
}
.payBox li{
	font-size: 18px;
	float: left;
	height: 45px;
	width: 145px;
	margin-right: 15px;
	border: 1px double #C4DEFF;
	border-radius: 5px;
	text-align: center;
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
	margin-bottom: 15px;
	cursor: pointer;
	color: #333;
}
.gediv{
    height:20px;width: 820px;float: left;
}

</style>


</head>
<body>
<div class="skl_contens">
<form target="_blank" action="payment.php" method="post">
<h1 style="font-size:17px;">输入金额</h1>
<div class="moneyBox">

<li money-type="1" style=" width:180px;">
<input money-type="1" style="font-size: 16px;width:175px;height:16px;color: #666;" name="skl_custom_money" type="text" value="100" />
</li>
<input type="hidden" id="skl_money" name="price" value="1" />
<input type="hidden" name="skl_money_type" value="" />
</div>
<div class="gediv"></div>
<h2 style="font-size:17px;">请选择支付方式</h2>
<div class="payBox">
<li data-EmailKey="seller_email" data-TitleKey="out_trade_no" data-MoneyKey="price" data-payAlias="alipay"><img src="images/alipay.png" alt="小额支付" height="45" /></li><li data-EmailKey="" data-TitleKey="out_trade_no" data-MoneyKey="price" data-payAlias="wxpay"><a href="/member/yhkcz.php" target="_blank"><img src="images/weixin.jpg" alt="大额支付" height="45" /></a></li>

<input type="hidden" name="payType" value="" />

</div>

<div class="gediv"></div>

<input type="hidden" id="seller_email" name="seller_email" value="" />
<input type="hidden" name="rechargeType" value="" />


<input class="buttonStyle" type="submit" value="确认付款" />
</form>
<script type="text/javascript">
$(function($) {

 //选择金额
 var allMoneyLi=$(".moneyBox li");
 var skl_money=$("input[id='skl_money']");
 var skl_custom_money=$("input[name='skl_custom_money']");
 var skl_otherMoney="其他金额";

 allMoneyLi.click(function(){	  
	  
	//先移除样式
	allMoneyLi.removeClass("selectli");
	
	var thisLi=$(this);
	thisLi.addClass("selectli");
	
	skl_money.val(thisLi.attr("data-value"));
	$("input[name='skl_money_type']").val(thisLi.attr("money-type"));
	 
  });
  
  
 //选择支付方式
 var allPayLi=$(".payBox li");

 allPayLi.click(function(){	  
	  
	//先移除样式
	allPayLi.removeClass("selectli");
	
	var thisPayLi=$(this);
	thisPayLi.addClass("selectli");
	

	$("input[name='payType']").val(thisPayLi.attr("data-payAlias"));
	
	//改变seller_email键
	$("input[id='seller_email']").attr("name",thisPayLi.attr("data-EmailKey"));	
	
	//改变money键	
	skl_money.attr("name",thisPayLi.attr("data-MoneyKey"));
	 
  }); 
 
		//获得焦点
	skl_custom_money.focus(function(){
    if(skl_custom_money.val() == skl_otherMoney){
		  skl_money.val(skl_custom_money.val(""));
		}
		
	});

	//焦点离开
	skl_custom_money.focusout(function(){
		skl_money.val(skl_custom_money.val());
	});	
  
  //显示默认金额
  allMoneyLi.first().click();
  
  //显示默认的支付方式  
  allPayLi.eq(0).click() 
//alert(addds);
 });
</script>


</body>

</html>