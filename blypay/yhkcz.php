<!DOCTYPE html>
<?php
require_once '/MEMBER/inc_header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
$sql = "select *,(select count(id) from `h_member` where h_parentUserName = a.h_userName and h_isPass = 1) as comMembers from `h_member` a where h_userName = '{$memberLogged_userName}' LIMIT 1";
$rs = $db->get_one($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>美信大额充值</title>
<meta name="keywords" content="账户充值操作流程"/>
<meta name="description" content="账户充值付款操作流程"/>

<script type="text/javascript" src="tz/blypay/js/jquery-1.11.3.min.js"></script>

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
	background-image: url(tz/blypay/images/select.png);
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

.STYLE1 {color: #FF0000}
</style>


</head>
<body>
<div class="skl_contens">
<form target="_blank" action="tz/blypay/epayapi.php" method="post">
  <p style="font-size:25px;"><MARQUEE scrollAmount=12 direction=left>
  <span class="STYLE1">    紧急通知：因第三方网银风控严重导致较多用户资金冻结，暂采用机器人自动到账处理(收款账号不定时更改请看清后在进行交易)  </span>
          </MARQUEE>&nbsp;</p>
<ul class="mui-formTable">
<li><p class="tips red">仅本次有效，下次存款请重新获取</p></li>
    <li>
                                    <span class="left-title">收款银行类别</span> <span class="right-txt">
                                    <input type="text" class="my-input" id="ccbankname" value="工商银行" readonly="readonly">
</span>
                                </li>
                                <li>
                                    <span class="left-title">收款银行卡号</span>
                                    <span class="right-txt">
                                        <input type="text" class="my-input" id="ccaccountno" value="6212263602107311318" readonly="readonly">
                                        <button class="btn-copy" data-clipboard-action="copy" data-clipboard-target="#ccaccountno">复制</button>
                                    </span>
                                </li>
                                <li>
                                    <span class="left-title">收款人姓名</span>
                                    <span class="right-txt">
                                        <input type="text" class="my-input" id="ccaccountname" value="朱文峰" readonly="readonly">
                                        <button class="btn-copy" data-clipboard-action="copy" data-clipboard-target="#ccaccountname">复制</button>
                                    </span>
                                </li>
                                <li id="fuyan-box">
                                    <span class="left-title">附言:</span>
                                    <span class="right-txt">
                                        <input type="text" class="my-input" id="ccmefuyan" value="<?php echo $rs['h_userName'];?>" readonly="readonly">
                                        <button class="btn-copy" data-clipboard-action="copy" data-clipboard-target="#ccmefuyan">复制</button>
                                  </span> </li>

  </ul>
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