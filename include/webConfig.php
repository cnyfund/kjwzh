<?php
//主要配置数据
$webInfo = $db->get_one("SELECT * FROM `h_config`");
//是否开启伪静态，0为关闭，1为开启
$rewriteOpen = $webInfo['h_rewriteOpen'];
//$rewriteOpen = 0;

$APIKEY = $webInfo['h_tradeex_test_api_key'];
$SECRETKEY = $webInfo['h_tradeex_test_api_secret'];
$PROXY_APIKEY = $webInfo['h_proxy_api_key'];
$PROXY_SECRETKEY = $webInfo['h_proxy_api_secret'];
$DEVSITE = $webInfo['h_test_tradeex_hostname'];
$PRODSITE = $webInfo['h_prod_tradeex_hostname'];
$NOTIFYSITEPROD = $webInfo['h_prod_notify_hostname'];
$NOTIFYSITEDEV = $webInfo['h_test_notify_hostname'];
$REDEEMTARGETCNYFADDRESS = $webInfo['h_tradeex_cnyf_address'];
$MAXPURCHASE = $webInfo['h_purchase_limit'];
$MAXREDEEM = $webInfo['h_redeem_limit'];
$MAXCNYFREDEEM = $webInfo['h_transfer_cnyf_limit'];
$INTESTMODE = $webInfo['h_is_test_mode'];

//模板编号，/templets/web/ 目录下
$templetsFolder = 'a001';
$templetsSite = 'xxx.com';
?>
