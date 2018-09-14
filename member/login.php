<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/member/logged_data.php';
isset($pageTitle) or $pageTitle ='';
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $pageTitle . $webInfo['h_webName'] . ' - ' . '会员登陆'; ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link href="/res/css/home.css" rel="stylesheet" type="text/css" media="all" />
<link href="/res/css/css.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body style="background:#fff;">

<!--top-->

<div class="top">
	<div class="box">
        <a href="/" class="return"><img src="/res/picture/return.png"></a>
        登录    
    </div>
</div>



<img src="/images/logo2.png" class="lo_logo">

<div class="login_lo"><input style="display:none;" type="checkbox" id="remember" value="1" checked='CHECKED'>
	<div class="box">
    	<div class="lo_1">
        	<img src="/res/picture/yong.png">
            <input type="text" name="textUserId" id="username" size="60" maxlength="60" style="color:#ccc" value="请输入手机号" onfocus="if(this.value=='请输入手机号'){this.value=''};this.style.color='black';" onblur="if(this.value==''||this.value=='请输入手机号'){this.value='请输入手机号';this.style.color='#ccc';}">
        </div>
        <div class="lo_1">
        	<img src="/res/picture/mi.png">
            <input type="password" name="txtPassword" id="pwd"  size="60" maxlength="60" style="color:#ccc" value="请输入密码" onfocus="if(this.value=='请输入密码'){this.value=''};this.style.color='black';" onblur="if(this.value==''||this.value=='请输入密码'){this.value='请输入密码';this.style.color='#ccc';}">
        </div>
        <a href="javascript:;" class="lo_login denglugo">登录</a>
    </div>
</div>

 <script src="/ui/js/jquery.min.js"></script>
    <script src="/ui/js/bootstrap.min.js"></script>
    <script src="/ui/js/jquery.backstretch.min.js"></script>
    <script src="/ui/layer/layer.js"></script>
    <script src="/ui/js/long.js"></script>
    
    <script>

    	$(".denglugo").click(function () {
			denglu_go();
			return false;
		});
		function denglu_go(){

			var username=$("#username").val();
			var pwd=$("#pwd").val();
			//var x3=$("#x3").val();
			var remember=$("#remember").prop('checked');
			if(username==""){
				tishi4('请输入您的玩家编号','#username')
				return false;
				}
			if(!checkMobile(username)){
				tishi4('玩家编号应该是手机号码形式的11位数字','#username')
				return false;
				}

			if(pwd==""){
				tishi4('请输入您的密码','#pwd')
				return false;
				}
/*			if(x3==""){
				tishi4('请输入验证码','#x3')
				return false;
				}*/

			var url="/member/bin.php?act=login&username="+encodeURI(username)+"&pwd="+encodeURI(pwd)+"&remember="+encodeURI(remember.toString());
			tishi2();
			$.ajax({ type : "get", async:true,  url : url, dataType : "json",
				success: function(json){
					tishi2close();
					if(json.state == true){
						//layer.alert(json.msg,function(){
							//跳转
							window.location.href = '/member/index.php';
						//});

					} else {
						layer.alert(json.msg);
					}
				},
				error:function(json){
					tishi2close();
					layer.alert('网络错误，请重新提交');
				}
			});
		}

    </script>
</body>
</html>
