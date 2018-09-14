<?php
require_once "pay.php";
$pay = new pay();


$config['notify_url'] = 'http://test.com/notify';
$config['return_url'] = 'http://test.com/return';
$config['out_trade_no'] = time();
$config['subject'] = 'TEST';
$config['total_fee'] = 10;
$config['attach'] = 'userid=1';
//$config['payment_account'] = '13910978598';



$data  = $pay->applypurchase($config);

//$values = $pay->GetValues();
echo "\r\n服务器返回数据：\r\n";
print_r($data);
echo "\r\n\r\n";
//var_dump($values);