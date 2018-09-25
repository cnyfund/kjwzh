<?php
require_once "PayException.php";
class pay{
	    //默认配置
    protected $values = array(
		'version'			=>	'1.0', //版本号
		'charset'			=>	'utf-8',
		'sign_type'			=> 'MD5',
    );
	//protected $api_key =  '1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ';
        protected $api_key =  'UN57QVEE9RIS858PJ5GUAP2Y7WUS2VUO';
        
	//protected $secret_key =  'a6d6df9303ae9f6fd8dbb6a5807548b';
        protected $secret_key =  '93a3a0f5c46c7111a4d880583ab06a19';
	protected $debug_info = array();
	//protected $IsTest = true;
        protected $IsTest = true;

	 
    /**
     * 类架构函数
     * Auth constructor.
     */
    public function __construct(){
		$this->SetValue('api_key',$this->api_key);
		$this->SetValue('timestamp',date('YmdHis'));
    }
	
	/* 申请充值 */
	public function applypurchase($biz_content=array()){
		if($this->IsTest){
			$api = 'http://54.203.195.52/api/v1/applypurchase/';
		}else{
			$api = 'http://cnytrx.uuvc.com/api/v1/applypurchase/';
		}
		
		$this->SetValue('method','wallet.trade.buy');
		$biz_content['api_account_type'] = 'Account';
		$biz_content['payment_provider'] = 'heepay';
		$biz_content['out_trade_no'] = "{$biz_content['out_trade_no']}";
		if(!isset($biz_content['expire_minute'])) $biz_content['expire_minute']= 30;
		if(!isset($biz_content['client_ip'])) $biz_content['client_ip']= $this->get_client_ip();
		

		if(!isset($biz_content['notify_url']) || empty($biz_content['notify_url'])){
			throw new PayException("未指定 notify_url");
		}
		if(!isset($biz_content['return_url']) || empty($biz_content['return_url'])){
			throw new PayException("未指定 return_url");
		}

		$this->SetBiz_content($biz_content);
		$this->SetSign();
		
		return $this->postJsonCurl($api,$this->values);
	}
	
	/* 提现 */
	public function applyredeem($biz_content=array()){
		if($this->IsTest){
			$api = 'http://54.203.195.52/api/v1/applyredeem/';
		}else{
			$api = 'http://cnytrx.uuvc.com/api/v1/applyredeem/';
		}
		$this->SetValue('method','wallet.trade.sell');
		$biz_content['api_account_type'] = 'Account';
		$biz_content['payment_provider'] = 'heepay';

		
		if(!isset($biz_content['expire_minute'])) $biz_content['expire_minute']= 30;
		if(!isset($biz_content['client_ip'])) $biz_content['client_ip']= $this->get_client_ip();
		
		if(!isset($biz_content['notify_url']) || empty($biz_content['notify_url'])){
			throw new PayException("未指定 notify_url");
		}
		if(!isset($biz_content['return_url']) || empty($biz_content['return_url'])){
			throw new PayException("未指定 return_url");
		}

		$this->SetBiz_content($biz_content);
		$this->SetSign();
		return $this->postJsonCurl($api,$this->values);
	}
	
    /**
     * 设置开发者 业务参数集合 值
     * @param string $value 
     * */
    public function SetBiz_content($value) {
		ksort($value);
		$value = str_replace("\\/", "/", json_encode($value,320));
		//print_r($value);
		//$value = str_replace('"', '\"', $value);
        $this->values['biz_content'] = $value;
    }
	
    /**
     * 设置类型值
     * @param string $value 
     * */
    public function SetValue($name,$value) {
		if(is_array($name)){
			foreach($name as $n=>$v){
				 $this->values[$n] = $v;
			}
		}else{
			$this->values[$name] = $value;
		}
    }
	
	
    /**
     * 设置开发者 页面跳转，开发者返回地址 值
     * @param string $value 
     * */
    public function SetReturn_url($value) {
        $this->values['return_url'] = $value;
    }
	
    /**
     * 设置开发者 通知开发者地址 值
     * @param string $value 
     * */
    public function SetNotify_url($value) {
        $this->values['notify_url'] = $value;
    }
	
	public function  get_debug_info(){
		return $this->debug_info;
	}
	
    /**
     * 格式化参数格式化成url参数
     */
    public function ToUrlParams() {
        $buff = "";
        foreach ($this->values as $k => $v) {
            if ($k != "sign" && $k != "secret_key" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }
	
    /**
     * 设置签名，详见签名生成算法
     * @param string $value 
     * */
    public function SetSign() {
        $sign = $this->MakeSign();
        $this->values['sign'] = $sign;
        return $sign;
    }
	
    public function GetValues() {
        return $this->values;
    }
	
    /**
     * 生成签名
     * @return 签名，本函数不覆盖sign成员变量，可用于生成请求签名和返回数据的验签
     */
    public function MakeSign() {
        //签名步骤一：按字典序排序参数,不包含sign
        ksort($this->values);
        $string = $this->ToUrlParams();
        //签名步骤二：在string后加入KEY
        $string = utf8_encode($string . "&key=" . $this->secret_key);
		
		$this->debug_info['MD5_string'] = $string;
        //签名步骤三：MD5加密

        $string = md5($string);

        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }
	
	public function get_client_ip() {
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
			foreach ($matches[0] AS $xip) {
				if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
					$ip = $xip;
					break;
				}
			}
		}
		return $ip;
	}
	
    /**
     * 以post方式提交json到对应的接口url
     * 
     * @param string $data  需要post的json数据
     * @param string $url  url
     * @param int $second   url执行超时时间，默认30s
     * @throws HyWalletException
     */
    public function post($url, $post_data = '', $timeout = 30){//curl
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        if($post_data != ''){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        if ($res) {
			return json_decode($res,true);
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new PayException("curl出错，错误码:$error");
        }
	}
	
/**
     * 以post方式提交json到对应的接口url
     * 
     * @param string $data  需要post的json数据
     * @param string $url  url
     * @param int $second   url执行超时时间，默认30s
     * @throws HyWalletException
     */
    public function postJsonCurl($url, $jsonData, $json = true, $second = 30) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_TIMEOUT, $second); //设置超时
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        if (!empty($jsonData)) {
            if ($json && is_array($jsonData)) {
                $jsonData = str_replace("\\/", "/", json_encode($jsonData,320)); //数组转json后http://问题处理
            }

			$this->debug_info['POST_DATA'] = array(
				'url'=>$url,
				'data'=>$jsonData
			);
			
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
            if ($json) { //发送JSON数据
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length:' . strlen($jsonData))
                );
            }
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($curl);
        //返回结果
        if ($res) {

            curl_close($curl);
            $arr = json_decode($res, TRUE);
			return $arr;
           // $rep = new PayResults (); // 初始化一个对象
           // $rep->values = $arr;
            //以下为返回结果验签，如果报验签错误，请查看返回数据，打印$res
            //echo $res;
           // if ($rep->CheckSign()) {
                return $res;
            //} else {
            //    return "返回数据验签失败";
           // }
        } else {
            $error = curl_errno($curl);
            curl_close($curl);
            throw new PayException("curl出错，错误码:$error");
        }
    }
}
