<?php
//主要配置数据
$webInfo = $db->get_one("SELECT * FROM `h_config`");
echo "get webinof return " . count($webInfo) . "fields";
echo "get 7th is " . $webInfo[7];
//是否开启伪静态，0为关闭，1为开启
$rewriteOpen = (int)$webInfo[7];
$rewriteOpen = 0;

//模板编号，/templets/web/ 目录下
$templetsFolder = 'a001';
$templetsSite = 'xxx.com';
?>
