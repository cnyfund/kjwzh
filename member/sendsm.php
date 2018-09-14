<?php
/*--------------------------------
功能:		使用smsapi.class.php类发送短信
说明:		http://api.sms.cn/sms/?ac=send&uid=用户账号&pwd=MD5位32密码&mobile=号码&content=内容
官网:		www.sms.cn
状态:		{"stat":"100","message":"发送成功"}

	100 发送成功
	101 验证失败
	102 短信不足
	103 操作失败
	104 非法字符
	105 内容过多
	106 号码过多
	107 频率过快
	108 号码内容空
	109 账号冻结
	112	号码错误
	116 禁止接口发送
	117 绑定IP不正确
	161 未添加短信模板
	162 模板格式不正确
	163 模板ID不正确
	164 全文模板不匹配
--------------------------------*/

include 'smsapi.class.php';

$cs=trim($_POST["c"]);
$mobile=trim($_POST["mobile"]);

if($cs=="reg"){

//接口账号
$uid = 'qwe3362';

//登录密码
$pwd = '3362asd..';

$api = new SmsApi($uid,$pwd);

$code = $api->randNumber();

session_start();
$_SESSION['code']= $code;

//短信内容参数
$contentParam = array(
	'code'		=> $code
	);

//变量模板ID
$template = '400376';

//发送变量模板短信
$result = $api->send($mobile,$contentParam,$template);

if($result['stat']=='100')
{
	echo 0;
}
else
{
	echo '发送失败:'.$result['stat'].'('.$result['message'].')';
}

}

?>