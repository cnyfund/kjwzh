-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 05 月 23 日 00:58
-- 服务器版本: 5.5.40
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `xinde`
--

-- --------------------------------------------------------

--
-- 表的结构 `h_admin`
--

CREATE TABLE IF NOT EXISTS `h_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(50) DEFAULT NULL,
  `h_passWord` varchar(50) DEFAULT NULL,
  `h_nickName` varchar(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '1',
  `h_addTime` datetime DEFAULT NULL,
  `h_permissions` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `h_admin`
--

INSERT INTO `h_admin` (`id`, `h_userName`, `h_passWord`, `h_nickName`, `h_isPass`, `h_addTime`, `h_permissions`) VALUES
(5, 'qwe3362', 'e120ea280aa50693d5568d0071456460', '技术账号', 1, NULL, ',基本配置,网站Logo,客服设置,推荐会员提成配置,直荐升级配置,激活会员配置,拍卖配置,提现配置,抽奖配置,农场物品设置,玩家公告,会员列表,会员物品列表,推荐结构,商城商品管理,商城订单列表,会员登录记录,加减激活币,激活币流水明细,充值管理,提现管理,会员消息列表,发送消息给会员,收到的会员消息,清空数据,调整时间,帐号管理,'),
(10, '123654', '733d7be2196ff70efaf6913fc8bdcabf', '123654', 1, NULL, ',基本配置,网站Logo,客服设置,推荐会员提成配置,直荐升级配置,激活会员配置,拍卖配置,提现配置,抽奖配置,农场物品设置,玩家公告,会员列表,会员物品列表,推荐结构,元拍卖列表,商城商品管理,商城订单列表,会员登录记录,加减激活币,激活币流水明细,加减元,元流水明细,加减积分,充值管理,提现管理,会员消息列表,发送消息给会员,收到的会员消息,清空数据,调整时间,');

-- --------------------------------------------------------

--
-- 表的结构 `h_article`
--

CREATE TABLE IF NOT EXISTS `h_article` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=417 ;

--
-- 转存表中的数据 `h_article`
--

INSERT INTO `h_article` (`id`, `h_location`, `h_menuId`, `h_title`, `h_pageKey`, `h_categoryId`, `h_picSmall`, `h_picBig`, `h_picBig2`, `h_picBig3`, `h_picBig4`, `h_picBig5`, `h_picBig6`, `h_picBig7`, `h_picBig8`, `h_picBig9`, `h_picBig10`, `h_isLink`, `h_href`, `h_target`, `h_addTime`, `h_order`, `h_clicks`, `h_keyword`, `h_description`, `h_info`, `h_jj`, `h_dataSheet`, `h_download`, `h_pm`, `h_pfwz`, `h_cz`, `h_gy`, `h_ys`, `h_mz`, `h_lsj`, `h_hyj`, `h_tc1`, `h_tc2`, `h_tc3`, `h_kc`, `h_isPass`) VALUES
(416, '网站主栏目', 108, '《开盘通知》', NULL, 227, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-05-04 09:41:03', 0, 0, NULL, NULL, '【优汇宝理财】<br />\r\n手机版+ 安卓APP+苹果APP5.4号开盘，国内顶尖技术团队维护，搭配高防高配服务器<br />\r\n三大优势：不崩盘，不限制，不卡顿！全球首家独创模式.<br />\r\n&nbsp;<br />\r\n静态投资收益：<br />\r\n投资30元，下单后即返8元，每天分红收入8元，5天出局共升值48元。<br />\r\n投资300元，下单后即返70元，每天分红收入70元，5天出局共升值420元<br />\r\n投资3000元，下单后即返560元，每天分红收入560元，6天出局总共升值3920元<br />\r\n&nbsp;<br />\r\n动态推广收益：<br />\r\n1级6%，2级3%，三级2% ，四到六级1%，七到八级0.5%<br />\r\n&nbsp;<br />\r\n团队业绩奖：<br />\r\n直推8人，团队业绩达1000元奖励红包68元<br />\r\n直推15人，团队业绩达3000元奖励红包158元<br />\r\n直推20人，团队业绩达6000元奖励红包288元<br />\r\n直推30人，团队业绩达10000元奖励红包588元<br />\r\n&nbsp;<br />\r\n全球分红奖：<br />\r\n当日团队业绩达9000，可享受当日平台总业绩4%分红<br />\r\n当日团队业绩达15000，可享受当日平台总业绩4%分红<br />\r\n当日团队业绩达24000，可享受当日平台总业绩3%分红<br />\r\n&nbsp;<br />\r\n提现：<br />\r\n10元起提，支持支付宝微信，半小时内到账，提现收取手续费10%（8%作为提现感恩奖，2%作为平台管理费）<br />\r\n&nbsp;<br />\r\n积分大转盘抽奖福利：<br />\r\n参与奖红包12.88元 五等奖红包18.88元<br />\r\n四等奖红包28.88元 三等奖红包28.88元<br />\r\n二等奖红包88.88元 等奖红包188.88元<br />\r\n10积分即可转盘抽奖一次，只要参与抽奖就能获得保底参与奖12.88元。手气好还可抽到特等奖！抽奖只能用积分参与。<br />\r\n积分获得方式：自己或直推下级会员下单30元自动获得1积分，下单300元自动获得10积分，3000元获得100积分。', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', '0.00', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `h_category`
--

CREATE TABLE IF NOT EXISTS `h_category` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=228 ;

--
-- 转存表中的数据 `h_category`
--

INSERT INTO `h_category` (`id`, `h_location`, `h_menuId`, `h_title`, `h_pageKey`, `h_order`, `h_addTime`, `h_picBig`, `h_picBigN`) VALUES
(227, '网站主栏目', 108, '玩家公告', NULL, 1, '2016-01-31 21:25:00', '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_config`
--

CREATE TABLE IF NOT EXISTS `h_config` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `h_config`
--

INSERT INTO `h_config` (`id`, `h_webName`, `h_webLogo`, `h_webLogoLogin`, `h_webKeyword`, `h_keyword`, `h_description`, `h_leftContact`, `h_counter`, `h_footer`, `h_rewriteOpen`, `h_point1Member`, `h_point1MemberPoint2`, `h_point2Quit`, `h_withdrawFee`, `h_withdrawMinCom`, `h_withdrawMinMoney`, `h_point2Lottery`, `h_lottery1`, `h_lottery2`, `h_lottery3`, `h_lottery4`, `h_lottery5`, `h_lottery6`, `h_point2Com1`, `h_point2Com2`, `h_point2Com3`, `h_point2Com4`, `h_point2Com5`, `h_point2Com6`, `h_point2Com7`, `h_point2Com8`, `h_point2Com9`, `h_point2Com10`, `h_levelUpTo0`, `h_levelUpTo1`, `h_levelUpTo2`, `h_levelUpTo3`, `h_levelUpTo4`, `h_levelUpTo5`, `h_levelUpTo6`, `h_levelUpTo7`, `h_levelUpTo8`, `h_levelUpTo9`, `h_levelUpTo10`, `h_serviceQQ`, `h_point2ComReg`, `h_point2ComRegAct`, `h_point2ComBuy`) VALUES
(1, '优汇宝理财创业', '/ui/images/logo.png', '/ui/images/logo.png', '优汇宝理财创业', '优汇宝理财创业', '优汇宝理财创业', '', '', '', 0, 0, 0, 0, '0.05', 0, 5, 10, 0, 0, 200, 500, 1500, 7000, '0.08', '0.03', '0.02', '0.01', '0.02', '0.01', '0.005', '0.005', '0.00', '0.00', 0, 111111, 111111, 111111, 111111, 0, 0, 0, 0, 0, 0, '', 0, 10, 3);

-- --------------------------------------------------------

--
-- 表的结构 `h_farm_shop`
--

CREATE TABLE IF NOT EXISTS `h_farm_shop` (
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
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

--
-- 转存表中的数据 `h_farm_shop`
--

INSERT INTO `h_farm_shop` (`id`, `h_title`, `h_pic`, `h_point2Day`, `h_life`, `h_money`, `h_minMemberLevel`, `h_dayBuyMaxNum`, `h_allMaxNum`, `h_order`, `h_addTime`, `h_location`, `h_menuId`) VALUES
(107, '投资300元股', '/upload/2017/05/03/2017050321132282496.png', 70, 6, 300, 2, 1, 1, 0, '0000-00-00 00:00:00', NULL, NULL),
(108, '投资3000元股', '/upload/2017/05/03/2017050321133566755.png', 560, 7, 3000, 3, 1, 1, 0, '0000-00-00 00:00:00', NULL, NULL),
(109, '投资30元股', '/upload/2017/05/03/2017050321130986712.png', 8, 6, 30, 1, 1, 1, 0, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_guestbook`
--

CREATE TABLE IF NOT EXISTS `h_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_fullName` varchar(50) DEFAULT NULL,
  `h_address` varchar(250) DEFAULT NULL,
  `h_email` varchar(50) DEFAULT NULL,
  `h_phone` varchar(50) DEFAULT NULL,
  `h_isPass` int(11) DEFAULT '0',
  `h_addTime` datetime DEFAULT NULL,
  `h_message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_log_point1`
--

CREATE TABLE IF NOT EXISTS `h_log_point1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_price` decimal(14,2) DEFAULT '0.00',
  `h_about` varchar(250) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(50) DEFAULT NULL,
  `h_type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_log_point2`
--

CREATE TABLE IF NOT EXISTS `h_log_point2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` varchar(20) DEFAULT NULL,
  `h_price` decimal(14,2) DEFAULT '0.00',
  `h_about` varchar(250) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  `h_actIP` char(50) DEFAULT NULL,
  `h_type` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `h_log_point2`
--

INSERT INTO `h_log_point2` (`id`, `h_userName`, `h_price`, `h_about`, `h_addTime`, `h_actIP`, `h_type`) VALUES
(1, '15566778899', '500.00', '', '2017-05-22 15:02:18', '175.44.166.130', '管理员操作'),
(2, '15566778899', '-300.00', '投资300元股，数量：1', '2017-05-22 15:04:37', '175.44.166.130', '购买物品'),
(3, '15566778899', '-30.00', '投资30元股，数量：1', '2017-05-22 15:04:37', '175.44.166.130', '购买物品'),
(4, '15566778899', '78.00', '每日分红，下次分红24小时到账', '2017-05-22 15:04:37', '175.44.166.130', '分红');

-- --------------------------------------------------------

--
-- 表的结构 `h_member`
--

CREATE TABLE IF NOT EXISTS `h_member` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `h_member`
--

INSERT INTO `h_member` (`id`, `h_userName`, `h_passWord`, `h_passWordII`, `h_fullName`, `h_sex`, `h_mobile`, `h_qq`, `h_email`, `h_regTime`, `h_regIP`, `h_isPass`, `h_moneyCurr`, `h_parentUserName`, `h_level`, `h_point1`, `h_point2`, `h_lastTime`, `h_lastIP`, `h_alipayUserName`, `h_alipayFullName`, `h_addrAddress`, `h_addrPostcode`, `h_addrFullName`, `h_addrTel`, `h_weixin`, `h_logins`, `h_a1`, `h_q1`, `h_a2`, `h_q2`, `h_a3`, `h_q3`, `h_isLock`, `first_buy`, `h_jifen`) VALUES
(1, '15566778899', 'e120ea280aa50693d5568d0071456460', 'e120ea280aa50693d5568d0071456460', NULL, NULL, NULL, NULL, NULL, '2017-05-22 14:49:50', '175.44.166.130', 1, '0.00', '', 4, '0.00', '248.00', '2017-05-22 14:55:04', '175.44.166.130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(2, '15126359833', '196008e0c8a6329d54b9a1b026a03374', '196008e0c8a6329d54b9a1b026a03374', NULL, NULL, NULL, NULL, NULL, '2017-05-22 22:26:26', '112.116.99.24', 1, '0.00', '', 4, '0.00', '0.00', '2017-05-22 22:31:12', '14.111.61.90', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h_member_farm`
--

CREATE TABLE IF NOT EXISTS `h_member_farm` (
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
  PRIMARY KEY (`id`),
  KEY `order_id` (`h_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `h_member_farm`
--

INSERT INTO `h_member_farm` (`id`, `h_userName`, `h_pid`, `h_num`, `h_addTime`, `h_endTime`, `h_lastSettleTime`, `h_settleLen`, `h_isEnd`, `h_title`, `h_pic`, `h_point2Day`, `h_life`, `h_money`) VALUES
(1, '15566778899', 107, 1, '2017-05-22 15:04:37', '2017-05-29 15:04:37', '2017-05-22 15:04:37', 1, 0, '投资300元股', '/upload/2017/05/03/2017050321132282496.png', 70, 6, 300),
(2, '15566778899', 109, 1, '2017-05-22 15:04:37', '2017-05-29 15:04:37', '2017-05-22 15:04:37', 1, 0, '投资30元股', '/upload/2017/05/03/2017050321130986712.png', 8, 6, 30);

-- --------------------------------------------------------

--
-- 表的结构 `h_member_msg`
--

CREATE TABLE IF NOT EXISTS `h_member_msg` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `h_member_msg`
--

INSERT INTO `h_member_msg` (`id`, `h_userName`, `h_toUserName`, `h_info`, `h_addTime`, `h_actIP`, `h_isRead`, `h_readTime`, `h_isDelete`, `h_deleteTime`) VALUES
(1, '[系统消息]', '15566778899', '恭喜您购买物品成功，本次共消费330元', '2017-05-22 15:04:37', '175.44.166.130', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_member_shop_cart`
--

CREATE TABLE IF NOT EXISTS `h_member_shop_cart` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_member_shop_order`
--

CREATE TABLE IF NOT EXISTS `h_member_shop_order` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_menu`
--

CREATE TABLE IF NOT EXISTS `h_menu` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- 转存表中的数据 `h_menu`
--

INSERT INTO `h_menu` (`id`, `h_location`, `h_type`, `h_adminFile`, `h_title`, `h_pageKey`, `h_href`, `h_isPass`, `h_target`, `h_order`, `h_picBigWidth`, `h_picBigHeight`, `h_picSmallWidth`, `h_picSmallHeight`) VALUES
(83, '网站主栏目', 'link', 'link.php', '首页', 'index', '/', 1, '_self', 1, 0, 0, 0, 0),
(108, '网站主栏目', 'news', 'news.php', '玩家公告', 'wan-jia-gong-gao', 'http://', 1, '_self', 2, 600, 450, 200, 150),
(109, '网站主栏目', 'pics', 'pics1.php', '农场商店', 'nong-chang-shang-dian', 'http://', 1, '_self', 3, 600, 450, 200, 150);

-- --------------------------------------------------------

--
-- 表的结构 `h_pay_order`
--

CREATE TABLE IF NOT EXISTS `h_pay_order` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- 转存表中的数据 `h_pay_order`
--

INSERT INTO `h_pay_order` (`id`, `h_payId`, `h_orderId`, `h_payWay`, `h_payType`, `h_payPrice`, `h_addTime`, `h_payTime`, `h_payState`, `h_wxNickName`, `h_wxOpenId`) VALUES
(106, '20160112212109858', '20160111112850636', '微信', 'JsApiPay', '88888.00', '2016-01-12 21:21:09', '2016-01-12 21:21:09', '已支付', '', ''),
(107, NULL, '10000503011704300032030001520010', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(108, NULL, '10000503011704300032070001120004', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(109, NULL, '10000503011704300032030001010008', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(110, NULL, '10000503011704300032090000020112', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(111, NULL, '10000503011704300032090001020084', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(112, NULL, '10000503011704300032000001120053', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(113, NULL, '10000503011705040032050001720101', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(114, NULL, '10000503011705040032060001220146', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(115, NULL, '10000503011705040032020000520161', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(116, NULL, '10000503011705040032060000710195', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(117, NULL, '10000503011705040032010000220150', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(118, NULL, '10000503011705040032030001420158', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(119, NULL, '10000503011705040032010000210203', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(120, NULL, '10000503011705040032060001720176', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(121, NULL, '10000503011705040032020000320162', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(122, NULL, '10000503011705040032040000520168', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(123, NULL, '10000503011705040032020001910200', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(124, NULL, '10000503011705040032040001510214', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(125, NULL, '10000503011705040032050000610211', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(126, NULL, '10000503011705040032050001610197', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(127, NULL, '10000503011705040032010000210191', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(128, NULL, '10000503011705040032000001120206', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(129, NULL, '10000503011705040032050001620183', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(130, NULL, '10000503011705040032060001710182', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(131, NULL, '10000503011705040032020000320197', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(132, NULL, '10000503011705040032040001520195', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(133, NULL, '10000503011705040032040000520188', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(134, NULL, '10000503011705040032010001220190', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(135, NULL, '10000503011705040032070001810214', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(136, NULL, '10000503011705040032000001110187', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(137, NULL, '10000503011705040032000001110228', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(138, NULL, '10000503011705040032040000510201', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(139, NULL, '10000503011705040032050001610195', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(140, NULL, '10000503011705040032090001010234', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(141, NULL, '10000503011705040032040000510235', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(142, NULL, '10000503011705040032000001120209', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(143, NULL, '10000503011705040032090000010240', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(144, NULL, '10000503011705040032020001310215', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(145, NULL, '10000503011705040032080000910220', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(146, NULL, '10000503011705040032050001620238', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(147, NULL, '10000503011705040032040001510233', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(148, NULL, '10000503011705040032010001210241', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(149, NULL, '10000503011705040032030000410255', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(150, NULL, '10000503011705040032050000620233', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(151, NULL, '10000503011705040032000000120227', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(152, NULL, '10000503011705040032050000610259', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(153, NULL, '10000503011705040032020001310217', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(154, NULL, '10000503011705040032080001910251', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(155, NULL, '10000503011705040032030001420222', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(156, NULL, '10000503011705040032060001710252', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(157, NULL, '10000503011705040032080000910221', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(158, NULL, '10000503011705050032030001620029', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(159, NULL, '10000503011705050032010000710009', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(160, NULL, '10000503011705050032030001920026', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(161, NULL, '10000503011705050032030000220029', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(162, NULL, '10000503011705050032050000610057', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(163, NULL, '10000503011705050032080001120022', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(164, NULL, '10000503011705050032000001720025', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(165, NULL, '10000503011705050032090000720001', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(166, NULL, '10000503011705050032080000120034', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(167, NULL, '10000503011705050032010000220041', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(168, NULL, '10000503011705050032010000420069', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(169, NULL, '10000503011705050032090001010143', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(170, NULL, '10000503011705050032020001720113', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(171, NULL, '10000503011705050032060000710146', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(172, NULL, '10000503011705050032030001420093', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(173, NULL, '10000503011705050032010000720115', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(174, NULL, '10000503011705050032070000820090', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(175, NULL, '10000503011705050032040000610116', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(176, NULL, '10000503011705050032000000210132', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(177, NULL, '10000503011705050032060000710141', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(178, NULL, '10000503011705050032040001510129', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(179, NULL, '10000503011705050032000000110149', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(180, NULL, '10000503011705050032040000310129', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(181, NULL, '12365489652', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(182, NULL, '234256rt', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(183, NULL, '10000503011705050032010000220133', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(184, NULL, '10000503011705050032040000510161', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(185, NULL, '10000503011705050032040000510161', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(186, NULL, '10000503011705050032030000420159', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(187, NULL, '10000503011705050032070001810183', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(188, NULL, '10000503011705050032000000120168', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(189, NULL, '10000503011705050032070001820203', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(190, NULL, '10000503011705050032020000310217', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(191, NULL, '10000503011705050032010000210235', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL),
(192, NULL, '10000503011705050032090001010245', NULL, NULL, '0.00', NULL, '0000-00-00 00:00:00', '待支付', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_point2_sell`
--

CREATE TABLE IF NOT EXISTS `h_point2_sell` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_point2_shop`
--

CREATE TABLE IF NOT EXISTS `h_point2_shop` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=162 ;

-- --------------------------------------------------------

--
-- 表的结构 `h_recharge`
--

CREATE TABLE IF NOT EXISTS `h_recharge` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=497 ;

--
-- 转存表中的数据 `h_recharge`
--

INSERT INTO `h_recharge` (`id`, `h_userName`, `h_money`, `h_fee`, `h_bank`, `h_bankFullname`, `h_bankCardId`, `h_mobile`, `h_addTime`, `h_isRead`, `h_state`, `h_isReturn`, `h_reply`, `h_actIP`) VALUES
(44, '13995970003', 200, 0, 1, '67771606', NULL, NULL, '2017-01-11 02:23:34', 0, 1, 1, '微信充值', '222.240.210.140'),
(55, '13947090753', 30, 0, 1, '39341735', NULL, NULL, '2017-01-11 08:52:31', 0, 1, 1, '微信充值', '42.123.69.189'),
(56, '15838793922', 100, 0, 1, '86514282', NULL, NULL, '2017-01-11 08:55:37', 0, 1, 1, '微信充值', '223.104.19.213'),
(58, '13179989628', 30, 0, 1, '30440063', NULL, NULL, '2017-01-11 09:27:48', 0, 1, 1, '微信充值', '49.114.166.6'),
(59, '15958926713', 30, 0, 1, '69048767', NULL, NULL, '2017-01-11 10:01:38', 0, 1, 1, '微信充值', '115.231.76.109'),
(64, '15191988722', 30, 0, 1, '12422485', NULL, NULL, '2017-01-11 11:28:34', 0, 1, 1, '微信充值', '124.89.86.184'),
(80, '13124593390', 30, 0, 2, '14935607', NULL, NULL, '2017-01-11 12:45:09', 0, 2, 0, '', '61.47.190.15'),
(81, '15367652980', 30, 0, 2, '25485229', NULL, NULL, '2017-01-11 12:47:09', 0, 2, 0, '', '222.245.76.134'),
(82, '13955327340', 30, 0, 1, '23150634', NULL, NULL, '2017-01-11 12:57:46', 0, 2, 0, '', '221.7.229.84'),
(83, '17091599455', 30, 0, 1, '42338256', NULL, NULL, '2017-01-11 12:59:30', 0, 1, 1, '', '113.143.245.239'),
(84, '13240579990', 30, 0, 1, '38416137', NULL, NULL, '2017-01-11 13:03:40', 0, 2, 0, '', '218.10.217.107'),
(85, '13835068888', 30, 0, 1, '86948242', NULL, NULL, '2017-01-11 13:11:58', 0, 0, 0, NULL, '182.244.33.250'),
(86, '13015578891', 30, 0, 1, '22150878', NULL, NULL, '2017-01-11 13:24:40', 0, 0, 0, NULL, '124.160.213.231'),
(87, '13668787179', 30, 0, 1, '85217895', NULL, NULL, '2017-01-11 13:25:07', 0, 0, 0, NULL, '39.128.1.0'),
(88, '13015578891', 30, 0, 1, '44458618', NULL, NULL, '2017-01-11 13:25:29', 0, 1, 1, '微信充值', '124.160.213.231'),
(89, '13668787179', 30, 0, 1, '72536926', NULL, NULL, '2017-01-11 13:29:18', 0, 0, 0, NULL, '39.128.1.0'),
(90, '15951394003', 100, 0, 1, '97102355', NULL, NULL, '2017-01-11 13:33:28', 0, 0, 0, NULL, '113.105.154.54'),
(91, '15860288077', 100, 0, 1, '29566650', NULL, NULL, '2017-01-11 13:39:36', 0, 1, 1, '微信充值', '120.35.156.67'),
(92, '15951394003', 100, 0, 1, '55472412', NULL, NULL, '2017-01-11 13:41:12', 0, 0, 0, '', '58.20.156.132'),
(93, '15951394003', 2000, 0, 1, '25435791', NULL, NULL, '2017-01-11 13:59:55', 0, 0, 0, NULL, '113.105.154.114'),
(94, '15060074700', 30, 0, 1, '56260681', NULL, NULL, '2017-01-11 14:01:36', 0, 0, 0, NULL, '111.147.212.212'),
(95, '17731201280', 30, 0, 1, '15707397', NULL, NULL, '2017-01-11 14:11:48', 0, 0, 0, NULL, '27.187.101.0'),
(96, '15854925576', 30, 0, 1, '10321350', NULL, NULL, '2017-01-11 14:18:13', 0, 1, 1, '', '123.132.253.134'),
(97, '15191988722', 200, 0, 1, '44346008', NULL, NULL, '2017-01-11 14:18:58', 0, 1, 1, '', '111.19.75.184'),
(98, '17731201280', 30, 0, 1, '25295715', NULL, NULL, '2017-01-11 14:28:03', 0, 0, 0, NULL, '27.187.101.0'),
(99, '17731201280', 30, 0, 1, '60490417', NULL, NULL, '2017-01-11 14:29:55', 0, 0, 0, NULL, '27.187.101.0'),
(100, '17731201280', 30, 0, 1, '70018310', NULL, NULL, '2017-01-11 14:30:30', 0, 0, 0, NULL, '27.187.101.0'),
(101, '17731201280', 30, 0, 1, '52236938', NULL, NULL, '2017-01-11 14:34:11', 0, 1, 1, '', '27.187.101.0'),
(102, '15951394003', 100, 0, 1, '12079162', NULL, NULL, '2017-01-11 14:49:45', 0, 1, 1, '', '58.20.156.191'),
(103, '18175859662', 400, 0, 1, '77049560', NULL, NULL, '2017-01-11 14:53:07', 0, 0, 0, NULL, '223.147.222.93'),
(104, '13327348905', 30, 0, 1, '91469116', NULL, NULL, '2017-01-11 14:57:30', 0, 1, 1, '', '223.147.222.93'),
(105, '13276354024', 100, 0, 1, '45919799', NULL, NULL, '2017-01-11 15:05:30', 0, 1, 1, '', '112.37.115.27'),
(106, '13355561690', 30, 0, 1, '23905944', NULL, NULL, '2017-01-11 15:11:58', 0, 0, 0, NULL, '36.63.105.93'),
(107, '13355561690', 30, 0, 1, '27254028', NULL, NULL, '2017-01-11 15:15:50', 0, 0, 0, NULL, '36.63.105.93'),
(108, '18903197525', 30, 0, 1, '25235290', NULL, NULL, '2017-01-11 15:25:03', 0, 0, 0, NULL, '106.119.42.210'),
(109, '18286411712', 30, 0, 1, '44779968', NULL, NULL, '2017-01-11 15:51:48', 0, 0, 0, NULL, '117.135.225.56'),
(110, '15229623991', 100, 0, 1, '51283874', NULL, NULL, '2017-01-11 15:57:48', 0, 0, 0, NULL, '111.19.75.225'),
(111, '15229623991', 100, 0, 1, '47562255', NULL, NULL, '2017-01-11 16:03:36', 0, 1, 1, '', '111.19.75.225'),
(112, '13330621592', 30, 0, 1, '42368469', NULL, NULL, '2017-01-11 16:13:04', 0, 0, 0, NULL, '118.118.45.6'),
(113, '13643748783', 30, 0, 1, '28561401', NULL, NULL, '2017-01-11 16:15:59', 0, 0, 0, NULL, '171.12.54.80'),
(114, '13643748783', 30, 0, 1, '70853271', NULL, NULL, '2017-01-11 16:16:37', 0, 0, 0, NULL, '171.12.54.80'),
(115, '13562750583', 30, 0, 1, '49907836', NULL, NULL, '2017-01-11 16:17:05', 0, 0, 0, NULL, '39.83.154.5'),
(116, '13562750583', 30, 0, 1, '93548278', NULL, NULL, '2017-01-11 16:18:10', 0, 0, 0, NULL, '39.83.154.5'),
(117, '13562750583', 30, 0, 1, '22700195', NULL, NULL, '2017-01-11 16:18:21', 0, 0, 0, NULL, '39.83.154.5'),
(118, '13562750583', 30, 0, 1, '95058898', NULL, NULL, '2017-01-11 16:20:26', 0, 0, 0, NULL, '39.83.154.5'),
(119, '13643748783', 30, 0, 1, '92930297', NULL, NULL, '2017-01-11 16:21:40', 0, 1, 1, '', '171.12.54.80'),
(120, '15291202140', 200, 0, 1, '54469909', NULL, NULL, '2017-01-11 16:26:11', 0, 1, 1, '', '124.89.86.184'),
(121, '18329631908', 30, 0, 1, '42511291', NULL, NULL, '2017-01-11 17:21:25', 0, 1, 1, '', '113.143.245.239'),
(122, '13772391190', 30, 0, 1, '28671264', NULL, NULL, '2017-01-11 17:25:19', 0, 0, 0, NULL, '113.143.245.239'),
(123, '15577710770', 100, 0, 1, '31612854', NULL, NULL, '2017-01-11 17:26:46', 0, 1, 1, '', '121.31.250.109'),
(124, '13015578891', 400, 0, 1, '78197631', NULL, NULL, '2017-01-11 17:33:04', 0, 1, 1, '', '112.12.49.188'),
(125, '15056407939', 30, 0, 1, '72130432', NULL, NULL, '2017-01-11 18:08:16', 0, 0, 0, NULL, '112.26.74.139'),
(126, '13050882558', 30, 0, 1, '36592407', NULL, NULL, '2017-01-11 18:15:07', 0, 0, 0, NULL, '119.117.83.212'),
(127, '15925775208', 200, 0, 1, '76195373', NULL, NULL, '2017-01-11 18:41:05', 0, 0, 0, NULL, '116.231.92.105'),
(128, '15866219387', 100, 0, 1, '67724914', NULL, NULL, '2017-01-11 18:41:41', 0, 1, 1, '', '101.254.165.181'),
(129, '15925775208', 200, 0, 1, '59666442', NULL, NULL, '2017-01-11 18:42:02', 0, 0, 0, NULL, '117.148.214.85'),
(130, '13355561690', 30, 0, 1, '70383605', NULL, NULL, '2017-01-11 18:54:21', 0, 1, 1, '', '36.63.105.93'),
(131, '15507786547', 30, 0, 1, '31931457', NULL, NULL, '2017-01-11 19:02:47', 0, 0, 0, NULL, '171.39.197.189'),
(132, '15951394003', 30, 0, 1, '56532592', NULL, NULL, '2017-01-11 19:17:18', 0, 0, 0, NULL, '106.111.51.23'),
(133, '13409836009', 30, 0, 1, '44645385', NULL, NULL, '2017-01-11 19:29:12', 0, 0, 0, NULL, '119.102.37.26'),
(134, '13050882558', 30, 0, 1, '25339660', NULL, NULL, '2017-01-11 19:29:12', 0, 0, 0, NULL, '119.117.83.212'),
(135, '13050882558', 30, 0, 1, '89142761', NULL, NULL, '2017-01-11 19:29:40', 0, 0, 0, NULL, '119.117.83.212'),
(136, '13945347685', 30, 0, 1, '66123657', NULL, NULL, '2017-01-11 19:38:37', 0, 1, 1, '', '1.190.70.237'),
(137, '17731201280', 30, 0, 1, '75901489', NULL, NULL, '2017-01-11 20:33:59', 0, 0, 0, NULL, '27.187.98.110'),
(138, '17712328766', 30, 0, 1, '74036560', NULL, NULL, '2017-01-11 22:12:18', 0, 0, 0, NULL, '114.227.131.103'),
(139, '18398049258', 30, 0, 1, '33565673', NULL, NULL, '2017-01-11 22:23:21', 0, 1, 1, '', '117.174.45.171'),
(140, '17602200266', 1000, 0, 1, '17292175', NULL, NULL, '2017-01-11 22:32:39', 0, 0, 0, NULL, '36.106.171.172'),
(141, '17602200266', 1000, 0, 1, '82861328', NULL, NULL, '2017-01-11 22:33:08', 0, 0, 0, NULL, '36.106.171.172'),
(142, '17602200266', 30, 0, 1, '20791320', NULL, NULL, '2017-01-11 22:33:13', 0, 0, 0, NULL, '36.106.171.172'),
(143, '15925775208', 100, 0, 1, '80087280', NULL, NULL, '2017-01-11 23:14:13', 0, 0, 0, NULL, '111.23.13.189'),
(144, '13220968480', 30, 0, 1, '99631958', NULL, NULL, '2017-01-12 00:01:07', 0, 0, 0, NULL, '112.37.115.27'),
(145, '13220968480', 30, 0, 1, '45384216', NULL, NULL, '2017-01-12 00:02:26', 0, 0, 0, NULL, '112.37.115.27'),
(146, '13739427698', 30, 0, 1, '89271850', NULL, NULL, '2017-01-12 00:05:35', 0, 0, 0, NULL, '222.213.223.161'),
(147, '13220968480', 30, 0, 1, '74585876', NULL, NULL, '2017-01-12 00:13:23', 0, 0, 0, NULL, '112.37.115.27'),
(148, '15989436486', 30, 0, 1, '65272216', NULL, NULL, '2017-01-12 00:18:30', 0, 0, 0, NULL, '14.222.183.73'),
(149, '13220968480', 30, 0, 1, '44203186', NULL, NULL, '2017-01-12 00:21:30', 0, 0, 0, NULL, '112.37.115.27'),
(150, '15989436486', 30, 0, 1, '42626647', NULL, NULL, '2017-01-12 00:27:22', 0, 0, 0, NULL, '14.222.183.73'),
(151, '15989436486', 30, 0, 1, '41272583', NULL, NULL, '2017-01-12 00:37:45', 0, 1, 1, '', '14.222.183.73'),
(152, '15275808774', 30, 0, 1, '22598571', NULL, NULL, '2017-01-12 00:50:48', 0, 0, 0, NULL, '112.37.115.27'),
(153, '13220968480', 30, 0, 1, '69117431', NULL, NULL, '2017-01-12 00:52:57', 0, 0, 0, NULL, '112.37.115.27'),
(154, '15275808774', 30, 0, 1, '85432128', NULL, NULL, '2017-01-12 00:54:30', 0, 0, 0, NULL, '112.37.115.27'),
(155, '15275808774', 30, 0, 1, '64758605', NULL, NULL, '2017-01-12 00:58:40', 0, 0, 0, NULL, '112.37.115.27'),
(156, '13220968480', 30, 0, 1, '55406494', NULL, NULL, '2017-01-12 01:04:11', 0, 0, 0, NULL, '112.37.115.27'),
(157, '13220968480', 30, 0, 1, '60089416', NULL, NULL, '2017-01-12 01:04:12', 0, 0, 0, NULL, '112.37.115.27'),
(158, '13220968480', 30, 0, 1, '52324829', NULL, NULL, '2017-01-12 01:05:04', 0, 0, 0, NULL, '112.37.115.27'),
(159, '15275808774', 30, 0, 1, '55865173', NULL, NULL, '2017-01-12 01:07:10', 0, 0, 0, NULL, '112.37.115.27'),
(160, '13729761505', 400, 0, 1, '97431945', NULL, NULL, '2017-01-12 01:27:22', 0, 0, 0, NULL, '14.209.227.252'),
(161, '13729761505', 400, 0, 1, '62124633', NULL, NULL, '2017-01-12 01:45:23', 0, 1, 1, '', '14.209.227.252'),
(162, '15775956724', 1000, 0, 1, '73679504', NULL, NULL, '2017-01-12 02:32:39', 0, 0, 0, NULL, '125.64.231.120'),
(163, '13228972897', 30, 0, 1, '53406982', NULL, NULL, '2017-01-12 03:03:21', 0, 1, 1, '', '27.98.255.222'),
(164, '18898470616', 30, 0, 1, '78148193', NULL, NULL, '2017-01-12 03:09:58', 0, 0, 0, NULL, '219.135.216.165'),
(165, '15906439367', 30, 0, 1, '25345153', NULL, NULL, '2017-01-12 03:14:52', 0, 0, 0, NULL, '112.17.236.122'),
(166, '15906439367', 30, 0, 1, '70589599', NULL, NULL, '2017-01-12 03:16:43', 0, 1, 1, '', '112.17.236.122'),
(167, '15906402478', 30, 0, 1, '20244750', NULL, NULL, '2017-01-12 03:24:26', 0, 0, 0, NULL, '39.180.71.45'),
(168, '18898470616', 30, 0, 1, '87640380', NULL, NULL, '2017-01-12 03:27:05', 0, 0, 0, NULL, '122.13.242.237'),
(169, '15275808774', 100, 0, 1, '91285095', NULL, NULL, '2017-01-12 07:49:30', 0, 1, 1, '', '112.37.115.27'),
(170, '17772634076', 100, 0, 1, '89161987', NULL, NULL, '2017-01-12 08:12:02', 0, 0, 0, NULL, '106.9.76.145'),
(171, '13210420111', 30, 0, 1, '99807739', NULL, NULL, '2017-01-12 08:16:04', 0, 1, 1, '', '123.132.253.134'),
(172, '13847622602', 30, 0, 1, '98472900', NULL, NULL, '2017-01-12 10:24:07', 0, 0, 0, NULL, '124.67.241.125'),
(173, '15009900680', 30, 0, 1, '43741760', NULL, NULL, '2017-01-12 10:28:36', 0, 1, 1, '', '222.81.176.85'),
(174, '15943399228', 2000, 0, 1, '31936950', NULL, NULL, '2017-01-12 10:43:39', 0, 0, 0, NULL, '122.136.81.144'),
(175, '15854925576', 30, 0, 1, '43771972', NULL, NULL, '2017-01-12 10:45:17', 0, 1, 1, '', '123.132.253.134'),
(176, '13847622602', 30, 0, 1, '23801574', NULL, NULL, '2017-01-12 10:46:08', 0, 1, 1, '', '124.67.241.125'),
(177, '13847622602', 30, 0, 1, '80686035', NULL, NULL, '2017-01-12 10:48:50', 0, 0, 0, NULL, '124.67.241.125'),
(178, '13847622602', 100, 0, 1, '32041320', NULL, NULL, '2017-01-12 10:50:56', 0, 1, 1, '', '124.67.241.125'),
(179, '15889778652', 200, 0, 1, '27026062', NULL, NULL, '2017-01-12 11:21:13', 0, 1, 1, '', '180.158.23.25'),
(180, '13963284860', 30, 0, 1, '27959899', NULL, NULL, '2017-01-12 11:28:47', 0, 0, 0, NULL, '219.155.98.44'),
(181, '13963284860', 30, 0, 1, '10373535', NULL, NULL, '2017-01-12 11:30:27', 0, 0, 0, NULL, '182.39.212.40'),
(182, '13559083877', 30, 0, 1, '49309082', NULL, NULL, '2017-01-12 11:40:59', 0, 0, 0, NULL, '120.43.211.118'),
(183, '13947397233', 100, 0, 1, '98981018', NULL, NULL, '2017-01-12 11:49:48', 0, 1, 1, '', '123.178.72.95'),
(184, '13579519985', 30, 0, 1, '32255554', NULL, NULL, '2017-01-12 12:03:42', 0, 0, 0, NULL, '180.155.3.173'),
(185, '13963284860', 30, 0, 1, '21832275', NULL, NULL, '2017-01-12 12:14:35', 0, 0, 0, NULL, '112.35.17.74'),
(186, '13579519985', 30, 0, 1, '90944519', NULL, NULL, '2017-01-12 12:15:57', 0, 0, 0, NULL, '180.156.60.185'),
(187, '13579519985', 30, 0, 1, '84360961', NULL, NULL, '2017-01-12 12:18:00', 0, 0, 0, NULL, '180.156.60.185'),
(188, '15297846814', 200, 0, 1, '68938903', NULL, NULL, '2017-01-12 12:18:17', 0, 0, 0, NULL, '117.165.43.46'),
(189, '13579519985', 30, 0, 1, '40278320', NULL, NULL, '2017-01-12 12:18:17', 0, 0, 0, NULL, '180.156.60.185'),
(190, '13579519985', 30, 0, 1, '33332214', NULL, NULL, '2017-01-12 12:19:43', 0, 0, 0, NULL, '180.156.60.185'),
(191, '13835068888', 30, 0, 1, '31236572', NULL, NULL, '2017-01-12 12:21:39', 0, 0, 0, NULL, '182.244.33.250'),
(192, '13579519985', 30, 0, 1, '80567932', NULL, NULL, '2017-01-12 12:21:40', 0, 0, 0, NULL, '180.156.60.185'),
(193, '17795315637', 30, 0, 1, '90104064', NULL, NULL, '2017-01-12 12:22:01', 0, 1, 1, '', '1.50.64.79'),
(194, '17795315637', 30, 0, 1, '91287841', NULL, NULL, '2017-01-12 12:23:23', 0, 0, 0, NULL, '1.50.64.79'),
(195, '17795315637', 30, 0, 1, '23650512', NULL, NULL, '2017-01-12 12:24:01', 0, 0, 0, NULL, '1.50.64.79'),
(196, '17795315637', 30, 0, 1, '60896911', NULL, NULL, '2017-01-12 12:25:43', 0, 0, 0, NULL, '1.50.64.79'),
(197, '13579519985', 30, 0, 1, '74248046', NULL, NULL, '2017-01-12 12:26:30', 0, 0, 0, NULL, '180.156.60.185'),
(198, '13579519985', 30, 0, 1, '41201171', NULL, NULL, '2017-01-12 12:27:33', 0, 0, 0, NULL, '180.156.60.185'),
(199, '13579519985', 30, 0, 1, '35068054', NULL, NULL, '2017-01-12 12:29:11', 0, 0, 0, NULL, '180.156.60.185'),
(200, '15367652980', 30, 0, 1, '52308349', NULL, NULL, '2017-01-12 12:35:38', 0, 0, 0, NULL, '222.245.76.134'),
(201, '15854962343', 30, 0, 1, '48641662', NULL, NULL, '2017-01-12 12:39:50', 0, 1, 1, '', '123.132.253.134'),
(202, '17795315637', 30, 0, 1, '34065551', NULL, NULL, '2017-01-12 13:41:16', 0, 0, 0, NULL, '221.199.51.35'),
(203, '13963284860', 30, 0, 1, '27495727', NULL, NULL, '2017-01-12 13:47:22', 0, 0, 0, NULL, '219.155.98.44'),
(204, '13698317662', 100, 0, 1, '54143066', NULL, NULL, '2017-01-12 13:59:27', 0, 0, 0, NULL, '182.145.92.186'),
(205, '13698317662', 100, 0, 1, '90024414', NULL, NULL, '2017-01-12 14:02:43', 0, 0, 0, NULL, '182.145.92.186'),
(206, '13698317662', 100, 0, 1, '30025329', NULL, NULL, '2017-01-12 14:03:21', 0, 1, 1, '', '182.145.92.186'),
(207, '18504861370', 30, 0, 1, '63212280', NULL, NULL, '2017-01-12 14:07:34', 0, 0, 0, NULL, '124.67.241.125'),
(208, '18647938730', 200, 0, 1, '30385131', NULL, NULL, '2017-01-12 14:14:15', 0, 1, 1, '', '116.114.23.42'),
(209, '15832284521', 400, 0, 1, '41860351', NULL, NULL, '2017-01-12 14:19:14', 0, 0, 0, NULL, '27.187.102.178'),
(210, '18647938730', 30, 0, 1, '89433898', NULL, NULL, '2017-01-12 14:24:23', 0, 0, 0, NULL, '116.114.23.42'),
(211, '18835935742', 2000, 0, 1, '38295288', NULL, NULL, '2017-01-12 14:24:42', 0, 0, 0, NULL, '243.1.140.126, 195.125.225.10, 77.120.2'),
(212, '18835935742', 30, 0, 1, '74184875', NULL, NULL, '2017-01-12 14:25:10', 0, 0, 0, NULL, '28.176.85.125, 203.82.70.148, 59.11.40.'),
(213, '18835935742', 30, 0, 1, '18467712', NULL, NULL, '2017-01-12 14:26:11', 0, 1, 1, '', '188.134.144.70, 196.131.62.40, 80.101.2'),
(214, '15832284521', 400, 0, 1, '63651733', NULL, NULL, '2017-01-12 14:28:52', 0, 0, 0, NULL, '27.187.102.178'),
(215, '15832284521', 400, 0, 1, '97681884', NULL, NULL, '2017-01-12 14:34:02', 0, 1, 1, '', '27.187.102.178'),
(216, '13579519985', 30, 0, 1, '48405456', NULL, NULL, '2017-01-12 14:39:44', 0, 0, 0, NULL, '180.156.60.185'),
(217, '18628622436', 30, 0, 1, '72808837', NULL, NULL, '2017-01-12 14:44:54', 0, 0, 0, NULL, '1.82.226.158'),
(218, '18628622436', 30, 0, 1, '20577087', NULL, NULL, '2017-01-12 14:45:43', 0, 1, 1, '', '1.82.226.158'),
(219, '13701997725', 30, 0, 1, '40168457', NULL, NULL, '2017-01-12 14:45:53', 0, 1, 1, '', '180.173.171.93'),
(220, '13634632343', 1000, 0, 1, '13131103', NULL, NULL, '2017-01-12 14:45:58', 0, 0, 0, NULL, '223.104.17.82'),
(221, '15367652980', 30, 0, 1, '83317260', NULL, NULL, '2017-01-12 14:48:01', 0, 0, 0, NULL, '222.245.76.134'),
(222, '15367652980', 2000, 0, 1, '51750793', NULL, NULL, '2017-01-12 14:50:47', 0, 0, 0, NULL, '106.19.19.61'),
(223, '13583116805', 30, 0, 1, '75181884', NULL, NULL, '2017-01-12 15:18:58', 0, 0, 0, NULL, '111.14.119.244'),
(224, '18339580938', 30, 0, 1, '47076110', NULL, NULL, '2017-01-12 15:19:18', 0, 0, 0, NULL, '39.155.187.11'),
(225, '18339580938', 30, 0, 1, '30983886', NULL, NULL, '2017-01-12 15:19:21', 0, 0, 0, NULL, '39.155.187.11'),
(226, '18339580938', 30, 0, 1, '58109130', NULL, NULL, '2017-01-12 15:19:22', 0, 0, 0, NULL, '39.155.187.11'),
(227, '15240286180', 30, 0, 1, '10606994', NULL, NULL, '2017-01-12 15:19:31', 0, 0, 0, NULL, '180.118.193.38'),
(228, '13182229685', 30, 0, 1, '83388671', NULL, NULL, '2017-01-12 15:21:47', 0, 0, 0, NULL, '49.85.139.50'),
(229, '18339580938', 30, 0, 1, '91381225', NULL, NULL, '2017-01-12 15:23:50', 0, 0, 0, NULL, '39.155.187.11'),
(230, '13182229685', 30, 0, 1, '50844421', NULL, NULL, '2017-01-12 15:25:02', 0, 1, 1, '', '49.85.139.50'),
(231, '13579519985', 30, 0, 1, '24891967', NULL, NULL, '2017-01-12 15:34:33', 0, 0, 0, NULL, '222.81.176.85'),
(232, '18628622436', 100, 0, 1, '51742553', NULL, NULL, '2017-01-12 15:36:16', 0, 0, 0, NULL, '1.82.226.158'),
(233, '13583116805', 30, 0, 1, '24035034', NULL, NULL, '2017-01-12 15:37:49', 0, 0, 0, NULL, '61.52.213.32'),
(234, '13583116805', 30, 0, 1, '37084045', NULL, NULL, '2017-01-12 15:38:05', 0, 0, 0, NULL, '61.52.213.32'),
(235, '13579519985', 30, 0, 1, '59147338', NULL, NULL, '2017-01-12 15:38:05', 0, 0, 0, NULL, '222.81.176.85'),
(236, '13579519985', 100, 0, 1, '30286254', NULL, NULL, '2017-01-12 15:42:21', 0, 0, 0, NULL, '222.81.176.85'),
(237, '13579519985', 100, 0, 1, '81045837', NULL, NULL, '2017-01-12 15:43:32', 0, 1, 1, '', '222.81.176.85'),
(238, '15900766535', 30, 0, 1, '34425354', NULL, NULL, '2017-01-12 15:52:00', 0, 1, 1, '', '180.173.171.93'),
(239, '15752911694', 100, 0, 1, '17646484', NULL, NULL, '2017-01-12 15:52:11', 0, 0, 0, NULL, '183.225.77.88'),
(240, '15188126258', 30, 0, 1, '80422363', NULL, NULL, '2017-01-12 15:53:29', 0, 1, 1, '', '183.225.206.45'),
(241, '15752911694', 100, 0, 1, '30102233', NULL, NULL, '2017-01-12 15:53:41', 0, 0, 0, NULL, '183.225.77.88'),
(242, '13583116805', 30, 0, 1, '76456298', NULL, NULL, '2017-01-12 15:55:24', 0, 1, 1, '', '61.52.213.134'),
(243, '18628622436', 100, 0, 1, '79889526', NULL, NULL, '2017-01-12 16:14:20', 0, 0, 0, NULL, '1.82.226.158'),
(244, '18734224454', 30, 0, 1, '14540100', NULL, NULL, '2017-01-12 16:35:00', 0, 0, 0, NULL, '118.72.147.34'),
(245, '18734224454', 30, 0, 1, '22928161', NULL, NULL, '2017-01-12 16:35:38', 0, 0, 0, NULL, '118.72.147.34'),
(246, '18628622436', 200, 0, 1, '25496215', NULL, NULL, '2017-01-12 16:35:38', 0, 1, 1, '', '1.82.226.158'),
(247, '18734224454', 30, 0, 1, '45752258', NULL, NULL, '2017-01-12 16:35:49', 0, 0, 0, NULL, '118.72.147.34'),
(248, '18734224454', 30, 0, 1, '74478759', NULL, NULL, '2017-01-12 16:37:10', 0, 0, 0, NULL, '118.72.147.34'),
(249, '18734224454', 30, 0, 1, '33216857', NULL, NULL, '2017-01-12 16:37:39', 0, 1, 1, '', '118.72.147.34'),
(250, '13969958970', 30, 0, 1, '25927429', NULL, NULL, '2017-01-12 16:44:08', 0, 0, 0, NULL, '124.239.251.73'),
(251, '17625404566', 30, 0, 1, '23936157', NULL, NULL, '2017-01-12 16:48:13', 0, 0, 0, NULL, '180.112.241.207'),
(252, '13659686309', 200, 0, 1, '72374877', NULL, NULL, '2017-01-12 16:57:11', 0, 1, 1, '', '220.179.147.17'),
(253, '18211120975', 30, 0, 1, '13315124', NULL, NULL, '2017-01-12 17:01:52', 0, 1, 1, '', '221.221.100.90'),
(254, '15822135159', 30, 0, 1, '41835632', NULL, NULL, '2017-01-12 17:03:44', 0, 1, 1, '', '42.122.154.126'),
(255, '15009900680', 30, 0, 1, '27896728', NULL, NULL, '2017-01-12 17:13:25', 0, 1, 1, '', '222.81.176.85'),
(256, '15009900680', 30, 0, 1, '93737792', NULL, NULL, '2017-01-12 17:18:59', 0, 1, 1, '', '222.81.176.85'),
(257, '13643748783', 100, 0, 1, '86140747', NULL, NULL, '2017-01-12 17:20:57', 0, 1, 1, '', '171.12.54.80'),
(258, '15311427008', 30, 0, 1, '88211669', NULL, NULL, '2017-01-12 17:22:53', 0, 0, 0, NULL, '221.221.100.90'),
(259, '15311427008', 30, 0, 1, '71685485', NULL, NULL, '2017-01-12 17:23:20', 0, 1, 1, '', '221.221.100.90'),
(260, '15056407939', 100, 0, 1, '70765380', NULL, NULL, '2017-01-12 17:25:09', 0, 1, 1, '', '112.26.235.61'),
(261, '15191993623', 30, 0, 1, '59084167', NULL, NULL, '2017-01-12 17:40:05', 0, 0, 0, NULL, '113.143.240.181'),
(262, '13099021528', 30, 0, 1, '77986145', NULL, NULL, '2017-01-12 17:42:18', 0, 1, 1, '', '60.221.132.164'),
(263, '18348498760', 100, 0, 1, '22293701', NULL, NULL, '2017-01-12 17:57:10', 0, 1, 1, '', '36.40.218.83'),
(264, '13407305573', 30, 0, 1, '84544982', NULL, NULL, '2017-01-12 18:12:55', 0, 1, 1, '', '223.144.215.27'),
(265, '18859562578', 30, 0, 1, '19203796', NULL, NULL, '2017-01-12 18:17:00', 0, 0, 0, NULL, '36.249.25.197'),
(266, '18859562578', 30, 0, 1, '38564453', NULL, NULL, '2017-01-12 18:17:47', 0, 1, 1, '', '36.249.25.197'),
(267, '18750189748', 200, 0, 1, '30195617', NULL, NULL, '2017-01-12 19:17:51', 0, 0, 0, NULL, '183.240.33.41'),
(268, '18750189748', 100, 0, 1, '56054687', NULL, NULL, '2017-01-12 19:19:26', 0, 0, 0, NULL, '183.240.33.41'),
(269, '18750189748', 100, 0, 1, '93671875', NULL, NULL, '2017-01-12 19:20:19', 0, 0, 0, NULL, '183.240.33.41'),
(270, '18750189748', 100, 0, 1, '74140930', NULL, NULL, '2017-01-12 19:20:21', 0, 0, 0, NULL, '183.240.33.41'),
(271, '15752911694', 30, 0, 1, '62753601', NULL, NULL, '2017-01-12 19:31:31', 0, 0, 0, NULL, '183.225.77.147'),
(272, '13330621592', 100, 0, 1, '23411560', NULL, NULL, '2017-01-12 19:53:25', 0, 0, 0, NULL, '118.118.45.6'),
(273, '13378746011', 30, 0, 1, '27797851', NULL, NULL, '2017-01-12 19:53:31', 0, 0, 0, NULL, '183.225.206.45'),
(274, '13330621592', 100, 0, 1, '54063415', NULL, NULL, '2017-01-12 19:55:21', 0, 1, 1, '', '118.118.45.6'),
(275, '13378746011', 30, 0, 1, '85297546', NULL, NULL, '2017-01-12 19:59:10', 0, 0, 0, NULL, '183.225.206.45'),
(276, '13378746011', 100, 0, 1, '32593383', NULL, NULL, '2017-01-12 20:08:50', 0, 1, 1, '', '183.225.206.45'),
(277, '17712328766', 30, 0, 1, '16627502', NULL, NULL, '2017-01-12 20:19:48', 0, 0, 0, NULL, '121.231.144.78'),
(278, '18607195661', 100, 0, 1, '32225341', NULL, NULL, '2017-01-12 20:22:52', 0, 0, 0, NULL, '113.57.183.110'),
(279, '18607195661', 100, 0, 1, '27635803', NULL, NULL, '2017-01-12 20:24:38', 0, 0, 0, NULL, '113.57.183.110'),
(280, '15989436486', 100, 0, 1, '88348999', NULL, NULL, '2017-01-12 20:26:20', 0, 1, 1, '', '14.222.180.185'),
(281, '18607195661', 100, 0, 1, '46101074', NULL, NULL, '2017-01-12 20:28:16', 0, 0, 0, NULL, '113.57.183.110'),
(282, '18392798566', 400, 0, 1, '75173645', NULL, NULL, '2017-01-12 20:28:20', 0, 0, 0, NULL, '1.81.94.102'),
(283, '18607195661', 100, 0, 1, '75343933', NULL, NULL, '2017-01-12 20:36:01', 0, 1, 1, '', '113.57.183.110'),
(284, '18628622436', 1000, 0, 1, '31879272', NULL, NULL, '2017-01-12 20:37:44', 0, 1, 1, '', '111.20.133.36'),
(285, '18639900902', 30, 0, 1, '80905761', NULL, NULL, '2017-01-12 20:58:10', 0, 0, 0, NULL, '115.60.20.169'),
(286, '18639900902', 30, 0, 1, '37279052', NULL, NULL, '2017-01-12 20:58:48', 0, 0, 0, NULL, '115.60.20.169'),
(287, '18639900902', 30, 0, 1, '75448303', NULL, NULL, '2017-01-12 21:01:48', 0, 1, 1, '', '115.60.20.169'),
(288, '13935483149', 30, 0, 1, '24727172', NULL, NULL, '2017-01-12 21:04:07', 0, 1, 1, '', '113.25.12.122'),
(289, '15336157070', 200, 0, 1, '17923889', NULL, NULL, '2017-01-12 21:05:30', 0, 0, 0, NULL, '117.81.27.84'),
(290, '15336157070', 100, 0, 1, '93301086', NULL, NULL, '2017-01-12 21:08:20', 0, 1, 1, '', '117.81.27.84'),
(291, '15169861765', 30, 0, 1, '84704284', NULL, NULL, '2017-01-12 21:27:21', 0, 1, 1, '', '223.96.152.2'),
(292, '15925775208', 200, 0, 1, '18753356', NULL, NULL, '2017-01-12 21:28:45', 0, 0, 0, NULL, '117.148.214.85'),
(293, '15925775208', 200, 0, 1, '71166381', NULL, NULL, '2017-01-12 21:30:37', 0, 0, 0, NULL, '116.231.92.105'),
(294, '15925775208', 200, 0, 1, '10887145', NULL, NULL, '2017-01-12 21:35:55', 0, 0, 0, NULL, '116.231.92.105'),
(295, '18709239066', 30, 0, 1, '24556884', NULL, NULL, '2017-01-12 21:37:14', 0, 0, 0, NULL, '122.224.33.101'),
(296, '18791463875', 30, 0, 1, '15413513', NULL, NULL, '2017-01-12 21:38:05', 0, 1, 1, '', '1.81.207.212'),
(297, '15275808774', 30, 0, 1, '96209716', NULL, NULL, '2017-01-12 21:38:16', 0, 0, 0, NULL, '112.37.115.27'),
(298, '15925775208', 200, 0, 1, '74948425', NULL, NULL, '2017-01-12 21:40:41', 0, 0, 0, NULL, '117.148.214.85'),
(299, '15925775208', 200, 0, 1, '61833496', NULL, NULL, '2017-01-12 21:42:03', 0, 1, 1, '', '39.155.186.181'),
(300, '18647938730', 200, 0, 1, '58457946', NULL, NULL, '2017-01-12 21:56:39', 0, 1, 1, '', '116.114.23.42'),
(301, '18859562578', 30, 0, 1, '54524841', NULL, NULL, '2017-01-12 22:08:32', 0, 0, 0, NULL, '36.249.25.197'),
(302, '13025997478', 200, 0, 1, '86522521', NULL, NULL, '2017-01-12 22:09:25', 0, 1, 1, '', '121.31.250.179'),
(303, '18335481386', 100, 0, 1, '82479553', NULL, NULL, '2017-01-12 22:12:59', 0, 1, 1, '', '60.223.128.3'),
(304, '18859562578', 2000, 0, 1, '59877929', NULL, NULL, '2017-01-12 22:25:11', 0, 0, 0, NULL, '36.249.25.197'),
(305, '18859562578', 2000, 0, 1, '13100891', NULL, NULL, '2017-01-12 22:25:33', 0, 0, 0, NULL, '36.249.25.197'),
(306, '15229623991', 30, 0, 1, '38017883', NULL, NULL, '2017-01-12 22:37:48', 0, 0, 0, NULL, '111.19.75.230'),
(307, '13228972897', 100, 0, 1, '34290771', NULL, NULL, '2017-01-12 23:19:08', 0, 1, 1, '', '124.31.255.101'),
(308, '13228972897', 30, 0, 1, '45807189', NULL, NULL, '2017-01-12 23:27:00', 0, 1, 1, '', '124.31.255.101'),
(309, '18331317066', 100, 0, 1, '97247924', NULL, NULL, '2017-01-12 23:31:30', 0, 0, 0, NULL, '124.239.26.140'),
(310, '18331317066', 100, 0, 1, '61514892', NULL, NULL, '2017-01-12 23:33:33', 0, 0, 0, NULL, '124.239.26.140'),
(311, '18091302383', 100, 0, 1, '67595825', NULL, NULL, '2017-01-12 23:35:40', 0, 0, 0, NULL, '117.81.27.84'),
(312, '15841682010', 30, 0, 1, '34787902', NULL, NULL, '2017-01-12 23:44:39', 0, 0, 0, NULL, '123.245.247.125'),
(313, '13141084000', 2000, 0, 1, '10631713', NULL, NULL, '2017-01-12 23:45:04', 0, 0, 0, NULL, '171.213.197.0'),
(314, '15841682010', 100, 0, 1, '33153686', NULL, NULL, '2017-01-12 23:46:01', 0, 0, 0, NULL, '123.245.247.125'),
(315, '15841682010', 100, 0, 1, '33711242', NULL, NULL, '2017-01-12 23:52:53', 0, 0, 0, NULL, '123.245.247.125'),
(316, '15841682010', 30, 0, 1, '93106079', NULL, NULL, '2017-01-12 23:55:01', 0, 0, 0, NULL, '123.245.247.125'),
(317, '18580512158', 2000, 0, 1, '29975891', NULL, NULL, '2017-01-13 00:10:16', 0, 0, 0, NULL, '106.80.196.23'),
(318, '18859562578', 30, 0, 1, '42692565', NULL, NULL, '2017-01-13 00:11:14', 0, 0, 0, NULL, '36.249.25.197'),
(319, '13025157006', 1000, 0, 1, '16256713', NULL, NULL, '2017-01-13 00:11:20', 0, 0, 0, NULL, '183.19.182.148'),
(320, '13025157006', 2000, 0, 1, '14636230', NULL, NULL, '2017-01-13 00:15:06', 0, 1, 1, '', '183.19.182.148'),
(321, '13025157006', 30, 0, 1, '80188903', NULL, NULL, '2017-01-13 00:20:42', 0, 0, 0, NULL, '183.19.182.148'),
(322, '15302515345', 2000, 0, 1, '12672424', NULL, NULL, '2017-01-13 00:29:06', 0, 0, 0, NULL, '183.43.199.41'),
(323, '15302515345', 2000, 0, 1, '66214294', NULL, NULL, '2017-01-13 00:31:52', 0, 1, 1, '', '183.43.199.41'),
(324, '18953022892', 30, 0, 1, '43107299', NULL, NULL, '2017-01-13 00:37:42', 0, 0, 0, NULL, '182.44.112.188'),
(325, '18953022892', 30, 0, 1, '80979919', NULL, NULL, '2017-01-13 00:38:37', 0, 0, 0, NULL, '182.44.112.188'),
(326, '18953022892', 30, 0, 1, '68801574', NULL, NULL, '2017-01-13 00:39:32', 0, 1, 1, '', '182.44.112.188'),
(327, '13631167112', 30, 0, 1, '89818420', NULL, NULL, '2017-01-13 02:57:38', 0, 0, 0, NULL, '113.64.200.146'),
(328, '18339580938', 30, 0, 1, '79263305', NULL, NULL, '2017-01-13 07:01:20', 0, 0, 0, NULL, '39.155.184.46'),
(329, '18720791980', 30, 0, 1, '52030944', NULL, NULL, '2017-01-13 07:50:17', 0, 0, 0, NULL, '182.105.40.100'),
(330, '13602542469', 100, 0, 1, '54469909', NULL, NULL, '2017-01-13 07:53:58', 0, 0, 0, NULL, '219.135.217.63'),
(331, '13602542469', 100, 0, 1, '59185791', NULL, NULL, '2017-01-13 07:54:37', 0, 0, 0, NULL, '219.135.217.63'),
(332, '15336157070', 100, 0, 1, '71853027', NULL, NULL, '2017-01-13 08:23:14', 0, 0, 0, NULL, '113.105.154.126'),
(333, '15768081134', 30, 0, 1, '91892089', NULL, NULL, '2017-01-13 08:47:26', 0, 0, 0, NULL, '113.103.213.0'),
(334, '15923119600', 30, 0, 1, '40423889', NULL, NULL, '2017-01-13 09:15:21', 0, 0, 0, NULL, '221.7.96.84'),
(335, '15056407939', 100, 0, 1, '27017822', NULL, NULL, '2017-01-13 09:20:19', 0, 1, 1, '', '112.26.74.132'),
(336, '18647938730', 100, 0, 1, '34329223', NULL, NULL, '2017-01-13 09:23:51', 0, 0, 0, NULL, '1.180.239.226'),
(337, '15397232996', 30, 0, 1, '96459655', NULL, NULL, '2017-01-13 09:26:57', 0, 0, 0, NULL, '223.104.17.240'),
(338, '15397232996', 30, 0, 1, '71729431', NULL, NULL, '2017-01-13 09:27:53', 0, 0, 0, NULL, '223.104.17.240'),
(339, '13213575316', 200, 0, 1, '29794616', NULL, NULL, '2017-01-13 09:36:44', 0, 0, 0, NULL, '219.157.42.64'),
(340, '18647938730', 100, 0, 1, '19066467', NULL, NULL, '2017-01-13 09:37:21', 0, 0, 0, NULL, '1.31.174.86'),
(341, '13213575316', 200, 0, 1, '37344970', NULL, NULL, '2017-01-13 09:38:15', 0, 0, 0, NULL, '219.157.42.64'),
(342, '13213575316', 200, 0, 1, '91370239', NULL, NULL, '2017-01-13 09:39:22', 0, 0, 0, NULL, '219.157.42.64'),
(343, '13085822223', 100, 0, 1, '77261047', NULL, NULL, '2017-01-13 09:43:13', 0, 1, 1, '', '116.31.63.33'),
(344, '15715277053', 100, 0, 1, '24966125', NULL, NULL, '2017-01-13 09:44:06', 0, 1, 1, '', '113.57.246.173'),
(345, '18709239066', 30, 0, 1, '83954467', NULL, NULL, '2017-01-13 09:53:46', 0, 0, 0, NULL, '223.104.11.102'),
(346, '15367341013', 100, 0, 1, '88725280', NULL, NULL, '2017-01-13 10:38:37', 0, 1, 1, '', '120.84.196.59'),
(347, '18098019210', 400, 0, 1, '31368408', NULL, NULL, '2017-01-13 10:43:04', 0, 0, 0, NULL, '1.82.102.183'),
(348, '15367341013', 30, 0, 1, '78137207', NULL, NULL, '2017-01-13 10:43:50', 0, 0, 0, NULL, '120.84.196.59'),
(349, '13111110841', 30, 0, 1, '92699584', NULL, NULL, '2017-01-13 10:52:53', 0, 1, 1, '', '60.221.132.158'),
(350, '13213575316', 200, 0, 1, '20714416', NULL, NULL, '2017-01-13 11:33:14', 0, 0, 0, NULL, '219.157.42.64'),
(351, '13213575316', 200, 0, 1, '24927673', NULL, NULL, '2017-01-13 11:34:11', 0, 0, 0, NULL, '219.157.42.64'),
(352, '13213575316', 200, 0, 1, '99439697', NULL, NULL, '2017-01-13 11:34:24', 0, 1, 1, '', '219.157.42.64'),
(353, '15275808774', 30, 0, 1, '60732116', NULL, NULL, '2017-01-13 11:57:37', 0, 0, 0, NULL, '39.90.39.151'),
(354, '13729011789', 100, 0, 1, '48908081', NULL, NULL, '2017-01-13 11:59:23', 0, 0, 0, NULL, '202.109.166.220'),
(355, '13947090753', 30, 0, 1, '46804199', NULL, NULL, '2017-01-13 12:00:10', 0, 0, 0, NULL, '106.40.113.138'),
(356, '13947090753', 30, 0, 1, '45477600', NULL, NULL, '2017-01-13 12:00:33', 0, 0, 0, NULL, '106.40.113.138'),
(357, '13947090753', 30, 0, 1, '29931945', NULL, NULL, '2017-01-13 12:01:08', 0, 0, 0, NULL, '106.40.113.138'),
(358, '13947090753', 30, 0, 1, '22233276', NULL, NULL, '2017-01-13 12:02:19', 0, 0, 0, NULL, '106.40.113.138'),
(359, '13947090753', 30, 0, 1, '13378295', NULL, NULL, '2017-01-13 12:03:01', 0, 0, 0, NULL, '106.40.113.138'),
(360, '13729011789', 100, 0, 1, '77582397', NULL, NULL, '2017-01-13 12:03:10', 0, 0, 0, NULL, '111.148.4.157'),
(361, '13015578891', 400, 0, 1, '62613525', NULL, NULL, '2017-01-13 12:03:50', 0, 1, 1, '', '112.12.49.188'),
(362, '13947090753', 30, 0, 1, '74802856', NULL, NULL, '2017-01-13 12:08:04', 0, 0, 0, NULL, '106.40.113.138'),
(363, '18091302383', 100, 0, 1, '96275634', NULL, NULL, '2017-01-13 12:09:32', 0, 1, 1, '', '113.79.14.62'),
(364, '13423500324', 2000, 0, 1, '70759887', NULL, NULL, '2017-01-13 12:12:57', 0, 0, 0, NULL, '113.64.200.146'),
(365, '13423500324', 2000, 0, 1, '10716857', NULL, NULL, '2017-01-13 12:13:32', 0, 0, 0, NULL, '113.64.200.146'),
(366, '13423500324', 2000, 0, 1, '36262817', NULL, NULL, '2017-01-13 12:13:35', 0, 0, 0, NULL, '113.64.200.146'),
(367, '13423500324', 2000, 0, 1, '84978942', NULL, NULL, '2017-01-13 12:14:16', 0, 0, 0, NULL, '113.64.200.146'),
(368, '13423500324', 2000, 0, 1, '56142578', NULL, NULL, '2017-01-13 12:14:35', 0, 0, 0, NULL, '113.64.200.146'),
(369, '13947090753', 30, 0, 1, '12389526', NULL, NULL, '2017-01-13 12:16:07', 0, 0, 0, NULL, '106.40.113.138'),
(370, '13729011789', 100, 0, 1, '12491149', NULL, NULL, '2017-01-13 12:17:01', 0, 1, 1, '', '111.73.157.234'),
(371, '13947090753', 30, 0, 1, '48427429', NULL, NULL, '2017-01-13 12:17:20', 0, 0, 0, NULL, '106.40.113.138'),
(372, '13994576395', 200, 0, 1, '68760375', NULL, NULL, '2017-01-13 12:28:25', 0, 1, 1, '', '60.223.128.3'),
(373, '17795315637', 100, 0, 1, '96396484', NULL, NULL, '2017-01-13 12:43:38', 0, 1, 1, '', '1.50.96.169'),
(374, '13669755202', 30, 0, 1, '34532470', NULL, NULL, '2017-01-13 12:48:55', 0, 1, 1, '', '220.163.52.138'),
(375, '13423500324', 2000, 0, 1, '46293334', NULL, NULL, '2017-01-13 12:49:40', 0, 1, 1, '', '113.64.200.146'),
(376, '18859562578', 200, 0, 1, '24771118', NULL, NULL, '2017-01-13 12:55:35', 0, 1, 1, '', '117.136.11.171'),
(377, '13642473229', 400, 0, 1, '64901428', NULL, NULL, '2017-01-13 13:19:37', 0, 1, 1, '', '117.136.11.171'),
(378, '13658971986', 100, 0, 1, '12024230', NULL, NULL, '2017-01-13 13:38:10', 0, 1, 1, '', '27.98.255.222'),
(379, '18647938730', 200, 0, 1, '53115844', NULL, NULL, '2017-01-13 13:52:06', 0, 0, 0, NULL, '116.114.23.42'),
(380, '18968312398', 30, 0, 1, '22038269', NULL, NULL, '2017-01-13 13:57:14', 0, 0, 0, NULL, '36.23.52.73'),
(381, '15529987748', 30, 0, 1, '11299133', NULL, NULL, '2017-01-13 14:00:09', 0, 1, 1, '', '221.11.61.252'),
(382, '18953022892', 200, 0, 1, '29734191', NULL, NULL, '2017-01-13 14:11:10', 0, 1, 1, '', '117.136.37.24'),
(383, '13423500324', 1000, 0, 1, '23927917', NULL, NULL, '2017-01-13 14:17:07', 0, 1, 1, '', '113.64.200.146'),
(384, '13947940458', 400, 0, 1, '50023193', NULL, NULL, '2017-01-13 14:17:44', 0, 1, 1, '', '1.31.174.84'),
(385, '13532583258', 30, 0, 1, '93622436', NULL, NULL, '2017-01-13 14:26:08', 0, 0, 0, NULL, '26.56.4.153, 129.232.108.76, 215.234.21'),
(386, '18968312398', 30, 0, 1, '83547973', NULL, NULL, '2017-01-13 14:26:16', 0, 1, 1, '', '36.23.52.73'),
(387, '13892213753', 30, 0, 1, '88195190', NULL, NULL, '2017-01-13 14:30:55', 0, 0, 0, NULL, '117.136.50.222'),
(388, '18859562578', 2000, 0, 1, '77423095', NULL, NULL, '2017-01-13 14:31:05', 0, 1, 1, '', '36.249.25.197'),
(389, '18647938730', 200, 0, 1, '68636779', NULL, NULL, '2017-01-13 14:37:11', 0, 1, 1, '', '1.31.174.84'),
(390, '13574448928', 400, 0, 1, '28934936', NULL, NULL, '2017-01-13 14:41:57', 0, 0, 0, NULL, '223.104.131.70'),
(391, '13152169183', 30, 0, 1, '94534301', NULL, NULL, '2017-01-13 14:44:39', 0, 1, 1, '', '113.200.106.38'),
(392, '18331317066', 100, 0, 1, '83391418', NULL, NULL, '2017-01-13 14:49:10', 0, 0, 0, NULL, '223.104.13.252'),
(393, '18331317066', 30, 0, 1, '88760986', NULL, NULL, '2017-01-13 14:50:50', 0, 0, 0, NULL, '223.104.13.252'),
(394, '13994210338', 200, 0, 1, '60053710', NULL, NULL, '2017-01-13 14:52:30', 0, 0, 0, NULL, '221.205.57.119'),
(395, '13892213753', 30, 0, 1, '61979064', NULL, NULL, '2017-01-13 14:55:49', 0, 0, 0, NULL, '117.136.50.222'),
(396, '18676166934', 1000, 0, 1, '16904907', NULL, NULL, '2017-01-13 15:32:07', 0, 1, 1, '', '183.19.182.148'),
(397, '13574448928', 1000, 0, 1, '26460266', NULL, NULL, '2017-01-13 15:37:15', 0, 0, 0, NULL, '223.104.131.70'),
(398, '13574448928', 2000, 0, 1, '53569030', NULL, NULL, '2017-01-13 15:37:59', 0, 0, 0, NULL, '223.104.131.70'),
(399, '13574448928', 2000, 0, 1, '36669311', NULL, NULL, '2017-01-13 15:38:34', 0, 1, 1, '', '223.104.131.70'),
(400, '13892213753', 30, 0, 1, '28915710', NULL, NULL, '2017-01-13 15:39:22', 0, 1, 1, '', '117.136.50.222'),
(401, '15059744946', 100, 0, 1, '62292175', NULL, NULL, '2017-01-13 15:46:36', 0, 0, 0, NULL, '117.136.60.131'),
(402, '18286411712', 100, 0, 1, '57257690', NULL, NULL, '2017-01-13 15:51:11', 0, 0, 0, NULL, '223.104.94.31'),
(403, '13969958970', 100, 0, 1, '42365722', NULL, NULL, '2017-01-13 16:04:40', 0, 0, 0, NULL, '223.104.185.136'),
(404, '13015578891', 200, 0, 1, '39468078', NULL, NULL, '2017-01-13 16:10:06', 0, 1, 1, '', '112.12.49.188'),
(405, '13589312877', 30, 0, 1, '70424804', NULL, NULL, '2017-01-13 16:24:54', 0, 0, 0, NULL, '59.61.197.37'),
(406, '13583116805', 100, 0, 1, '39328002', NULL, NULL, '2017-01-13 16:41:05', 0, 0, 0, NULL, '117.136.94.176'),
(407, '13642473229', 30, 0, 1, '97838439', NULL, NULL, '2017-01-13 16:46:23', 0, 0, 0, NULL, '183.9.147.89'),
(408, '13407972672', 30, 0, 1, '95031433', NULL, NULL, '2017-01-13 16:47:02', 0, 0, 0, NULL, '61.180.77.186'),
(409, '13675387591', 200, 0, 1, '39959716', NULL, NULL, '2017-01-13 16:50:23', 0, 1, 1, '', '111.17.52.178'),
(410, '15009900680', 30, 0, 1, '52324829', NULL, NULL, '2017-01-13 16:56:28', 0, 0, 0, NULL, '222.81.176.85'),
(411, '15009900680', 100, 0, 1, '19500427', NULL, NULL, '2017-01-13 16:57:00', 0, 1, 1, '', '222.81.176.85'),
(412, '13407972672', 30, 0, 1, '63725891', NULL, NULL, '2017-01-13 16:57:02', 0, 0, 0, NULL, '61.180.77.186'),
(413, '13407972672', 30, 0, 1, '85448608', NULL, NULL, '2017-01-13 17:01:46', 0, 0, 0, NULL, '61.180.77.186'),
(414, '15275808774', 2000, 0, 1, '72116699', NULL, NULL, '2017-01-13 17:13:50', 0, 1, 1, '', '39.90.39.151'),
(415, '15275808774', 1000, 0, 1, '66714172', NULL, NULL, '2017-01-13 17:15:41', 0, 1, 1, '', '39.90.39.151'),
(416, '13015578891', 200, 0, 1, '77543945', NULL, NULL, '2017-01-13 17:18:42', 0, 0, 0, NULL, '112.12.49.188'),
(417, '13729761505', 100, 0, 1, '60240478', NULL, NULL, '2017-01-13 17:19:51', 0, 0, 0, NULL, '202.109.166.221'),
(418, '13729761505', 100, 0, 1, '30876770', NULL, NULL, '2017-01-13 17:20:28', 0, 0, 0, NULL, '111.148.4.121'),
(419, '13220968480', 2000, 0, 1, '52495117', NULL, NULL, '2017-01-13 17:25:08', 0, 1, 1, '', '39.90.39.151'),
(420, '13220968480', 100, 0, 1, '21670227', NULL, NULL, '2017-01-13 17:26:14', 0, 1, 1, '', '39.90.39.151'),
(421, '18966999170', 100, 0, 1, '72031555', NULL, NULL, '2017-01-13 17:29:17', 0, 0, 0, NULL, '1.81.95.37'),
(422, '13209129908', 100, 0, 1, '89310302', NULL, NULL, '2017-01-13 17:30:44', 0, 0, 0, NULL, '113.200.106.124'),
(423, '18966999170', 100, 0, 1, '31439819', NULL, NULL, '2017-01-13 17:31:09', 0, 1, 1, '', '1.81.95.37'),
(424, '13209129908', 100, 0, 1, '21159362', NULL, NULL, '2017-01-13 17:31:43', 0, 1, 1, '', '113.200.106.124'),
(425, '14729907969', 100, 0, 1, '44510803', NULL, NULL, '2017-01-13 17:34:45', 0, 1, 1, '', '223.104.11.180'),
(426, '13729761505', 400, 0, 1, '81990661', NULL, NULL, '2017-01-13 18:00:03', 0, 0, 0, NULL, '113.105.163.212'),
(427, '18782310371', 400, 0, 1, '93416442', NULL, NULL, '2017-01-13 18:09:29', 0, 1, 1, '', '171.222.83.106'),
(428, '18292238116', 30, 0, 1, '42662353', NULL, NULL, '2017-01-13 18:10:08', 0, 1, 1, '', '117.136.25.204'),
(429, '15169865602', 30, 0, 1, '25224304', NULL, NULL, '2017-01-13 18:10:13', 0, 0, 0, NULL, '123.135.42.6'),
(430, '15169865602', 30, 0, 1, '64352111', NULL, NULL, '2017-01-13 18:12:19', 0, 1, 1, '', '123.135.42.6'),
(431, '13277487141', 1000, 0, 1, '85574951', NULL, NULL, '2017-01-13 18:16:02', 0, 1, 1, '', '113.57.182.249'),
(432, '13025157006', 30, 0, 1, '94635925', NULL, NULL, '2017-01-13 18:21:48', 0, 0, 0, NULL, '183.19.182.148'),
(433, '18292238116', 30, 0, 1, '17171325', NULL, NULL, '2017-01-13 18:28:16', 0, 0, 0, NULL, '117.136.25.204'),
(434, '13502081660', 30, 0, 1, '11634216', NULL, NULL, '2017-01-13 18:29:27', 0, 0, 0, NULL, '117.11.133.131'),
(435, '13835068888', 30, 0, 1, '94067382', NULL, NULL, '2017-01-13 18:45:41', 0, 0, 0, NULL, '182.244.33.123'),
(436, '15367652980', 30, 0, 1, '44032897', NULL, NULL, '2017-01-13 18:48:50', 0, 0, 0, NULL, '218.76.204.21'),
(437, '15367652980', 30, 0, 1, '76590881', NULL, NULL, '2017-01-13 19:09:24', 0, 0, 0, NULL, '218.76.204.21'),
(438, '13835068888', 30, 0, 1, '76898498', NULL, NULL, '2017-01-13 19:18:52', 0, 0, 0, NULL, '182.244.33.123'),
(439, '15267049315', 30, 0, 1, '14273681', NULL, NULL, '2017-01-13 19:27:47', 0, 0, 0, NULL, '101.71.37.34'),
(440, '18331317066', 100, 0, 1, '26770629', NULL, NULL, '2017-01-13 20:13:39', 0, 1, 1, '', '106.118.137.179'),
(441, '15908980292', 30, 0, 1, '98255920', NULL, NULL, '2017-01-13 20:40:14', 0, 0, 0, NULL, '119.166.177.54'),
(442, '15800651956', 400, 0, 1, '27558898', NULL, NULL, '2017-01-13 21:45:24', 0, 1, 1, '', '117.140.149.71'),
(443, '18701358932', 30, 0, 1, '96489868', NULL, NULL, '2017-01-13 22:45:19', 0, 0, 0, NULL, '111.192.113.249'),
(444, '18173413882', 30, 0, 1, '80974426', NULL, NULL, '2017-01-13 22:48:06', 0, 1, 1, '', '223.146.36.23'),
(445, '18701358932', 30, 0, 1, '12807006', NULL, NULL, '2017-01-13 22:51:00', 0, 0, 0, NULL, '111.192.113.249'),
(446, '13934824952', 30, 0, 1, '62341613', NULL, NULL, '2017-01-13 22:53:31', 0, 1, 1, '', '117.61.130.220'),
(447, '15296580983', 30, 0, 1, '90452880', NULL, NULL, '2017-01-13 23:01:49', 0, 0, 0, NULL, '58.59.196.222'),
(448, '13527964725', 30, 0, 1, '86648864', NULL, NULL, '2017-01-13 23:04:37', 0, 0, 0, NULL, '116.18.165.1'),
(449, '15296580983', 30, 0, 1, '58095397', NULL, NULL, '2017-01-13 23:06:15', 0, 0, 0, NULL, '58.59.196.222'),
(450, '13527964725', 30, 0, 1, '88480834', NULL, NULL, '2017-01-13 23:07:33', 0, 0, 0, NULL, '116.18.165.1'),
(451, '18286411712', 30, 0, 1, '64044494', NULL, NULL, '2017-01-13 23:35:11', 0, 0, 0, NULL, '223.104.24.7'),
(452, '18286411712', 100, 0, 1, '27630310', NULL, NULL, '2017-01-13 23:36:26', 0, 0, 0, NULL, '223.104.24.7'),
(453, '13088058699', 100, 0, 1, '15927124', NULL, NULL, '2017-01-13 23:39:16', 0, 0, 0, NULL, '117.150.110.17'),
(454, '15367652980', 30, 0, 1, '21068725', NULL, NULL, '2017-01-14 00:06:10', 0, 0, 0, NULL, '218.76.223.68'),
(455, '13658971986', 200, 0, 1, '74764404', NULL, NULL, '2017-01-14 01:01:02', 0, 0, 0, NULL, '124.31.255.101'),
(456, '13658971986', 200, 0, 1, '88851623', NULL, NULL, '2017-01-14 01:02:24', 0, 0, 0, NULL, '27.98.252.233'),
(457, '13658971986', 30, 0, 1, '23150634', NULL, NULL, '2017-01-14 01:13:43', 0, 0, 0, NULL, '27.98.252.236'),
(458, '18358863086', 30, 0, 1, '69773864', NULL, NULL, '2017-01-14 02:11:28', 0, 0, 0, NULL, '112.17.247.112'),
(459, '13835068888', 30, 0, 1, '77247314', NULL, NULL, '2017-01-14 02:41:18', 0, 0, 0, NULL, '182.244.35.224'),
(460, '18085331023', 30, 0, 1, '63039245', NULL, NULL, '2017-01-14 02:54:44', 0, 0, 0, NULL, '58.16.180.111'),
(461, '13835068888', 30, 0, 1, '88576965', NULL, NULL, '2017-01-14 02:56:29', 0, 0, 0, NULL, '182.244.35.224'),
(462, '13001528073', 30, 0, 1, '39869079', NULL, NULL, '2017-01-14 03:00:02', 0, 0, 0, NULL, '112.224.2.152'),
(463, '13373803123', 30, 0, 1, '35537719', NULL, NULL, '2017-01-14 06:44:14', 0, 0, 0, NULL, '121.32.251.75'),
(464, '13355561690', 30, 0, 1, '30621337', NULL, NULL, '2017-01-14 07:47:13', 0, 0, 0, NULL, '36.63.106.102'),
(465, '13934867877', 2000, 0, 1, '84421386', NULL, NULL, '2017-01-14 07:47:36', 0, 0, 0, NULL, '60.222.59.165'),
(466, '13355561690', 30, 0, 1, '40824890', NULL, NULL, '2017-01-14 07:48:15', 0, 0, 0, NULL, '36.63.106.102'),
(467, '13355561690', 30, 0, 1, '75225830', NULL, NULL, '2017-01-14 07:49:42', 0, 0, 0, NULL, '36.63.106.102'),
(468, '13994218879', 30, 0, 1, '43145751', NULL, NULL, '2017-01-14 08:02:20', 0, 0, 0, NULL, '10.80.22.16'),
(469, '13994218879', 30, 0, 1, '51168518', NULL, NULL, '2017-01-14 08:02:38', 0, 0, 0, NULL, '10.80.22.16'),
(470, '13994218879', 30, 0, 1, '39091796', NULL, NULL, '2017-01-14 08:23:14', 0, 0, 0, NULL, '10.80.22.16'),
(471, '13979777007', 30, 0, 1, '80790405', NULL, NULL, '2017-01-14 08:47:32', 0, 0, 0, NULL, '182.105.40.100'),
(472, '13181708917', 30, 0, 1, '51635437', NULL, NULL, '2017-01-14 10:35:42', 0, 0, 0, NULL, '39.82.145.201'),
(473, '15560201897', 30, 0, 1, '38575439', NULL, NULL, '2017-01-14 11:07:29', 0, 0, 0, NULL, '183.204.101.184'),
(474, '13505772714', 400, 0, 1, '11546325', NULL, NULL, '2017-01-14 11:31:40', 0, 0, 0, NULL, '60.181.43.126'),
(475, '13505772714', 30, 0, 1, '91342773', NULL, NULL, '2017-01-14 11:32:34', 0, 0, 0, NULL, '60.181.43.126'),
(476, '13505772714', 400, 0, 1, '73588867', NULL, NULL, '2017-01-14 11:33:00', 0, 0, 0, NULL, '60.181.43.126'),
(477, '13135388911', 30, 0, 1, '99442443', NULL, NULL, '2017-01-14 11:38:51', 0, 0, 0, NULL, '220.202.152.63'),
(478, '13480356794', 100, 0, 1, '63393554', NULL, NULL, '2017-01-14 12:36:03', 0, 0, 0, NULL, '122.13.241.73'),
(479, '13480356794', 100, 0, 1, '87868347', NULL, NULL, '2017-01-14 12:37:25', 0, 0, 0, NULL, '122.13.241.73'),
(480, '18602858132', 30, 0, 1, '26163635', NULL, NULL, '2017-01-14 13:03:32', 0, 0, 0, NULL, '117.139.252.157'),
(481, '18602858132', 30, 0, 1, '60888671', NULL, NULL, '2017-01-14 13:09:54', 0, 0, 0, NULL, '113.140.51.5'),
(482, '18602858132', 30, 0, 1, '55771789', NULL, NULL, '2017-01-14 13:10:06', 0, 0, 0, NULL, '113.140.51.5'),
(483, '13135388911', 30, 0, 1, '11400756', NULL, NULL, '2017-01-14 13:47:54', 0, 0, 0, NULL, '220.202.153.30'),
(484, '13135388911', 30, 0, 1, '95696105', NULL, NULL, '2017-01-14 13:52:47', 0, 1, 1, '', '220.202.153.30'),
(485, '15577995575', 100, 0, 1, '15410766', NULL, NULL, '2017-01-14 14:01:02', 0, 1, 1, '', '223.104.90.30'),
(486, '18602858132', 30, 0, 1, '45326538', NULL, NULL, '2017-01-14 14:20:10', 0, 0, 0, NULL, '113.140.51.5'),
(487, '15859723796', 30, 0, 1, '10381774', NULL, NULL, '2017-01-14 17:11:30', 0, 1, 1, '', '120.37.159.212'),
(488, '15859723796', 30, 0, 1, '55480651', NULL, NULL, '2017-01-14 17:14:54', 0, 1, 1, '', '120.37.159.212'),
(489, '15859723796', 30, 0, 1, '40061340', NULL, NULL, '2017-01-14 17:19:09', 0, 0, 0, NULL, '120.37.159.212'),
(490, '13480356794', 30, 0, 1, '50649414', NULL, NULL, '2017-01-14 18:22:35', 0, 0, 0, NULL, '122.13.241.73'),
(491, '18847907335', 200, 0, 1, '27622070', NULL, NULL, '2017-01-14 18:34:10', 0, 0, 0, NULL, '110.17.170.47'),
(492, '18847907335', 200, 0, 1, '48825683', NULL, NULL, '2017-01-14 18:35:02', 0, 0, 0, NULL, '110.17.170.47'),
(493, '18847907335', 100, 0, 1, '65206298', NULL, NULL, '2017-01-14 18:38:19', 0, 1, 1, '', '110.17.170.47'),
(494, '13947396775', 200, 0, 1, '63786315', NULL, NULL, '2017-01-14 19:01:01', 0, 0, 0, NULL, '183.198.31.239'),
(495, '13947396775', 200, 0, 1, '16613769', NULL, NULL, '2017-01-14 19:02:54', 0, 1, 1, '', '183.198.31.239'),
(496, '18847986178', 200, 0, 1, '53302612', NULL, NULL, '2017-01-14 19:09:21', 0, 0, 1, '', '223.104.2.155');

-- --------------------------------------------------------

--
-- 表的结构 `h_withdraw`
--

CREATE TABLE IF NOT EXISTS `h_withdraw` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_log_login_member`
--

CREATE TABLE IF NOT EXISTS `t_log_login_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_userName` char(20) DEFAULT NULL,
  `h_ip` char(39) DEFAULT NULL,
  `h_addTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `t_log_login_member`
--

INSERT INTO `t_log_login_member` (`id`, `h_userName`, `h_ip`, `h_addTime`) VALUES
(1, '15566778899', '175.44.166.130', '2017-05-22 14:50:13'),
(2, '15566778899', '175.44.166.130', '2017-05-22 14:55:04'),
(3, '15126359833', '182.246.15.96', '2017-05-22 22:26:50'),
(4, '15126359833', '14.111.61.90', '2017-05-22 22:31:12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
