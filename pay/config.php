<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
header("content-type:text/html;charset=utf-8");         //设置编码
//对应设置应用私钥
$private_key = '-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMq4rToUyKSC2PA8
sHq4olwFmYtNYqREtilYLzlzTYpIl56xfSmoTmbDEAoY93b+azsRu6EFMoGmvU3D
WJ1JN83+2yuTzYlDl4tqybVPxiaiCU+P9k6NbX9PGRw0ohv6utAOxkKW+YziTO/A
9gqMRXmWLPxa4o3OZyzC80sMpx8hAgMBAAECgYB/9TfqfGn1ZV43racbn2VkPmif
xDXqSDDPQgl08vHTwmRp19CQNdtfA+sg5Id3Rbo7q8LKLXSm36+H4TES/r9Ilv1R
YKS/cRKGhq4FAXuoU9E70WT1dOHNvCr6QJEbT1l7mUPiNFdUKiBZp5Y18souZeBm
cBx60gyurRFJICq20QJBAP+3qQPHbZRpCxfc81LOWWaBZTNKArVVu6lP9chr7MHd
8QsFk0Eb1PvRl9E3jbkXAvHpzu/eraOVU7RIUOSRHoUCQQDK8gZBGEiD1NN6RjCZ
Mu2ImvWzn3l/aoTztpT7s85FJ4krU0AoULweOYYdk7crkKFtuwQTXJNx71gQynA3
18btAkEArPpjzjadHYNhCadgwWbseraU6njqFBgGdaWtMQIwiYPEhhwjXCujiyRg
ehoGOGokh9gNL52F/94HXTB9599ysQJAFNAHRiu4XBS6b2K9Xyiy5XyG0Bn9usxw
wBGsa7e/4qWwUooiHUBSWoMptuTMNyKI+5jfTSEEWf3iuS4ZnhB57QJBAKIBgZDs
UUkopJYIpOgAIjNKqMQs6I9PaJ0p6Dl1XK8WtGNPAcsLs+3B94YXFZqrTFOpVI2J
OeGZ26onNSj1H1U=
-----END PRIVATE KEY-----';

//对应平台中的系统公钥（并非应用公钥）
	$public_key = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkIZdzmyCVfl2Qw9KiS8PL6S7k26G+M+j
avh1LD41HxVzK/H9PlAotQ/+8Wp62INYLvKubedxjHuJuXCwUSo04mdiM0vcOeNOHXOIoev++yy+
EIUiQT4AuFvs/lni2WRw8BpxVuypNgw30+pNhGHkPmLVUNpYq+KD8iJm3VgdQ9yRPGPEHJXFCNYB
WVPKW3Gnk7zCA7Rxz1bBnHimXbuXMH0znR+pqag3QGhoVDSCnFUVsc2pSc9hNk09R6VnF2Et4LNT
iR7g8eovxTPWFJeYcqVg31bzajT1rUEZO+xNdW7AA30nMf+jPexFb6a6wuz1dGzn7vzVzgQ4Cq5c
sYOadQIDAQAB
-----END PUBLIC KEY-----';



//对应平台中的系统公钥（并非应用公钥）
$public_key2 = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkIZdzmyCVfl2Qw9KiS8PL6S7k26G+M+j
avh1LD41HxVzK/H9PlAotQ/+8Wp62INYLvKubedxjHuJuXCwUSo04mdiM0vcOeNOHXOIoev++yy+
EIUiQT4AuFvs/lni2WRw8BpxVuypNgw30+pNhGHkPmLVUNpYq+KD8iJm3VgdQ9yRPGPEHJXFCNYB
WVPKW3Gnk7zCA7Rxz1bBnHimXbuXMH0znR+pqag3QGhoVDSCnFUVsc2pSc9hNk09R6VnF2Et4LNT
iR7g8eovxTPWFJeYcqVg31bzajT1rUEZO+xNdW7AA30nMf+jPexFb6a6wuz1dGzn7vzVzgQ4Cq5c
sYOadQIDAQAB
-----END PUBLIC KEY-----';


//支付完成回调地址
$CallBackUrl="http://www.gdy2.com/pay/callback.php";


//应用ID
$AppId="20180224800000106";
//货币类型
$Currency="CNY";

$toAccountType = 'D0';

//支付通道类型
if(!isset($channel))$channel="yb_pc";

//加签名函数
function rsaSign($data,$res) {
	
    openssl_sign($data, $sign, $res);
    openssl_free_key($res);
    //base64编码
    $sign = base64_encode($sign);
    return $sign;
}
/**
 * 验证签名
 * @param $prestr 需要签名的字符串
 * @param $sign 签名结果
 * return 签名结果
 */
function rsaVerify($prestr, $sign,$pkeyid) {
	
	
	/*//将字符串格式公私钥转为pem格式公私钥

  //转换为openssl密钥，必须是没有经过pkcs8转换的公钥
  $res = $pkeyid;
  //url解码签名
  $signUrl = urldecode($sign);
  //base64解码签名
  $signBase64 = base64_decode($signUrl);
  //调用openssl内置方法验签，返回bool值
  echo $result = openssl_verify($prestr, $signBase64, $res);

	
	exit("###");*/
	
	
	/////////////////	
	 
	$sign = base64_decode($sign);
	
	$str ="sign:".$sign;
 	file_put_contents( "success.txt",$str."\n", FILE_APPEND);
	
    if ($pkeyid) {
        $verify = openssl_verify($prestr, $sign, $pkeyid);
        openssl_free_key($pkeyid);
		
		$str ="verify:".$verify;
 		file_put_contents( "success.txt",$str."\n", FILE_APPEND);
		
    }
	
    if($verify == 1){
        return true;
    }else{
        return false;
    }
}
function HttpPost($url,$param)//
{
	$ch = curl_init(); //初始化curl
	curl_setopt($ch, CURLOPT_URL, $url);//设置链接
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
	curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);//POST数据
	$response = curl_exec($ch);//接收返回信息
	if(curl_errno($ch)){//出错则显示错误信息
		print curl_error($ch);
	}
	curl_close($ch); //关闭curl链接
	return $response;//显示返回信息
}

/**
 * 日志记录，按照"Y-m-d.log"生成当天日志文件
 * 日志路径为：入口文件所在目录/logs/$type/当天日期.log.php，例如 /logs/error/2018-01-05.log
 * @param string $content 日志内容
 * @param string $type 对应logs目录下的子文件夹名
 * @return bool true/false 返回写入的字符数，出现错误时则返回 FALSE 。
 */
function writelog($content = "", $type = "")
{
    date_default_timezone_set('PRC');
    //判断日志根目录是否存在，不存在则创建
    $log_root = getcwd() . DIRECTORY_SEPARATOR . 'logs';
//    $log_root = ROOT_PATH . 'logs';

    if (!is_dir($log_root)) {
        mkdir($log_root, 0777);
    }

    //如传入第二个参数，则生成子文件夹；否则在根目录创建日志
    if ($type) {
        $dir = $log_root . DIRECTORY_SEPARATOR . $type;
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                return false;
            }
        }
    } else {
        $dir = $log_root;
    }
    $filename = $dir . DIRECTORY_SEPARATOR . date("Y-m-d") . '.log';
    if (is_array($content)) {
        $content = print_r($content, true);
    }

    $ss = '';
    for ($i = 1; $i <= 115; $i++) {
        $ss .= '-';
    }
    $exec_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
    //组装数据
    $str = "\r\n" . 'time:' . date("Y-m-d H:i:s")
        . "\r\n" . 'exec_url:' . $exec_url;
    $str .= "\r\n" . 'content:' . $content
        . "\r\n"
        . $ss;
    if (!$fp = @fopen($filename, "ab")) {
        return false;
    }
    flock($fp, LOCK_EX);
    $res = fwrite($fp, $str);
    flock($fp, LOCK_UN);
    fclose($fp);
    return $res;
}



function format_secret_key($secret_key, $type){
  //64个英文字符后接换行符"\n",最后再接换行符"\n"
  $key = (wordwrap($secret_key, 64, "\n", true))."\n";
  //添加pem格式头和尾
  if ($type == 'pub') {
    $pem_key = "-----BEGIN PUBLIC KEY-----\n" . $key . "-----END PUBLIC KEY-----\n";
  }else if ($type == 'pri') {
    $pem_key = "-----BEGIN RSA PRIVATE KEY-----\n" . $key . "-----END RSA PRIVATE KEY-----\n";
  }else{
    echo('公私钥类型非法');
    exit();
  }
  return $pem_key;
}









?>