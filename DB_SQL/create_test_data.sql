INSERT INTO `h_config` (`id`, `h_webName`, `h_webLogo`, `h_webLogoLogin`, `h_webKeyword`, `h_keyword`, `h_description`, `h_leftContact`, `h_counter`, `h_footer`, `h_rewriteOpen`, `h_point1Member`, `h_point1MemberPoint2`, `h_point2Quit`, `h_withdrawFee`, `h_withdrawMinCom`, `h_withdrawMinMoney`, `h_point2Lottery`, `h_lottery1`, `h_lottery2`, `h_lottery3`, `h_lottery4`, `h_lottery5`, `h_lottery6`, `h_point2Com1`, `h_point2Com2`, `h_point2Com3`, `h_point2Com4`, `h_point2Com5`, `h_point2Com6`, `h_point2Com7`, `h_point2Com8`, `h_point2Com9`, `h_point2Com10`, `h_levelUpTo0`, `h_levelUpTo1`, `h_levelUpTo2`, `h_levelUpTo3`, `h_levelUpTo4`, `h_levelUpTo5`, `h_levelUpTo6`, `h_levelUpTo7`, `h_levelUpTo8`, `h_levelUpTo9`, `h_levelUpTo10`, `h_serviceQQ`, `h_point2ComReg`, `h_point2ComRegAct`, `h_point2ComBuy`, `h_point3ComBuy`, `h_point4ComBuy`, `h_point5ComBuy`,`h_operationMode`) VALUES
(1, '充值网关', '/ui/images/logo.png2', '/ui/images/logo.png', '充值网关', '充值网关', '充值网关', '', '', '', 0, 0, 0, 0, '0.00', 0, 100, 10, 0, 0, 200, 500, 1500, 7000, '0.06', '0.03', '0.01', '0.01', '0.01', '0.00', '0.000', '0.000', '0.00', '0.00', 0, 111111, 111111, 111111, 111111, 0, 0, 0, 0, 0, 0, '恒远鑫达理财平台正式启航！', 1, 10, 6, 0, 0, 0,'PAYMENTPROXY');


insert into `h_api_member` (
  `api_key`,
  `api_secret`,
  `active`,
  `default_cnyf_address`,
  `name`
) values(
   'api_key_1234567',
   'api_secret_1234567',
   1,
   '',
   'testsite'   
)
