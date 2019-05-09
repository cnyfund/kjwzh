ALTER TABLE h_member ADD COLUMN h_weixin_qrcode varchar(256) NULL COMMENT '微信收款二维码文件名';
ALTER TABLE h_member ADD COLUMN h_canRedeem int(11) DEFAULT '0' COMMENT '是否可以提现'

