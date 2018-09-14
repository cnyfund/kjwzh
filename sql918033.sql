/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50554
Source Host           : localhost:3306
Source Database       : sql918033

Target Server Type    : MYSQL
Target Server Version : 50554
File Encoding         : 65001

Date: 2018-08-16 13:10:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blypay_order
-- ----------------------------
DROP TABLE IF EXISTS `blypay_order`;
CREATE TABLE `blypay_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(50) DEFAULT '',
  `orderid` varchar(50) NOT NULL DEFAULT '' COMMENT '订单号',
  `amout` float(10,2) NOT NULL DEFAULT '0.00',
  `addtime` datetime DEFAULT NULL COMMENT '充值时间',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `bank` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='充值记录';

-- ----------------------------
-- Records of blypay_order
-- ----------------------------
INSERT INTO `blypay_order` VALUES ('1', '18600701961', '201807302118271240', '300.00', '2018-07-30 21:18:27', '0', '10');
INSERT INTO `blypay_order` VALUES ('2', '15049049052', '201807310835538775', '300.00', '2018-07-31 08:35:53', '0', '10');
INSERT INTO `blypay_order` VALUES ('3', '15049049052', '201807310836122958', '300.00', '2018-07-31 08:36:12', '0', '10');

-- ----------------------------
-- Table structure for h_admin
-- ----------------------------
DROP TABLE IF EXISTS `h_admin`;
CREATE TABLE `h_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(50) DEFAULT NULL,
  `h_passWord` varchar(50) DEFAULT NULL,
  `h_nickName` varchar(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '1',
  `h_addTime` datetime DEFAULT NULL,
  `h_permissions` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_admin
-- ----------------------------
INSERT INTO `h_admin` VALUES ('5', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '技术账号', '1', null, ',基本配置,推荐会员提成配置,提现配置,玩家公告,会员列表,会员物品列表,推荐结构,商城商品管理,商城订单列表,会员登录记录,加减积分,充值管理,提现管理,会员消息列表,发送消息给会员,收到的会员消息,清空数据,调整时间,帐号管理,');

-- ----------------------------
-- Table structure for h_article
-- ----------------------------
DROP TABLE IF EXISTS `h_article`;
CREATE TABLE `h_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_location` varchar(20) DEFAULT NULL,
  `h_menuId` int(11) DEFAULT NULL,
  `h_title` varchar(250) DEFAULT NULL,
  `h_pageKey` varchar(250) DEFAULT NULL,
  `h_categoryId` int(11) DEFAULT '0',
  `h_picSmall` varchar(250) DEFAULT NULL,
  `h_picBig` varchar(250) DEFAULT NULL,
  `h_picBig2` varchar(250) DEFAULT NULL,
  `h_picBig3` varchar(250) DEFAULT NULL,
  `h_picBig4` varchar(250) DEFAULT NULL,
  `h_picBig5` varchar(250) DEFAULT NULL,
  `h_picBig6` varchar(250) DEFAULT NULL,
  `h_picBig7` varchar(250) DEFAULT NULL,
  `h_picBig8` varchar(250) DEFAULT NULL,
  `h_picBig9` varchar(250) DEFAULT NULL,
  `h_picBig10` varchar(250) DEFAULT NULL,
  `h_isLink` int(11) DEFAULT NULL,
  `h_href` varchar(250) DEFAULT NULL,
  `h_target` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_order` int(11) DEFAULT '0',
  `h_clicks` int(11) DEFAULT '0',
  `h_keyword` text,
  `h_description` text,
  `h_info` text,
  `h_jj` text,
  `h_dataSheet` varchar(250) DEFAULT NULL,
  `h_download` varchar(250) DEFAULT NULL,
  `h_pm` varchar(250) DEFAULT NULL,
  `h_pfwz` varchar(250) DEFAULT NULL,
  `h_cz` varchar(250) DEFAULT NULL,
  `h_gy` varchar(250) DEFAULT NULL,
  `h_ys` varchar(250) DEFAULT NULL,
  `h_mz` varchar(250) DEFAULT NULL,
  `h_lsj` decimal(9,2) DEFAULT '0.00',
  `h_hyj` decimal(9,2) DEFAULT '0.00',
  `h_tc1` decimal(9,2) DEFAULT '0.00',
  `h_tc2` decimal(9,2) DEFAULT '0.00',
  `h_tc3` decimal(9,2) DEFAULT '0.00',
  `h_kc` int(11) DEFAULT '0' COMMENT '库存',
  `h_isPass` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=426 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_article
-- ----------------------------
INSERT INTO `h_article` VALUES ('425', '网站主栏目', '108', '去中心化POS矿池测试中！', null, '227', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2018-07-16 00:56:14', '0', '0', null, null, '全球首创的去中心化POS矿池开始上线公测了，和传统的理财平台不同，去中心化模式完全免去了中间环节，彻底消除了资金池，真正做到了点对点交易和转账，降低了运营成本和政策风险，特别是由平台的整体效益取代了传统的担保机制，进一步为平台的长期发展创造了适合的生态条件，是未来民间金融的又一个重要的创新形式。<br />\r\n<br />\r\n参与测试活动的客户注意控制规模，理性的选择挖矿周期，一但发现问题及时联系技术人员。', null, null, null, null, null, null, null, null, null, '0.00', '0.00', '0.00', '0.00', '0.00', '0', '1');

-- ----------------------------
-- Table structure for h_category
-- ----------------------------
DROP TABLE IF EXISTS `h_category`;
CREATE TABLE `h_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_location` varchar(20) DEFAULT NULL,
  `h_menuId` int(11) DEFAULT NULL,
  `h_title` varchar(250) DEFAULT NULL,
  `h_pageKey` varchar(200) DEFAULT NULL,
  `h_order` int(11) DEFAULT '0',
  `h_addTime` datetime DEFAULT NULL,
  `h_picBig` varchar(250) DEFAULT NULL,
  `h_picBigN` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_category
-- ----------------------------
INSERT INTO `h_category` VALUES ('227', '网站主栏目', '108', '玩家公告', null, '1', '2016-01-31 21:25:00', '', null);

-- ----------------------------
-- Table structure for h_config
-- ----------------------------
DROP TABLE IF EXISTS `h_config`;
CREATE TABLE `h_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_webName` varchar(50) DEFAULT NULL,
  `h_webLogo` varchar(250) DEFAULT NULL,
  `h_webLogoLogin` varchar(250) DEFAULT NULL,
  `h_webKeyword` varchar(250) DEFAULT NULL,
  `h_keyword` text,
  `h_description` text,
  `h_leftContact` text,
  `h_counter` text,
  `h_footer` text,
  `h_rewriteOpen` int(11) DEFAULT '0',
  `h_point1Member` int(11) DEFAULT '0' COMMENT '激活会员需要多少激活币',
  `h_point1MemberPoint2` int(11) DEFAULT '0' COMMENT '被激活的会员拥有多少金币',
  `h_point2Quit` int(11) DEFAULT '0' COMMENT '放弃已经拍下来的金币，扣多少金币作为惩罚',
  `h_withdrawFee` decimal(11,2) DEFAULT '0.00' COMMENT '提现手续费百分比',
  `h_withdrawMinCom` int(11) DEFAULT '0' COMMENT '提现要求至少直荐多少人',
  `h_withdrawMinMoney` int(11) DEFAULT '0' COMMENT '提现最低要求金额',
  `h_point2Lottery` int(11) DEFAULT '0' COMMENT '抽奖一次扣多少金币',
  `h_lottery1` int(11) DEFAULT '0' COMMENT '1等奖中奖概率，万分之几',
  `h_lottery2` int(11) DEFAULT '0',
  `h_lottery3` int(11) DEFAULT '0',
  `h_lottery4` int(11) DEFAULT '0',
  `h_lottery5` int(11) DEFAULT '0',
  `h_lottery6` int(11) DEFAULT '0',
  `h_point2Com1` decimal(11,2) DEFAULT '0.00' COMMENT '1代直推奖励',
  `h_point2Com2` decimal(11,2) DEFAULT '0.00',
  `h_point2Com3` decimal(11,2) DEFAULT '0.00',
  `h_point2Com4` decimal(11,2) DEFAULT '0.00',
  `h_point2Com5` decimal(11,2) DEFAULT '0.00',
  `h_point2Com6` decimal(11,2) DEFAULT '0.00' COMMENT '6-10保留，未用',
  `h_point2Com7` decimal(11,3) DEFAULT '0.000',
  `h_point2Com8` decimal(11,3) DEFAULT '0.000',
  `h_point2Com9` decimal(11,2) DEFAULT '0.00',
  `h_point2Com10` decimal(11,2) DEFAULT '0.00',
  `h_levelUpTo0` int(11) DEFAULT '0' COMMENT '升级至vip需要直荐多少人',
  `h_levelUpTo1` int(11) DEFAULT '0',
  `h_levelUpTo2` int(11) DEFAULT '0',
  `h_levelUpTo3` int(11) DEFAULT '0',
  `h_levelUpTo4` int(11) DEFAULT '0',
  `h_levelUpTo5` int(11) DEFAULT '0' COMMENT '5-10保留，未启用',
  `h_levelUpTo6` int(11) DEFAULT '0',
  `h_levelUpTo7` int(11) DEFAULT '0',
  `h_levelUpTo8` int(11) DEFAULT '0',
  `h_levelUpTo9` int(11) DEFAULT '0',
  `h_levelUpTo10` int(11) DEFAULT '0',
  `h_serviceQQ` char(255) DEFAULT NULL,
  `h_point2ComReg` int(11) DEFAULT '0' COMMENT '推荐1个注册会员送金币',
  `h_point2ComRegAct` int(11) DEFAULT '0' COMMENT '推荐的会员被激活时送金币',
  `h_point2ComBuy` int(11) DEFAULT '0',
  `h_point3ComBuy` int(11) DEFAULT '0',
  `h_point4ComBuy` int(11) DEFAULT '0',
  `h_point5ComBuy` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_config
-- ----------------------------
INSERT INTO `h_config` VALUES ('1', 'POS矿池', '/ui/images/logo.png2', '/ui/images/logo.png', 'POS矿池', 'POS矿池', 'POS矿池', '', '', '', '0', '0', '0', '0', '0.00', '0', '1', '10', '0', '0', '200', '500', '1500', '7000', '0.05', '0.03', '0.01', '0.01', '0.00', '0.00', '0.000', '0.000', '0.00', '0.00', '0', '111111', '111111', '111111', '111111', '0', '0', '0', '0', '0', '0', '全球首创去中心化POS矿池正式启航！', '0', '10', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for h_farm_shop
-- ----------------------------
DROP TABLE IF EXISTS `h_farm_shop`;
CREATE TABLE `h_farm_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_title` char(50) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_point2Day` int(11) DEFAULT '0' COMMENT '每天生产金币',
  `h_life` int(11) DEFAULT '0' COMMENT '生存周期',
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  `h_minMemberLevel` int(11) DEFAULT '0' COMMENT '购买最低会员等级',
  `h_dayBuyMaxNum` int(11) DEFAULT '0' COMMENT '每天限购数量',
  `h_allMaxNum` int(11) DEFAULT '0' COMMENT '农场中最多存在多少只',
  `h_order` int(11) DEFAULT '0',
  `h_addTime` datetime DEFAULT NULL,
  `h_location` varchar(20) DEFAULT NULL,
  `h_menuId` int(11) DEFAULT NULL,
  `cjfh` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_farm_shop
-- ----------------------------
INSERT INTO `h_farm_shop` VALUES ('126', '投资2000元', '/upload/2018/02/23/2018022323193215751.png', '1', '10', '2000', '0', '3', '300', '0', '2018-07-30 22:42:59', null, null, '2010');

-- ----------------------------
-- Table structure for h_guestbook
-- ----------------------------
DROP TABLE IF EXISTS `h_guestbook`;
CREATE TABLE `h_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_fullName` varchar(50) DEFAULT NULL,
  `h_address` varchar(250) DEFAULT NULL,
  `h_email` varchar(50) DEFAULT NULL,
  `h_phone` varchar(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '0',
  `h_addTime` datetime DEFAULT NULL,
  `h_message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_guestbook
-- ----------------------------

-- ----------------------------
-- Table structure for h_log_point1
-- ----------------------------
DROP TABLE IF EXISTS `h_log_point1`;
CREATE TABLE `h_log_point1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_price` decimal(14,2) DEFAULT '0.00',
  `h_about` varchar(250) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(50) DEFAULT NULL,
  `h_type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_log_point1
-- ----------------------------

-- ----------------------------
-- Table structure for h_log_point2
-- ----------------------------
DROP TABLE IF EXISTS `h_log_point2`;
CREATE TABLE `h_log_point2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_price` decimal(14,2) DEFAULT '0.00',
  `h_about` varchar(250) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(50) DEFAULT NULL,
  `h_type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_log_point2
-- ----------------------------
INSERT INTO `h_log_point2` VALUES ('1', '18600701961', '-1.00', '', '2018-08-14 19:59:06', '124.64.17.130', '申请提现');
INSERT INTO `h_log_point2` VALUES ('2', '18600701961', '-1.00', '', '2018-08-15 18:09:22', '113.134.238.73', '申请提现');
INSERT INTO `h_log_point2` VALUES ('3', '18600701961', '-1.00', '', '2018-08-15 18:21:47', '113.134.238.73', '申请提现');
INSERT INTO `h_log_point2` VALUES ('4', '18600701961', '-1.00', '', '2018-08-15 18:24:19', '113.134.238.73', '申请提现');
INSERT INTO `h_log_point2` VALUES ('5', '18600701961', '-1.00', '', '2018-08-15 18:27:31', '113.134.238.73', '申请提现');
INSERT INTO `h_log_point2` VALUES ('6', '15811302702', '-1.00', '', '2018-08-15 18:33:50', '118.186.231.15', '申请提现');
INSERT INTO `h_log_point2` VALUES ('7', '13800138000', '-1.00', '', '2018-08-15 18:45:40', '113.134.238.73', '申请提现');
INSERT INTO `h_log_point2` VALUES ('8', '18600701961', '-1.00', '', '2018-08-15 19:20:45', '118.186.231.15', '申请提现');
INSERT INTO `h_log_point2` VALUES ('9', '15049049052', '-2.00', '', '2018-08-15 20:30:29', '144.52.216.59', '申请提现');
INSERT INTO `h_log_point2` VALUES ('10', '15811302702', '-1.00', '', '2018-08-15 20:50:33', '118.186.231.15', '申请提现');
INSERT INTO `h_log_point2` VALUES ('11', '13800138000', '3.00', 'out_trade_no:20180816114613746710', '0000-00-00 00:00:00', '1.86.232.218', '充值');
INSERT INTO `h_log_point2` VALUES ('12', '18600701961', '2.00', 'out_trade_no:20180816120958685626', '2018-08-16 12:11:58', '118.186.231.15', '充值');
INSERT INTO `h_log_point2` VALUES ('13', '15049049052', '1.00', 'out_trade_no:20180816124706430029', '2018-08-16 12:47:58', '140.250.207.136', '充值');
INSERT INTO `h_log_point2` VALUES ('14', '15049049052', '-1.00', '', '2018-08-16 12:49:31', '140.250.207.136', '申请提现');

-- ----------------------------
-- Table structure for h_member
-- ----------------------------
DROP TABLE IF EXISTS `h_member`;
CREATE TABLE `h_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_passWord` varchar(32) DEFAULT NULL,
  `h_passWordII` varchar(32) DEFAULT NULL,
  `h_fullName` varchar(20) DEFAULT NULL,
  `h_sex` varchar(2) DEFAULT NULL,
  `h_mobile` varchar(11) DEFAULT NULL,
  `h_qq` varchar(20) DEFAULT NULL,
  `h_email` varchar(50) DEFAULT NULL,
  `h_regTime` datetime DEFAULT NULL,
  `h_regIP` char(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '0' COMMENT '是否激活，激活才能登录',
  `h_moneyCurr` decimal(9,2) DEFAULT '0.00' COMMENT '会员余额',
  `h_parentUserName` varchar(20) DEFAULT NULL,
  `h_level` int(11) DEFAULT '0',
  `h_point1` decimal(14,2) DEFAULT '0.00' COMMENT '激活币',
  `h_point2` decimal(14,2) DEFAULT '0.00' COMMENT '金币',
  `h_lastTime` datetime DEFAULT NULL,
  `h_lastIP` char(50) DEFAULT NULL,
  `h_alipayUserName` char(100) DEFAULT NULL,
  `h_alipayFullName` char(100) DEFAULT NULL,
  `h_addrAddress` char(255) DEFAULT NULL,
  `h_addrPostcode` char(20) DEFAULT NULL,
  `h_addrFullName` char(20) DEFAULT NULL,
  `h_addrTel` char(20) DEFAULT NULL,
  `h_weixin` char(100) DEFAULT NULL,
  `h_logins` int(11) DEFAULT '0',
  `h_a1` char(255) DEFAULT NULL,
  `h_q1` char(255) DEFAULT NULL,
  `h_a2` char(255) DEFAULT NULL,
  `h_q2` char(255) DEFAULT NULL,
  `h_a3` char(255) DEFAULT NULL,
  `h_q3` char(255) DEFAULT NULL,
  `h_isLock` int(11) DEFAULT '0' COMMENT '锁定，不可登录',
  `first_buy` int(1) DEFAULT '0',
  `h_jifen` int(11) NOT NULL DEFAULT '0',
  `qrcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `h_userName` (`h_userName`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_member
-- ----------------------------
INSERT INTO `h_member` VALUES ('1', '18888888888', 'a9d067bc6ec85a7dc6d119b19de794c3', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, '2018-07-30 15:19:18', '115.84.97.91', '1', '0.00', '', '4', '0.00', '0.00', '2018-08-15 18:27:51', '118.186.231.15', null, null, null, null, null, null, null, '11', null, null, null, null, null, null, '0', '0', '0', null);
INSERT INTO `h_member` VALUES ('2', '15049049052', 'bc29d0602bb644ccfb0ff7c8a5c5f7aa', 'e10adc3949ba59abbe56e057f20f883e', '汇钱包', null, null, null, null, '2018-07-30 20:28:59', '117.136.94.237', '1', '0.00', '18888888888', '4', '0.00', '1.00', '2018-08-16 12:45:23', '140.250.207.136', '15049049052', '丁云', 'undefined', 'undefined', 'undefined', 'undefined', null, '19', null, null, null, null, null, null, '0', '0', '0', null);
INSERT INTO `h_member` VALUES ('3', '18600701961', 'a9d067bc6ec85a7dc6d119b19de794c3', 'e10adc3949ba59abbe56e057f20f883e', '汇钱包', null, null, null, null, '2018-07-30 21:16:25', '182.127.170.52', '1', '0.00', '18888888888', '4', '0.00', '3.00', '2018-08-16 12:21:58', '118.186.231.15', '13910978598', '李红卫', 'undefined', 'undefined', 'undefined', 'undefined', null, '48', null, null, null, null, null, null, '0', '0', '0', null);
INSERT INTO `h_member` VALUES ('4', '15953524448', '0990b8fc85beddacbd08e48126c970de', 'e10adc3949ba59abbe56e057f20f883e', '汇钱包', null, null, null, null, '2018-07-31 14:30:47', '27.194.128.255', '1', '0.00', '18600701961', '4', '0.00', '0.00', '2018-08-16 05:14:22', '60.212.99.198', '15953524448', '汇钱包', 'undefined', 'undefined', 'undefined', 'undefined', null, '19', null, null, null, null, null, null, '0', '0', '0', null);
INSERT INTO `h_member` VALUES ('5', '13800138000', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, '2018-08-13 09:14:16', '219.144.153.113', '1', '0.00', '18600701961', '4', '0.00', '92.00', '2018-08-16 11:30:50', '1.86.232.218', '18600701961', 'test', null, null, null, null, null, '4', null, null, null, null, null, null, '0', '0', '0', null);
INSERT INTO `h_member` VALUES ('6', '15811302702', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '汇钱包', null, null, null, null, '2018-08-13 20:39:18', '124.64.17.130', '1', '0.00', '18600701961', '4', '0.00', '21.00', '2018-08-16 09:54:47', '118.186.231.15', '15811302702', '郎果兰', 'undefined', 'undefined', 'undefined', 'undefined', null, '6', null, null, null, null, null, null, '0', '0', '0', null);
INSERT INTO `h_member` VALUES ('7', '15803005053', '2569d419bfea999ff13fd1f7f4498b89', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, '2018-08-13 21:48:19', '183.228.6.37', '1', '0.00', '18600701961', '4', '0.00', '0.00', '2018-08-13 21:48:36', '183.228.6.37', null, null, null, null, null, null, null, '1', null, null, null, null, null, null, '0', '0', '0', null);

-- ----------------------------
-- Table structure for h_member_farm
-- ----------------------------
DROP TABLE IF EXISTS `h_member_farm`;
CREATE TABLE `h_member_farm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_pid` int(11) DEFAULT '0' COMMENT '动物id',
  `h_num` int(11) DEFAULT '0' COMMENT '动物数量',
  `h_addTime` datetime DEFAULT NULL COMMENT '购买时间',
  `h_endTime` datetime DEFAULT NULL COMMENT '动物死亡时间',
  `h_lastSettleTime` datetime DEFAULT NULL COMMENT '最后一次结算时间，直接在结算时记录当前时间；只用于显示或者备忘，结算算法中不用这个字段',
  `h_settleLen` int(11) DEFAULT '0' COMMENT '结算次数',
  `h_isEnd` int(11) DEFAULT '0' COMMENT '动物是否死亡',
  `h_title` char(50) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_point2Day` int(11) DEFAULT '0' COMMENT '每天生产金币',
  `h_life` int(11) DEFAULT '0' COMMENT '生存周期',
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  `cjfh` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_member_farm
-- ----------------------------

-- ----------------------------
-- Table structure for h_member_msg
-- ----------------------------
DROP TABLE IF EXISTS `h_member_msg`;
CREATE TABLE `h_member_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_toUserName` varchar(20) DEFAULT NULL COMMENT '买家',
  `h_info` text,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(39) DEFAULT NULL,
  `h_isRead` int(11) DEFAULT '0',
  `h_readTime` datetime DEFAULT NULL,
  `h_isDelete` int(11) DEFAULT '0' COMMENT '放弃或删除',
  `h_deleteTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_member_msg
-- ----------------------------

-- ----------------------------
-- Table structure for h_member_shop_cart
-- ----------------------------
DROP TABLE IF EXISTS `h_member_shop_cart`;
CREATE TABLE `h_member_shop_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_oid` varchar(20) DEFAULT NULL,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_pid` int(11) DEFAULT '0' COMMENT '动物id',
  `h_num` int(11) DEFAULT '0' COMMENT '动物数量',
  `h_addTime` datetime DEFAULT NULL COMMENT '购买时间',
  `h_title` char(50) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_member_shop_cart
-- ----------------------------

-- ----------------------------
-- Table structure for h_member_shop_order
-- ----------------------------
DROP TABLE IF EXISTS `h_member_shop_order`;
CREATE TABLE `h_member_shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_oid` varchar(20) DEFAULT NULL,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL COMMENT '购买时间',
  `h_addrAddress` char(255) DEFAULT NULL,
  `h_addrPostcode` char(20) DEFAULT NULL,
  `h_addrFullName` char(20) DEFAULT NULL,
  `h_addrTel` char(20) DEFAULT NULL,
  `h_remark` text,
  `h_state` char(20) DEFAULT NULL COMMENT '待发货、已发货、拒绝发货',
  `h_money` int(11) DEFAULT '0' COMMENT '订单总价',
  `h_isReturn` int(20) DEFAULT '0' COMMENT '若审核失败，是否返款了，只返一次',
  `h_reply` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_member_shop_order
-- ----------------------------

-- ----------------------------
-- Table structure for h_menu
-- ----------------------------
DROP TABLE IF EXISTS `h_menu`;
CREATE TABLE `h_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_location` varchar(20) DEFAULT NULL,
  `h_type` varchar(20) DEFAULT NULL,
  `h_adminFile` varchar(30) DEFAULT NULL,
  `h_title` varchar(200) DEFAULT NULL,
  `h_pageKey` varchar(200) DEFAULT NULL,
  `h_href` varchar(250) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '1',
  `h_target` varchar(10) DEFAULT NULL,
  `h_order` int(11) DEFAULT '0',
  `h_picBigWidth` int(11) DEFAULT '0',
  `h_picBigHeight` int(11) DEFAULT '0',
  `h_picSmallWidth` int(11) DEFAULT '0',
  `h_picSmallHeight` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_menu
-- ----------------------------
INSERT INTO `h_menu` VALUES ('83', '网站主栏目', 'link', 'link.php', '首页', 'index', '/', '1', '_self', '1', '0', '0', '0', '0');
INSERT INTO `h_menu` VALUES ('108', '网站主栏目', 'news', 'news.php', '玩家公告', 'wan-jia-gong-gao', 'http://', '1', '_self', '2', '600', '450', '200', '150');
INSERT INTO `h_menu` VALUES ('109', '网站主栏目', 'pics', 'pics1.php', '农场商店', 'nong-chang-shang-dian', 'http://', '1', '_self', '3', '600', '450', '200', '150');

-- ----------------------------
-- Table structure for h_pay_order
-- ----------------------------
DROP TABLE IF EXISTS `h_pay_order`;
CREATE TABLE `h_pay_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_payId` char(32) DEFAULT NULL,
  `h_orderId` varchar(32) DEFAULT NULL,
  `h_payWay` char(50) DEFAULT NULL,
  `h_payType` char(50) DEFAULT NULL,
  `h_payPrice` decimal(9,2) DEFAULT '0.00' COMMENT '打折后的金额',
  `h_addTime` datetime DEFAULT NULL,
  `h_payTime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '支付时间',
  `h_payState` char(50) DEFAULT '待支付' COMMENT '待支付、已支付、支付失败',
  `h_wxNickName` varchar(250) DEFAULT NULL,
  `h_wxOpenId` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_payId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_pay_order
-- ----------------------------

-- ----------------------------
-- Table structure for h_point2_sell
-- ----------------------------
DROP TABLE IF EXISTS `h_point2_sell`;
CREATE TABLE `h_point2_sell` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0',
  `h_alipayUserName` char(100) DEFAULT NULL,
  `h_alipayFullName` char(100) DEFAULT NULL,
  `h_weixin` char(100) DEFAULT NULL,
  `h_tel` char(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_state` char(20) DEFAULT NULL COMMENT '挂单中、等待买家付款、买家放弃、卖家放弃、等待卖家确认收款、交易完成',
  `h_buyUserName` varchar(20) DEFAULT NULL COMMENT '买家',
  `h_buyTime` datetime DEFAULT NULL,
  `h_buyIsPay` int(11) DEFAULT '0',
  `h_payTime` datetime DEFAULT NULL,
  `h_isDelete` int(11) DEFAULT '0' COMMENT '放弃或删除',
  `h_deleteTime` datetime DEFAULT NULL,
  `h_confirmTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_point2_sell
-- ----------------------------

-- ----------------------------
-- Table structure for h_point2_shop
-- ----------------------------
DROP TABLE IF EXISTS `h_point2_shop`;
CREATE TABLE `h_point2_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_title` char(255) DEFAULT NULL,
  `h_pic` char(255) DEFAULT NULL,
  `h_minComMembers` int(11) DEFAULT '0' COMMENT '至少要直荐多少人',
  `h_money` int(11) DEFAULT '0' COMMENT '售价',
  `h_minMemberLevel` int(11) DEFAULT '0' COMMENT '购买最低会员等级',
  `h_info` text,
  `h_addTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_point2_shop
-- ----------------------------

-- ----------------------------
-- Table structure for h_recharge
-- ----------------------------
DROP TABLE IF EXISTS `h_recharge`;
CREATE TABLE `h_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(50) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0',
  `h_fee` int(11) DEFAULT '0',
  `h_bank` tinyint(2) DEFAULT '0',
  `h_bankFullname` varchar(32) DEFAULT NULL,
  `h_bankCardId` varchar(32) DEFAULT NULL,
  `h_mobile` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_isRead` int(20) DEFAULT '0',
  `h_state` tinyint(20) DEFAULT NULL COMMENT '待审核、已打款、审核失败',
  `h_isReturn` int(20) DEFAULT '0' COMMENT '若审核失败，是否返款了，只返一次',
  `h_reply` char(255) DEFAULT NULL,
  `h_actIP` char(39) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_recharge
-- ----------------------------
INSERT INTO `h_recharge` VALUES ('1', '13800138000', '3', '0', '0', 'out_trade_no:2018081611461374671', null, null, '0000-00-00 00:00:00', '0', '1', '1', null, '1.86.232.218');
INSERT INTO `h_recharge` VALUES ('2', '18600701961', '2', '0', '0', 'out_trade_no:2018081612095868562', null, null, '2018-08-16 12:11:58', '0', '1', '1', null, '118.186.231.15');
INSERT INTO `h_recharge` VALUES ('3', '15049049052', '1', '0', '0', 'out_trade_no:2018081612470643002', null, null, '2018-08-16 12:47:58', '0', '1', '1', null, '140.250.207.136');

-- ----------------------------
-- Table structure for h_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `h_withdraw`;
CREATE TABLE `h_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(50) DEFAULT NULL,
  `h_money` int(11) DEFAULT '0',
  `h_fee` int(11) DEFAULT '0',
  `h_bank` varchar(32) DEFAULT NULL,
  `h_bankFullname` varchar(32) DEFAULT NULL,
  `h_bankCardId` varchar(32) DEFAULT NULL,
  `h_mobile` varchar(20) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_isRead` int(20) DEFAULT '0',
  `h_state` char(20) DEFAULT NULL COMMENT '待审核、已打款、审核失败',
  `h_isReturn` int(20) DEFAULT '0' COMMENT '若审核失败，是否返款了，只返一次',
  `h_reply` char(255) DEFAULT NULL,
  `h_actIP` char(39) DEFAULT NULL,
  `h_imgs` varchar(150) DEFAULT NULL,
  `out_trade_no` varchar(250) DEFAULT '0' COMMENT '支付订单号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of h_withdraw
-- ----------------------------
INSERT INTO `h_withdraw` VALUES ('1', '18600701961', '1', '0', '汇钱包', '周一', null, null, '2018-08-14 19:59:06', '0', '待审核', '0', null, '124.64.17.130', '', '0');
INSERT INTO `h_withdraw` VALUES ('2', '18600701961', '1', '0', '汇钱包', '13910978598', null, null, '2018-08-15 18:09:22', '0', '待审核', '0', null, '113.134.238.73', 'undefined', '20180815180922611029');
INSERT INTO `h_withdraw` VALUES ('3', '18600701961', '1', '0', '汇钱包', '姓名', null, null, '2018-08-15 18:21:47', '0', '待审核', '0', null, '113.134.238.73', 'undefined', '20180815182147738168');
INSERT INTO `h_withdraw` VALUES ('4', '18600701961', '1', '0', '汇钱包', '姓名', null, null, '2018-08-15 18:24:19', '0', '待审核', '0', null, '113.134.238.73', 'undefined', '20180815182419398992');
INSERT INTO `h_withdraw` VALUES ('5', '18600701961', '1', '0', '汇钱包', '姓名', null, null, '2018-08-15 18:27:31', '0', '已打款', '0', null, '113.134.238.73', 'undefined', '20180815182731849954');
INSERT INTO `h_withdraw` VALUES ('6', '15811302702', '1', '0', '汇钱包', '郎果兰', null, null, '2018-08-15 18:33:50', '0', '已打款', '0', null, '118.186.231.15', 'undefined', '20180815183350266497');
INSERT INTO `h_withdraw` VALUES ('7', '13800138000', '1', '0', '汇钱包', 'test', null, null, '2018-08-15 18:45:40', '0', '已打款', '0', null, '113.134.238.73', 'undefined', '20180815184540249523');
INSERT INTO `h_withdraw` VALUES ('8', '18600701961', '1', '0', '汇钱包', '姓名', '13910978598', null, '2018-08-15 19:20:45', '0', '已打款', '0', null, '118.186.231.15', 'undefined', '20180815192045829629');
INSERT INTO `h_withdraw` VALUES ('9', '15049049052', '2', '0', '汇钱包', '丁云', '15049049052', null, '2018-08-15 20:30:29', '0', '已打款', '0', null, '144.52.216.59', 'undefined', '20180815203029239910');
INSERT INTO `h_withdraw` VALUES ('10', '15811302702', '1', '0', '汇钱包', '郎果兰', '15811302702', null, '2018-08-15 20:50:33', '0', '已打款', '0', null, '118.186.231.15', 'undefined', '20180815205033207693');
INSERT INTO `h_withdraw` VALUES ('11', '15049049052', '1', '0', '汇钱包', '丁云', '15049049052', null, '2018-08-16 12:49:31', '0', '已打款', '0', null, '140.250.207.136', 'undefined', '20180816124931186956');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logtime` datetime DEFAULT NULL,
  `data` text,
  `type` varchar(255) DEFAULT 'test',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', '2018-08-13 09:44:07', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813094354_299029\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813094354_299029\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('2', '2018-08-13 09:44:08', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813094354_299029\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813094354_299029\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('3', '2018-08-13 09:44:09', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813094354_299029\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813094354_299029\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('4', '2018-08-13 09:44:10', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813094354_299029\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813094354_299029\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('5', '2018-08-13 09:44:10', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813094354_299029\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813094354_299029\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('6', '2018-08-13 09:44:12', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"101.199.110.114\"}', 'test');
INSERT INTO `log` VALUES ('7', '2018-08-13 09:44:16', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"101.199.108.120\"}', 'test');
INSERT INTO `log` VALUES ('8', '2018-08-13 09:45:01', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813094351916146\", \"sign\": \"36ABA3461FA8135CB5BB1BB348A23002\", \"trx_bill_no\": \"API_TX_20180813094354_297943\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"payment_provider\": \"heepay\", \"received_time\": \"20180813014406\", \"trade_status\": \"Success\", \"real_fee\": 1, \"subject\": \"chongzhi\", \"from_account\": \"13910978598\", \"attach\": \"username=13800138000\", \"version\": \"1.0\", \"total_amount\": 1}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('9', '2018-08-13 09:50:00', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813094024645965\", \"sign\": \"EE725D53BC8AEBDA8912107805F391E7\", \"trx_bill_no\": \"API_TX_20180813094026_835695\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"payment_provider\": \"heepay\", \"received_time\": \"20180813014044\", \"trade_status\": \"Success\", \"real_fee\": 600, \"subject\": \"chongzhi\", \"from_account\": \"13910978598\", \"attach\": \"username=13800138000\", \"version\": \"1.0\", \"total_amount\": 600}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('10', '2018-08-13 09:51:55', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813095121_556118\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813095121_556118\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('11', '2018-08-13 09:51:56', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813095121_556118\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813095121_556118\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('12', '2018-08-13 09:53:40', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_4 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13G35 QQ/6.5.3.410 V1_IPH_SQ_6.5.3_1_APP_A Pixel/750 Core/UIWebView NetType/2G Mem/117\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"59.36.119.226\"}', 'test');
INSERT INTO `log` VALUES ('13', '2018-08-13 09:55:00', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813095119774121\", \"sign\": \"1D75A37B9CCF5AD1F7DE3DF9233ED39E\", \"trx_bill_no\": \"API_TX_20180813095121_554970\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"payment_provider\": \"heepay\", \"received_time\": \"20180813015153\", \"trade_status\": \"Success\", \"real_fee\": 2, \"subject\": \"chongzhi\", \"from_account\": \"13910978598\", \"attach\": \"username=13800138000\", \"version\": \"1.0\", \"total_amount\": 2}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('14', '2018-08-13 09:55:01', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) 			Chrome/55.0.2883.95 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"61.151.178.165\"}', 'test');
INSERT INTO `log` VALUES ('15', '2018-08-13 09:57:19', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('16', '2018-08-13 10:03:21', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('17', '2018-08-13 10:03:30', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('18', '2018-08-13 10:04:46', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('19', '2018-08-13 10:05:06', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('20', '2018-08-13 10:07:28', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('21', '2018-08-13 10:07:52', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('22', '2018-08-13 10:09:00', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('23', '2018-08-13 10:09:46', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('24', '2018-08-13 10:09:56', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('25', '2018-08-13 10:10:46', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('26', '2018-08-13 10:12:19', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813101111_239637\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813101111_239637\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('27', '2018-08-13 10:12:20', '{\"POST\":[],\"GET\":{\"order_id\":\"20180813101111_239637\"},\"REQUEST_URI\":\"/return.php/?order_id=20180813101111_239637\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('28', '2018-08-13 10:15:00', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813101108793484\", \"sign\": \"1B7E2DE14A8F2CE9BD9B070E0A56E956\", \"trx_bill_no\": \"API_TX_20180813101111_238523\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"payment_provider\": \"heepay\", \"received_time\": \"20180813021217\", \"trade_status\": \"Success\", \"real_fee\": 3, \"subject\": \"chongzhi\", \"from_account\": \"13910978598\", \"attach\": \"username=13800138000\", \"version\": \"1.0\", \"total_amount\": 3}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('29', '2018-08-13 10:25:01', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813102411638302\", \"sign\": \"A2FAC70F7A704ADE0FA912257A060758\", \"trx_bill_no\": \"API_TX_20180813102413_678400\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"payment_provider\": \"heepay\", \"received_time\": \"20180813022443\", \"trade_status\": \"Success\", \"real_fee\": 100, \"subject\": \"chongzhi\", \"from_account\": \"15811302702\", \"attach\": \"username=18600701961\", \"version\": \"1.0\", \"total_amount\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('30', '2018-08-13 10:49:18', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"220.181.132.193\"}', 'test');
INSERT INTO `log` VALUES ('31', '2018-08-13 11:05:00', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813110156336288\", \"sign\": \"94DB57EF09B4D35B6402377DA8A6E214\", \"trx_bill_no\": \"API_TX_20180813110159_425664\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"payment_provider\": \"heepay\", \"received_time\": \"20180813030232\", \"trade_status\": \"Success\", \"real_fee\": 100, \"subject\": \"chongzhi\", \"from_account\": \"15049049052\", \"attach\": \"username=15049049052\", \"version\": \"1.0\", \"total_amount\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('32', '2018-08-13 11:43:24', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('33', '2018-08-13 12:35:01', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813123333663461\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"15811302702\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=18600701961\", \"total_amount\": 100, \"real_fee\": 100, \"trx_bill_no\": \"API_TX_20180813123336_382333\", \"sign\": \"76E26AC16A063CFAF107E3C051F68644\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180813043503\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('34', '2018-08-13 14:09:00', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813140742263833\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"15811302702\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=18600701961\", \"total_amount\": 100, \"real_fee\": 100, \"trx_bill_no\": \"API_TX_20180813140745_863056\", \"sign\": \"84E69974693F32435915400480ED0EB7\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180813060808\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('35', '2018-08-13 17:02:32', '{\"POST\":[],\"GET\":{\"test\":\"1\"},\"REQUEST_URI\":\"/notify.php?test=1\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"219.144.153.113\"}', 'test');
INSERT INTO `log` VALUES ('36', '2018-08-13 17:35:45', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_4 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13G35 QQ/6.5.3.410 V1_IPH_SQ_6.5.3_1_APP_A Pixel/750 Core/UIWebView NetType/2G Mem/117\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"101.226.102.70\"}', 'test');
INSERT INTO `log` VALUES ('37', '2018-08-13 18:14:58', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813181424501715\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"15811302702\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=18600701961\", \"total_amount\": 100, \"real_fee\": 100, \"trx_bill_no\": \"API_TX_20180813181429_253360\", \"sign\": \"A5FE450E7903B180A9BFB2359B5BAA1D\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180813101456\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('38', '2018-08-13 18:20:58', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180813181809560766\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"15811302702\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=18600701961\", \"total_amount\": 100, \"real_fee\": 100, \"trx_bill_no\": \"API_TX_20180813181813_615740\", \"sign\": \"422C09F2800333ADEB23275EB22EC978\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180813101837\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('39', '2018-08-14 12:18:00', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180814121706923974\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"15811302702\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=15811302702\", \"total_amount\": 1100, \"real_fee\": 1100, \"trx_bill_no\": \"API_TX_20180814121709_731163\", \"sign\": \"9F3E223F4F9D29AB03B8FD2F1188F436\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180814041740\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('40', '2018-08-14 12:39:59', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180814123915616632\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"15811302702\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=15811302702\", \"total_amount\": 1200, \"real_fee\": 1200, \"trx_bill_no\": \"API_TX_20180814123919_513310\", \"sign\": \"1443C9A1E303FD9EA6D6313383B5FC6B\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180814043935\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('41', '2018-08-14 12:44:00', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180814124224693893\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"13910978598\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=18600701961\", \"total_amount\": 100, \"real_fee\": 100, \"trx_bill_no\": \"API_TX_20180814124227_888467\", \"sign\": \"A4EFE0B3E7B0E6CED0F05EBC8FD99D2A\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180814044254\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('42', '2018-08-14 12:47:59', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"out_trade_no\": \"20180814124354499462\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"from_account\": \"13910978598\", \"payment_provider\": \"heepay\", \"subject\": \"chongzhi\", \"attach\": \"username=18600701961\", \"total_amount\": 100, \"real_fee\": 100, \"trx_bill_no\": \"API_TX_20180814124358_194928\", \"sign\": \"5F50D7F179A01825C7508A8E369166F1\", \"version\": \"1.0\", \"trade_status\": \"Success\", \"received_time\": \"20180814044419\"}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('43', '2018-08-15 18:16:04', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815180922611029\", \"trade_status\": \"Success\", \"received_time\": \"20180815101603\", \"sign\": \"1D5E9878ABF1EAB7DC96116CB107F553\", \"attach\": \"username=18600701961\", \"subject\": \"withdraw:18600701961\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815180922_728846\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('44', '2018-08-15 18:21:47', '{\"return_msg\":\"签名不符\",\"return_code\":\"FAILED\"}', 'withdraw api');
INSERT INTO `log` VALUES ('45', '2018-08-15 18:24:19', '{\"return_msg\":\"签名不符\",\"return_code\":\"FAILED\"}', 'withdraw api');
INSERT INTO `log` VALUES ('46', '2018-08-15 18:36:03', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815182731849954\", \"trade_status\": \"Success\", \"received_time\": \"20180815103557\", \"sign\": \"A6F653E272A5AAF6B820A29AC0D92807\", \"attach\": \"username=18600701961\", \"subject\": \"withdraw:18600701961\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815182731_924270\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('47', '2018-08-15 18:40:02', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815183350266497\", \"trade_status\": \"Success\", \"received_time\": \"20180815103520\", \"sign\": \"2A0ECD39044596A1D058F9CB5A20DA58\", \"attach\": \"username=15811302702\", \"subject\": \"withdraw:15811302702\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815183350_928356\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('48', '2018-08-15 19:16:05', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815184540249523\", \"trade_status\": \"Success\", \"received_time\": \"20180815111546\", \"sign\": \"B933C93F5D60B978ACF23E91330577B2\", \"attach\": \"username=13800138000\", \"subject\": \"withdraw:13800138000\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815184541_448378\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('49', '2018-08-15 19:24:03', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815192045829629\", \"trade_status\": \"Success\", \"received_time\": \"20180815112133\", \"sign\": \"0F24CBB76396231D1A4C199278394625\", \"attach\": \"username=18600701961\", \"subject\": \"withdraw:18600701961\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815192046_114555\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('50', '2018-08-15 20:12:02', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815200754554861\", \"trade_status\": \"Success\", \"received_time\": \"20180815120831\", \"sign\": \"02C62F03BAC124512392F26823936CEB\", \"from_account\": \"15049049052\", \"attach\": \"username=15049049052\", \"subject\": \"chongzhi\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815200755_354702\", \"total_amount\": 200, \"real_fee\": 200}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('51', '2018-08-15 20:32:02', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815203029239910\", \"trade_status\": \"Success\", \"received_time\": \"20180815123129\", \"sign\": \"44636A29BAC5194525D8464FFE8B7491\", \"attach\": \"username=15049049052\", \"subject\": \"withdraw:15049049052\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815203030_939367\", \"total_amount\": 200, \"real_fee\": 200}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('52', '2018-08-15 20:52:03', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815205033207693\", \"trade_status\": \"Success\", \"received_time\": \"20180815125202\", \"sign\": \"4A38535B88F693DF7A668C898E8629D1\", \"attach\": \"username=15811302702\", \"subject\": \"withdraw:15811302702\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815205034_939305\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('53', '2018-08-15 21:12:02', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"payment_provider\": \"heepay\", \"out_trade_no\": \"20180815210903792330\", \"trade_status\": \"Success\", \"received_time\": \"20180815130932\", \"sign\": \"59680BB82F9BF9BD3E94ADCCEF3892B1\", \"from_account\": \"13910978598\", \"attach\": \"username=18600701961\", \"subject\": \"chongzhi\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"version\": \"1.0\", \"trx_bill_no\": \"API_TX_20180815210904_622827\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('54', '2018-08-16 11:35:37', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/56.0.2924.75 Mobile/14E5239e Safari/602.1\",\"HTTP_RAW_POST_DATA\":null,\"IP\":\"1.86.232.218\"}', 'test');
INSERT INTO `log` VALUES ('55', '2018-08-16 11:35:58', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"trade_status\": \"Success\", \"subject\": \"chongzhi\", \"payment_provider\": \"heepay\", \"trx_bill_no\": \"API_TX_20180816113200_483690\", \"from_account\": \"13910978598\", \"attach\": \"username=13800138000\", \"received_time\": \"20180816033220\", \"version\": \"1.0\", \"sign\": \"47A3F4226087DA421AE8E3F579BA07F9\", \"out_trade_no\": \"20180816113155296435\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('56', '2018-08-16 11:47:58', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"trade_status\": \"Success\", \"subject\": \"chongzhi\", \"payment_provider\": \"heepay\", \"trx_bill_no\": \"API_TX_20180816114617_763624\", \"from_account\": \"13910978598\", \"attach\": \"username=13800138000\", \"received_time\": \"20180816034631\", \"version\": \"1.0\", \"sign\": \"CFDFAB287E4D007C078E1811FFC45D66\", \"out_trade_no\": \"20180816114613746710\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"total_amount\": 300, \"real_fee\": 300}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('57', '2018-08-16 12:11:58', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"trade_status\": \"Success\", \"subject\": \"chongzhi\", \"payment_provider\": \"heepay\", \"trx_bill_no\": \"API_TX_20180816121003_621939\", \"from_account\": \"13910978598\", \"attach\": \"username=18600701961\", \"received_time\": \"20180816041022\", \"version\": \"1.0\", \"sign\": \"C19AE8134298B38F99229E224EBEE21A\", \"out_trade_no\": \"20180816120958685626\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"total_amount\": 200, \"real_fee\": 200}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('58', '2018-08-16 12:47:58', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"trade_status\": \"Success\", \"subject\": \"chongzhi\", \"payment_provider\": \"heepay\", \"trx_bill_no\": \"API_TX_20180816124711_564760\", \"from_account\": \"15049049052\", \"attach\": \"username=15049049052\", \"received_time\": \"20180816044731\", \"version\": \"1.0\", \"sign\": \"819F9BBC3CD415378670A8F4EEFFA89C\", \"out_trade_no\": \"20180816124706430029\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');
INSERT INTO `log` VALUES ('59', '2018-08-16 12:51:58', '{\"POST\":[],\"GET\":[],\"REQUEST_URI\":\"/notify.php\",\"HTTP_USER_AGENT\":\"python-requests/2.18.4\",\"HTTP_RAW_POST_DATA\":\"{\"trade_status\": \"Success\", \"subject\": \"withdraw:15049049052\", \"payment_provider\": \"heepay\", \"trx_bill_no\": \"API_TX_20180816124936_436812\", \"attach\": \"username=15049049052\", \"received_time\": \"20180816045114\", \"version\": \"1.0\", \"sign\": \"F26E6F65AF8EDE56DD8C3809C0F04E4F\", \"out_trade_no\": \"20180816124931186956\", \"api_key\": \"1K3IO1TXWPOOTE45ASAX1CDYLE3CLKBQ\", \"total_amount\": 100, \"real_fee\": 100}\",\"IP\":\"54.203.195.52\"}', 'test');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `out_trade_no` varchar(255) DEFAULT NULL COMMENT '订单号',
  `username` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `total_fee` decimal(8,2) DEFAULT '0.00' COMMENT '支付金额（元）',
  `submit_time` datetime DEFAULT NULL COMMENT '提交时间',
  `pay_time` datetime DEFAULT NULL COMMENT '支付时间',
  `ip` varchar(255) DEFAULT NULL,
  `trx_bill_no` varchar(255) DEFAULT '',
  `status` varchar(255) DEFAULT 'UNKNOWN' COMMENT '支付状态',
  `type` varchar(255) DEFAULT 'recharge' COMMENT 'recharge 充值，withdraw提现',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '20180813091525191241', '13800138000', 'chongzhi', '5.00', '2018-08-13 09:15:25', '2018-08-13 10:09:56', '219.144.153.113', 'API_TX_20180813094354_297943', 'success', 'recharge');
INSERT INTO `order` VALUES ('2', '20180813092025999615', '13800138000', 'chongzhi', '0.50', '2018-08-13 09:20:25', '2018-08-13 10:09:56', '219.144.153.113', 'API_TX_20180813094354_297943', 'success', 'recharge');
INSERT INTO `order` VALUES ('3', '20180813092434794088', '13800138000', 'chongzhi', '0.90', '2018-08-13 09:24:34', '2018-08-13 10:09:56', '219.144.153.113', 'API_TX_20180813094354_297943', 'success', 'recharge');
INSERT INTO `order` VALUES ('4', '20180813094024645965', '13800138000', 'chongzhi', '6.00', '2018-08-13 09:40:24', '2018-08-13 10:09:56', '219.144.153.113', 'API_TX_20180813094354_297943', 'success', 'recharge');
INSERT INTO `order` VALUES ('5', '20180813094351916146', '13800138000', 'chongzhi', '0.01', '2018-08-13 09:43:51', '2018-08-13 10:49:18', '219.144.153.113', 'API_TX_20180813094354_297943', 'success', 'recharge');
INSERT INTO `order` VALUES ('6', '20180813095119774121', '13800138000', 'chongzhi', '0.02', '2018-08-13 09:51:19', '2018-08-13 10:09:56', '219.144.153.113', 'API_TX_20180813094354_297943', 'success', 'recharge');
INSERT INTO `order` VALUES ('7', '20180813101108793484', '13800138000', 'chongzhi', '0.03', '2018-08-13 10:11:08', '2018-08-13 10:15:00', '219.144.153.113', 'API_TX_20180813101111_238523', 'success', 'recharge');
INSERT INTO `order` VALUES ('8', '20180813102411638302', '18600701961', 'chongzhi', '1.00', '2018-08-13 10:24:11', '2018-08-13 10:25:01', '124.64.17.130', 'API_TX_20180813102413_678400', 'success', 'recharge');
INSERT INTO `order` VALUES ('9', '20180813110156336288', '15049049052', 'chongzhi', '1.00', '2018-08-13 11:01:56', '2018-08-13 11:05:00', '60.211.235.230', 'API_TX_20180813110159_425664', 'success', 'recharge');
INSERT INTO `order` VALUES ('10', '20180813123333663461', '18600701961', 'chongzhi', '1.00', '2018-08-13 12:33:33', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('11', '20180813140742263833', '18600701961', 'chongzhi', '1.00', '2018-08-13 14:07:42', null, '124.64.17.130', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('12', '20180813181421996841', '18600701961', 'chongzhi', '1.00', '2018-08-13 18:14:21', null, '124.64.17.130', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('13', '20180813181424501715', '18600701961', 'chongzhi', '1.00', '2018-08-13 18:14:24', '2018-08-13 18:14:58', '124.64.17.130', 'API_TX_20180813181429_253360', 'success', 'recharge');
INSERT INTO `order` VALUES ('14', '20180813181809560766', '18600701961', 'chongzhi', '1.00', '2018-08-13 18:18:09', '2018-08-13 18:20:58', '124.64.17.130', 'API_TX_20180813181813_615740', 'success', 'recharge');
INSERT INTO `order` VALUES ('15', '20180814121706923974', '15811302702', 'chongzhi', '11.00', '2018-08-14 12:17:06', '2018-08-14 12:18:00', '73.35.144.70', 'API_TX_20180814121709_731163', 'success', 'recharge');
INSERT INTO `order` VALUES ('16', '20180814122854870773', '15811302702', 'chongzhi', '100.00', '2018-08-14 12:28:54', null, '73.35.144.70', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('17', '20180814123915616632', '15811302702', 'chongzhi', '12.00', '2018-08-14 12:39:15', '2018-08-14 12:39:59', '73.35.144.70', 'API_TX_20180814123919_513310', 'success', 'recharge');
INSERT INTO `order` VALUES ('18', '20180814124224693893', '18600701961', 'chongzhi', '1.00', '2018-08-14 12:42:24', '2018-08-14 12:44:00', '124.64.17.130', 'API_TX_20180814124227_888467', 'success', 'recharge');
INSERT INTO `order` VALUES ('19', '20180814124354499462', '18600701961', 'chongzhi', '1.00', '2018-08-14 12:43:54', '2018-08-14 12:47:59', '124.64.17.130', 'API_TX_20180814124358_194928', 'success', 'recharge');
INSERT INTO `order` VALUES ('20', '20180815180922611029', '18600701961', 'withdraw:18600701961', '1.00', '2018-08-15 18:09:22', '2018-08-15 18:16:04', '113.134.238.73', 'API_TX_20180815180922_728846', 'success', 'recharge');
INSERT INTO `order` VALUES ('21', '20180815182147738168', '18600701961', 'withdraw:18600701961', '1.00', '2018-08-15 18:21:47', null, '113.134.238.73', '', 'UNKNOWN', 'withdraw');
INSERT INTO `order` VALUES ('22', '20180815182419398992', '18600701961', 'withdraw:18600701961', '1.00', '2018-08-15 18:24:19', null, '113.134.238.73', '', 'UNKNOWN', 'withdraw');
INSERT INTO `order` VALUES ('23', '20180815182731849954', '18600701961', 'withdraw:18600701961', '1.00', '2018-08-15 18:27:31', '2018-08-15 18:36:03', '113.134.238.73', 'API_TX_20180815182731_924270', 'success', 'withdraw');
INSERT INTO `order` VALUES ('24', '20180815183350266497', '15811302702', 'withdraw:15811302702', '1.00', '2018-08-15 18:33:50', '2018-08-15 18:40:02', '118.186.231.15', 'API_TX_20180815183350_928356', 'success', 'withdraw');
INSERT INTO `order` VALUES ('25', '20180815184540249523', '13800138000', 'withdraw:13800138000', '1.00', '2018-08-15 18:45:40', '2018-08-15 19:16:05', '113.134.238.73', 'API_TX_20180815184541_448378', 'success', 'withdraw');
INSERT INTO `order` VALUES ('26', '20180815192045829629', '18600701961', 'withdraw:18600701961', '1.00', '2018-08-15 19:20:45', '2018-08-15 19:24:03', '118.186.231.15', 'API_TX_20180815192046_114555', 'success', 'withdraw');
INSERT INTO `order` VALUES ('27', '20180815192350570516', '18600701961', 'chongzhi', '5.00', '2018-08-15 19:23:50', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('28', '20180815192805376580', '15811302702', 'chongzhi', '1.00', '2018-08-15 19:28:05', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('29', '20180815192832748110', '15811302702', 'chongzhi', '1.00', '2018-08-15 19:28:32', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('30', '20180815192919762915', '15811302702', 'chongzhi', '1.00', '2018-08-15 19:29:19', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('31', '20180815200754554861', '15049049052', 'chongzhi', '2.00', '2018-08-15 20:07:54', '2018-08-15 20:12:02', '144.52.216.59', 'API_TX_20180815200755_354702', 'success', 'recharge');
INSERT INTO `order` VALUES ('32', '20180815203029239910', '15049049052', 'withdraw:15049049052', '2.00', '2018-08-15 20:30:29', '2018-08-15 20:32:02', '144.52.216.59', 'API_TX_20180815203030_939367', 'success', 'withdraw');
INSERT INTO `order` VALUES ('33', '20180815203720353070', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:37:20', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('34', '20180815205033207693', '15811302702', 'withdraw:15811302702', '1.00', '2018-08-15 20:50:33', '2018-08-15 20:52:03', '118.186.231.15', 'API_TX_20180815205034_939305', 'success', 'withdraw');
INSERT INTO `order` VALUES ('35', '20180815205232834683', '15811302702', 'chongzhi', '1.00', '2018-08-15 20:52:32', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('36', '20180815205353186682', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:53:53', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('37', '20180815205357991046', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:53:57', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('38', '20180815205400115435', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:54:00', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('39', '20180815205401655139', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:54:01', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('40', '20180815205644957125', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:44', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('41', '20180815205648248040', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:48', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('42', '20180815205653678045', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:53', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('43', '20180815205655978247', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:55', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('44', '20180815205657877639', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:57', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('45', '20180815205658538024', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:58', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('46', '20180815205658668295', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:58', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('47', '20180815205658668460', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:58', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('48', '20180815205658947265', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:58', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('49', '20180815205659868081', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:56:59', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('50', '20180815205700170147', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:00', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('51', '20180815205700653134', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:00', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('52', '20180815205700738717', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:00', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('53', '20180815205700199591', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:00', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('54', '20180815205700766540', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:00', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('55', '20180815205700487652', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:00', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('56', '20180815205701925155', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:01', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('57', '20180815205701271496', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:01', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('58', '20180815205701346835', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:01', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('59', '20180815205701285586', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:01', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('60', '20180815205701250732', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:01', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('61', '20180815205702192257', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('62', '20180815205702884259', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('63', '20180815205702335134', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('64', '20180815205702737152', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('65', '20180815205702516931', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('66', '20180815205702849075', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('67', '20180815205702979702', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('68', '20180815205702124444', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:02', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('69', '20180815205703841192', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:03', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('70', '20180815205703705593', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:03', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('71', '20180815205703109530', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:03', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('72', '20180815205703274325', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:57:03', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('73', '20180815205822549890', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:22', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('74', '20180815205825942788', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:25', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('75', '20180815205825674035', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:25', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('76', '20180815205826613528', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:26', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('77', '20180815205826121450', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:26', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('78', '20180815205826311019', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:26', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('79', '20180815205826983218', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:26', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('80', '20180815205827521490', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:27', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('81', '20180815205827659259', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:27', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('82', '20180815205827592764', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:27', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('83', '20180815205827884506', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:27', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('84', '20180815205828655056', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:28', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('85', '20180815205828318682', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:28', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('86', '20180815205828285064', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:28', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('87', '20180815205828155151', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:28', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('88', '20180815205829586611', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:29', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('89', '20180815205830613610', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:30', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('90', '20180815205830313052', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:30', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('91', '20180815205830665246', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:30', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('92', '20180815205830891455', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:30', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('93', '20180815205831775741', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:31', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('94', '20180815205831577822', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:31', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('95', '20180815205831621081', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:31', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('96', '20180815205841969924', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:41', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('97', '20180815205842632342', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:58:42', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('98', '20180815205937547885', '15953524448', 'chongzhi', '3.00', '2018-08-15 20:59:37', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('99', '20180815210114563623', '15953524448', 'chongzhi', '2.00', '2018-08-15 21:01:14', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('100', '20180815210240780767', '15953524448', 'chongzhi', '2.00', '2018-08-15 21:02:40', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('101', '20180815210240225326', '15953524448', 'chongzhi', '2.00', '2018-08-15 21:02:40', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('102', '20180815210311585733', '15953524448', 'chongzhi', '2.00', '2018-08-15 21:03:11', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('103', '20180815210313175833', '15953524448', 'chongzhi', '2.00', '2018-08-15 21:03:13', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('104', '20180815210329287756', '15953524448', 'chongzhi', '2.00', '2018-08-15 21:03:29', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('105', '20180815210347167373', '15953524448', 'chongzhi', '2.00', '2018-08-15 21:03:47', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('106', '20180815210733746737', '15953524448', 'chongzhi', '100.00', '2018-08-15 21:07:33', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('107', '20180815210830710675', '18600701961', 'chongzhi', '1.00', '2018-08-15 21:08:30', null, '123.125.153.106', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('108', '20180815210903792330', '18600701961', 'chongzhi', '1.00', '2018-08-15 21:09:03', '2018-08-15 21:12:02', '123.125.153.106', 'API_TX_20180815210904_622827', 'success', 'recharge');
INSERT INTO `order` VALUES ('109', '20180815211227237988', '15953524448', 'chongzhi', '100.00', '2018-08-15 21:12:27', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('110', '20180815211330240350', '15953524448', 'chongzhi', '1.00', '2018-08-15 21:13:30', null, '27.194.70.51', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('111', '20180815212032647915', '18600701961', 'chongzhi', '1.00', '2018-08-15 21:20:32', null, '123.125.153.106', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('112', '20180815212036232275', '18600701961', 'chongzhi', '1.00', '2018-08-15 21:20:36', null, '123.125.153.106', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('113', '20180816113124931637', '13800138000', 'chongzhi', '1.00', '2018-08-16 11:31:24', null, '1.86.232.218', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('114', '20180816113155296435', '13800138000', 'chongzhi', '1.00', '2018-08-16 11:31:55', '2018-08-16 11:35:58', '1.86.232.218', 'API_TX_20180816113200_483690', 'success', 'recharge');
INSERT INTO `order` VALUES ('115', '20180816114613746710', '13800138000', 'chongzhi', '3.00', '2018-08-16 11:46:13', '2018-08-16 11:47:58', '1.86.232.218', 'API_TX_20180816114617_763624', 'success', 'recharge');
INSERT INTO `order` VALUES ('116', '20180816120721991101', '18600701961', 'chongzhi', '1.00', '2018-08-16 12:07:21', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('117', '20180816120739634457', '18600701961', 'chongzhi', '1.00', '2018-08-16 12:07:39', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('118', '20180816120752838226', '18600701961', 'chongzhi', '1.00', '2018-08-16 12:07:52', null, '118.186.231.15', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('119', '20180816120958685626', '18600701961', 'chongzhi', '2.00', '2018-08-16 12:09:58', '2018-08-16 12:11:58', '118.186.231.15', 'API_TX_20180816121003_621939', 'success', 'recharge');
INSERT INTO `order` VALUES ('120', '20180816124543779806', '15049049052', 'chongzhi', '1.00', '2018-08-16 12:45:43', null, '140.250.207.136', '', 'UNKNOWN', 'recharge');
INSERT INTO `order` VALUES ('121', '20180816124706430029', '15049049052', 'chongzhi', '1.00', '2018-08-16 12:47:06', '2018-08-16 12:47:58', '140.250.207.136', 'API_TX_20180816124711_564760', 'success', 'recharge');
INSERT INTO `order` VALUES ('122', '20180816124931186956', '15049049052', 'withdraw:15049049052', '1.00', '2018-08-16 12:49:31', '2018-08-16 12:51:58', '140.250.207.136', 'API_TX_20180816124936_436812', 'success', 'withdraw');

-- ----------------------------
-- Table structure for shoukuanla_order
-- ----------------------------
DROP TABLE IF EXISTS `shoukuanla_order`;
CREATE TABLE `shoukuanla_order` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(10) NOT NULL DEFAULT '0' COMMENT 'uid',
  `money` float(10,2) NOT NULL DEFAULT '0.00',
  `num` char(40) NOT NULL DEFAULT '' COMMENT '订单号',
  `paytype` char(10) NOT NULL COMMENT '支付类型',
  `jiaoyi` char(50) NOT NULL COMMENT '交易号',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '充值时间',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `skl_order` char(50) DEFAULT NULL COMMENT '扫码备注',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='充值记录';

-- ----------------------------
-- Records of shoukuanla_order
-- ----------------------------
INSERT INTO `shoukuanla_order` VALUES ('1', '1', '150.00', '20171221171244124', 'alipay', '', '1513847564', '0', '150.01');
INSERT INTO `shoukuanla_order` VALUES ('2', '1', '150.00', '20171221171618313', 'wxpay', '', '1513847778', '0', '150.01');

-- ----------------------------
-- Table structure for t_log_login_member
-- ----------------------------
DROP TABLE IF EXISTS `t_log_login_member`;
CREATE TABLE `t_log_login_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` char(20) DEFAULT NULL,
  `h_ip` char(39) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_login_member
-- ----------------------------
INSERT INTO `t_log_login_member` VALUES ('1', '18888888888', '61.148.244.215', '2018-07-30 16:29:49');
INSERT INTO `t_log_login_member` VALUES ('2', '18888888888', '61.148.244.215', '2018-07-30 16:32:24');
INSERT INTO `t_log_login_member` VALUES ('3', '18888888888', '60.3.150.13', '2018-07-30 20:03:30');
INSERT INTO `t_log_login_member` VALUES ('4', '15049049052', '117.136.94.237', '2018-07-30 20:29:32');
INSERT INTO `t_log_login_member` VALUES ('5', '15049049052', '144.52.193.88', '2018-07-30 20:46:15');
INSERT INTO `t_log_login_member` VALUES ('6', '18600701961', '60.3.150.13', '2018-07-30 21:17:59');
INSERT INTO `t_log_login_member` VALUES ('7', '18600701961', '182.127.168.107', '2018-07-30 21:46:28');
INSERT INTO `t_log_login_member` VALUES ('8', '18888888888', '60.3.150.13', '2018-07-30 21:48:29');
INSERT INTO `t_log_login_member` VALUES ('9', '18600701961', '60.3.150.13', '2018-07-30 21:53:24');
INSERT INTO `t_log_login_member` VALUES ('10', '18888888888', '60.3.150.13', '2018-07-30 22:26:36');
INSERT INTO `t_log_login_member` VALUES ('11', '18888888888', '124.64.16.120', '2018-07-31 07:17:10');
INSERT INTO `t_log_login_member` VALUES ('12', '18600701961', '124.64.16.120', '2018-07-31 07:30:14');
INSERT INTO `t_log_login_member` VALUES ('13', '15049049052', '60.211.235.230', '2018-07-31 07:40:39');
INSERT INTO `t_log_login_member` VALUES ('14', '15049049052', '60.211.235.230', '2018-07-31 08:33:26');
INSERT INTO `t_log_login_member` VALUES ('15', '18600701961', '106.38.54.61', '2018-07-31 09:17:35');
INSERT INTO `t_log_login_member` VALUES ('16', '15049049052', '60.211.235.230', '2018-07-31 09:44:16');
INSERT INTO `t_log_login_member` VALUES ('17', '15049049052', '60.211.235.230', '2018-07-31 10:54:32');
INSERT INTO `t_log_login_member` VALUES ('18', '15953524448', '27.194.128.255', '2018-07-31 14:31:13');
INSERT INTO `t_log_login_member` VALUES ('19', '15953524448', '27.194.128.255', '2018-07-31 14:33:04');
INSERT INTO `t_log_login_member` VALUES ('20', '15953524448', '27.194.128.255', '2018-07-31 14:39:58');
INSERT INTO `t_log_login_member` VALUES ('21', '18888888888', '125.41.7.60', '2018-07-31 22:28:41');
INSERT INTO `t_log_login_member` VALUES ('22', '15953524448', '27.217.57.247', '2018-08-01 05:25:20');
INSERT INTO `t_log_login_member` VALUES ('23', '18600701961', '182.126.72.160', '2018-08-01 08:05:36');
INSERT INTO `t_log_login_member` VALUES ('24', '15049049052', '140.250.203.135', '2018-08-01 23:57:25');
INSERT INTO `t_log_login_member` VALUES ('25', '15953524448', '27.213.144.44', '2018-08-02 05:27:17');
INSERT INTO `t_log_login_member` VALUES ('26', '18600701961', '221.14.159.53', '2018-08-02 20:40:38');
INSERT INTO `t_log_login_member` VALUES ('27', '18600701961', '125.41.7.118', '2018-08-03 11:21:10');
INSERT INTO `t_log_login_member` VALUES ('28', '18600701961', '125.41.7.118', '2018-08-04 19:28:01');
INSERT INTO `t_log_login_member` VALUES ('29', '18600701961', '125.41.7.118', '2018-08-04 19:32:17');
INSERT INTO `t_log_login_member` VALUES ('30', '18600701961', '125.41.1.228', '2018-08-04 19:52:57');
INSERT INTO `t_log_login_member` VALUES ('31', '18600701961', '125.41.3.199', '2018-08-04 20:48:13');
INSERT INTO `t_log_login_member` VALUES ('32', '18600701961', '223.72.40.135', '2018-08-05 11:08:38');
INSERT INTO `t_log_login_member` VALUES ('33', '15953524448', '112.237.72.2', '2018-08-07 08:51:10');
INSERT INTO `t_log_login_member` VALUES ('34', '18600701961', '114.242.250.164', '2018-08-07 11:21:30');
INSERT INTO `t_log_login_member` VALUES ('35', '18600701961', '114.242.250.196', '2018-08-07 18:07:48');
INSERT INTO `t_log_login_member` VALUES ('36', '15049049052', '123.168.135.137', '2018-08-08 12:12:11');
INSERT INTO `t_log_login_member` VALUES ('37', '15049049052', '60.211.235.230', '2018-08-09 09:47:37');
INSERT INTO `t_log_login_member` VALUES ('38', '15049049052', '60.211.235.230', '2018-08-09 16:36:15');
INSERT INTO `t_log_login_member` VALUES ('39', '15049049052', '60.211.235.230', '2018-08-10 08:48:13');
INSERT INTO `t_log_login_member` VALUES ('40', '18600701961', '114.242.249.148', '2018-08-10 12:32:48');
INSERT INTO `t_log_login_member` VALUES ('41', '18600701961', '114.242.249.148', '2018-08-10 12:35:45');
INSERT INTO `t_log_login_member` VALUES ('42', '18600701961', '123.125.153.106', '2018-08-11 08:44:08');
INSERT INTO `t_log_login_member` VALUES ('43', '18600701961', '123.125.153.106', '2018-08-11 08:45:59');
INSERT INTO `t_log_login_member` VALUES ('44', '18600701961', '123.125.153.106', '2018-08-11 09:02:30');
INSERT INTO `t_log_login_member` VALUES ('45', '18600701961', '124.64.17.96', '2018-08-11 12:08:54');
INSERT INTO `t_log_login_member` VALUES ('46', '18888888888', '124.64.17.96', '2018-08-11 13:53:28');
INSERT INTO `t_log_login_member` VALUES ('47', '18600701961', '111.200.248.130', '2018-08-11 18:59:35');
INSERT INTO `t_log_login_member` VALUES ('48', '18600701961', '111.200.248.130', '2018-08-11 19:09:00');
INSERT INTO `t_log_login_member` VALUES ('49', '18600701961', '123.125.153.106', '2018-08-12 07:46:47');
INSERT INTO `t_log_login_member` VALUES ('50', '18888888888', '123.125.153.106', '2018-08-12 08:02:13');
INSERT INTO `t_log_login_member` VALUES ('51', '13800138000', '219.144.153.113', '2018-08-13 09:14:29');
INSERT INTO `t_log_login_member` VALUES ('52', '13800138000', '219.144.153.113', '2018-08-13 09:39:49');
INSERT INTO `t_log_login_member` VALUES ('53', '18600701961', '124.64.17.130', '2018-08-13 10:23:27');
INSERT INTO `t_log_login_member` VALUES ('54', '18600701961', '118.186.231.15', '2018-08-13 10:37:31');
INSERT INTO `t_log_login_member` VALUES ('55', '15049049052', '60.211.235.230', '2018-08-13 11:01:37');
INSERT INTO `t_log_login_member` VALUES ('56', '18600701961', '118.186.231.15', '2018-08-13 12:33:17');
INSERT INTO `t_log_login_member` VALUES ('57', '18600701961', '124.64.17.130', '2018-08-13 13:26:57');
INSERT INTO `t_log_login_member` VALUES ('58', '15049049052', '60.211.235.230', '2018-08-13 14:25:38');
INSERT INTO `t_log_login_member` VALUES ('59', '18600701961', '124.64.17.130', '2018-08-13 15:17:27');
INSERT INTO `t_log_login_member` VALUES ('60', '18600701961', '124.64.17.130', '2018-08-13 16:24:46');
INSERT INTO `t_log_login_member` VALUES ('61', '18600701961', '124.64.17.130', '2018-08-13 18:34:04');
INSERT INTO `t_log_login_member` VALUES ('62', '18600701961', '124.64.17.130', '2018-08-13 20:37:59');
INSERT INTO `t_log_login_member` VALUES ('63', '15811302702', '124.64.17.130', '2018-08-13 20:39:47');
INSERT INTO `t_log_login_member` VALUES ('64', '18600701961', '124.64.17.130', '2018-08-13 21:22:54');
INSERT INTO `t_log_login_member` VALUES ('65', '18888888888', '118.186.231.15', '2018-08-13 21:32:18');
INSERT INTO `t_log_login_member` VALUES ('66', '15803005053', '183.228.6.37', '2018-08-13 21:48:36');
INSERT INTO `t_log_login_member` VALUES ('67', '18600701961', '118.186.231.15', '2018-08-14 06:59:56');
INSERT INTO `t_log_login_member` VALUES ('68', '15811302702', '73.35.144.70', '2018-08-14 12:16:23');
INSERT INTO `t_log_login_member` VALUES ('69', '18600701961', '124.64.17.130', '2018-08-14 12:42:07');
INSERT INTO `t_log_login_member` VALUES ('70', '18600701961', '124.64.17.130', '2018-08-14 15:59:27');
INSERT INTO `t_log_login_member` VALUES ('71', '15049049052', '60.211.235.230', '2018-08-14 17:37:11');
INSERT INTO `t_log_login_member` VALUES ('72', '18600701961', '124.64.17.130', '2018-08-14 19:58:40');
INSERT INTO `t_log_login_member` VALUES ('73', '18600701961', '118.186.231.15', '2018-08-14 20:18:33');
INSERT INTO `t_log_login_member` VALUES ('74', '15049049052', '60.211.235.230', '2018-08-15 08:42:43');
INSERT INTO `t_log_login_member` VALUES ('75', '15049049052', '60.211.235.230', '2018-08-15 09:21:03');
INSERT INTO `t_log_login_member` VALUES ('76', '18600701961', '118.186.231.15', '2018-08-15 10:51:22');
INSERT INTO `t_log_login_member` VALUES ('77', '18600701961', '118.186.231.15', '2018-08-15 11:51:44');
INSERT INTO `t_log_login_member` VALUES ('78', '18600701961', '118.186.231.15', '2018-08-15 15:22:51');
INSERT INTO `t_log_login_member` VALUES ('79', '13800138000', '113.134.238.73', '2018-08-15 17:29:03');
INSERT INTO `t_log_login_member` VALUES ('80', '18600701961', '113.134.238.73', '2018-08-15 18:07:58');
INSERT INTO `t_log_login_member` VALUES ('81', '18888888888', '118.186.231.15', '2018-08-15 18:27:51');
INSERT INTO `t_log_login_member` VALUES ('82', '15811302702', '118.186.231.15', '2018-08-15 18:28:41');
INSERT INTO `t_log_login_member` VALUES ('83', '18600701961', '118.186.231.15', '2018-08-15 19:18:49');
INSERT INTO `t_log_login_member` VALUES ('84', '18600701961', '118.186.231.15', '2018-08-15 19:26:42');
INSERT INTO `t_log_login_member` VALUES ('85', '15811302702', '118.186.231.15', '2018-08-15 19:27:41');
INSERT INTO `t_log_login_member` VALUES ('86', '15049049052', '144.52.216.59', '2018-08-15 20:02:17');
INSERT INTO `t_log_login_member` VALUES ('87', '15953524448', '27.194.70.51', '2018-08-15 20:36:52');
INSERT INTO `t_log_login_member` VALUES ('88', '15953524448', '27.194.70.51', '2018-08-15 20:38:59');
INSERT INTO `t_log_login_member` VALUES ('89', '15953524448', '27.194.70.51', '2018-08-15 20:41:23');
INSERT INTO `t_log_login_member` VALUES ('90', '15953524448', '27.194.70.51', '2018-08-15 20:48:46');
INSERT INTO `t_log_login_member` VALUES ('91', '15811302702', '118.186.231.15', '2018-08-15 20:49:29');
INSERT INTO `t_log_login_member` VALUES ('92', '15953524448', '27.194.70.51', '2018-08-15 20:57:34');
INSERT INTO `t_log_login_member` VALUES ('93', '15953524448', '27.194.70.51', '2018-08-15 21:00:39');
INSERT INTO `t_log_login_member` VALUES ('94', '18600701961', '123.125.153.106', '2018-08-15 21:08:01');
INSERT INTO `t_log_login_member` VALUES ('95', '15953524448', '27.194.70.51', '2018-08-15 21:13:16');
INSERT INTO `t_log_login_member` VALUES ('96', '15953524448', '27.194.70.51', '2018-08-15 21:15:25');
INSERT INTO `t_log_login_member` VALUES ('97', '15953524448', '27.194.70.51', '2018-08-15 21:18:50');
INSERT INTO `t_log_login_member` VALUES ('98', '15953524448', '27.194.70.51', '2018-08-15 21:29:22');
INSERT INTO `t_log_login_member` VALUES ('99', '18600701961', '123.125.153.106', '2018-08-15 21:43:14');
INSERT INTO `t_log_login_member` VALUES ('100', '15953524448', '60.212.99.198', '2018-08-16 05:09:56');
INSERT INTO `t_log_login_member` VALUES ('101', '15953524448', '60.212.99.198', '2018-08-16 05:12:11');
INSERT INTO `t_log_login_member` VALUES ('102', '15953524448', '60.212.99.198', '2018-08-16 05:14:22');
INSERT INTO `t_log_login_member` VALUES ('103', '15811302702', '118.186.231.15', '2018-08-16 09:54:47');
INSERT INTO `t_log_login_member` VALUES ('104', '15049049052', '60.211.235.230', '2018-08-16 10:35:48');
INSERT INTO `t_log_login_member` VALUES ('105', '13800138000', '1.86.232.218', '2018-08-16 11:30:50');
INSERT INTO `t_log_login_member` VALUES ('106', '18600701961', '118.186.231.15', '2018-08-16 12:06:48');
INSERT INTO `t_log_login_member` VALUES ('107', '18600701961', '118.186.231.15', '2018-08-16 12:21:58');
INSERT INTO `t_log_login_member` VALUES ('108', '15049049052', '140.250.207.136', '2018-08-16 12:45:23');
