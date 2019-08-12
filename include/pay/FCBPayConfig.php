<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

/**
 * 
 * 配置账号信息
 *
 */
class FCBPayConfig {

    //=======【基本信息设置】=====================================
    //
	/**
     * TODO: 修改这里配置为您自己申请的开发者信息
     * 钱包信息配置
     * APPID：应用ID（必须配置，汇钱包后台查看）
     * KEY：开发者签名密钥（必须配置，登录商户平台自行设置）
     * DEVACCOUNTID：开发者账户ID（选填，使用绑定用户功能设置）
     * DEVOPENID：开发者开通ID（选填，使用绑定用户功能设置）
     * VERSION:版本号
     * CHARSET：编码格式
     * SIGNTYPE：签名类型
     * **METHOD：方法名
     * **URL：请求地址
     **/


    const DEVACCOUNTID = '';
    const DEVOPENID = '';
    const NOTIFYURL = 'http://';
    const BINDRETURNURL = 'http://';
    const PAYNOTIFYURL = 'http://';
    const PAYRETURNURL = 'http://';
    const BINDAPPLYURL = 'https://Wallet.heepay.com/Api/v1/BindApply';
    const BINDQUERYURL = 'https://Wallet.heepay.com/Api/v1/BindQuery';
    const PAYAPPLYURL = 'https://Wallet.heepay.com/Api/v1/PayApply';
    const PAYQUERYURL = 'https://Wallet.heepay.com/Api/v1/PayQuery';
    const PAYCLOSEURL = 'https://Wallet.heepay.com/Api/v1/PayClose';
    const ACCOUNTVERITYURL = 'https://Wallet.heepay.com/Api/v1/AccountVerify';
    const PAYAPPLYMETHOD = 'wallet.trade.buy';
    const PAYQUERYMETHOD = 'wallet.trade.query';
    const PAYCLOSEMETHOD = 'wallet.trade.close';
    const REDEEMMETHOD = 'wallet.trade.sell';
    const VERSION = '1.0';
    const CHARSET = 'utf-8';
    const SIGNTYPE = 'MD5';

 }
