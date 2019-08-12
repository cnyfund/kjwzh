ALTER TABLE h_config ADD COLUMN h_prod_notify_hostname varchar(256) NULL COMMENT '正式应用系统的异步通知网站的hostname';
ALTER TABLE h_config ADD COLUMN h_test_notify_hostname varchar(256) NULL COMMENT '测试系统的异步通知网站的hostname';
ALTER TABLE h_config ADD COLUMN h_prod_tradeex_hostname varchar(256) NULL COMMENT '场外交易系统的网站的hostname';
ALTER TABLE h_config ADD COLUMN h_test_tradeex_hostname varchar(256) NULL COMMENT '场外交易系统的测试网站的hostname';
ALTER TABLE h_config ADD COLUMN h_tradeex_api_key varchar(256) NULL COMMENT '场外交易系统的API KEY';
ALTER TABLE h_config ADD COLUMN h_tradeex_api_secret varchar(256) NULL COMMENT '场外交易系统的API SECRET';
ALTER TABLE h_config ADD COLUMN h_proxy_api_key varchar(256) NULL COMMENT '支付网关系统的API KEY';
ALTER TABLE h_config ADD COLUMN h_proxy_api_secret varchar(256) NULL COMMENT '支付网关系统的API KEY';
ALTER TABLE h_config ADD COLUMN h_tradeex_cnyf_address varchar(256) NOT NULL COMMENT '用于把提现的金额转给场外交易的地址';
ALTER TABLE h_config ADD COLUMN h_purchase_limit int NOT NULL DEFAULT 3000 COMMENT '每次充值的上限';
ALTER TABLE h_config ADD COLUMN h_redeem_limit int NOT NULL DEFAULT 3000 COMMENT '每次提现的上限';
ALTER TABLE h_config ADD COLUMN h_transfer_cnyf_limit int NOT NULL DEFAULT 1000 COMMENT '每次转币上限';
ALTER TABLE h_config ADD COLUMN h_is_test_mode int NOT NULL DEFAULT 0 COMMENT '是否是测试阶段';






