
DROP TABLE IF EXISTS `h_Wallet`;
CREATE TABLE `h_Wallet` (
  `h_crypto` varchar(8) NOT NULL,
  `h_ru` varchar(32) NOT NULL,
  `h_rp` varchar(256) NOT NULL,
  `h_port` int(11) DEFAULT 0 NOT NULL,
  `h_walletpassphrase` varchar(32) DEFAULT NULL,
  `h_lastUpdatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`h_crypto`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `h_UserWallet`;
CREATE TABLE `h_UserWallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `h_crypto` varchar(8) NOT NULL,
  `h_address` varchar(64) NOT NULL,
  `h_balance` decimal(16,2) NOT NULL DEFAULT 0,
  `h_balance_locked` decimal(16,2) NOT NULL DEFAULT 0,
  `h_balance_available` decimal(16,2) NOT NULL DEFAULT 0,
  `h_lastUpdatedAt` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (userId)
    REFERENCES h_member(id)
    ON DELETE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `h_UserWalletExternal`;
CREATE TABLE `h_UserWalletExternal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `h_crypto` varchar(8) NOT NULL,
  `h_address` varchar(64) NOT NULL,
  `h_alias` varchar(32) DEFAULT '',
  `h_lastUpdatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (userId)
    REFERENCES h_member(id)
    ON DELETE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

update h_log_point2 set h_addTime = '2018-08-16 11:46:13' where id=11;
update h_recharge set h_addTime = '2018-08-16 11:46:13' where id=1;

ALTER TABLE h_member ADD UNIQUE (h_userName);
ALTER TABLE h_recharge ADD COLUMN h_refIdType VARCHAR(32) DEFAULT 'out_trade_no';
ALTER TABLE h_withdraw ADD COLUMN h_refIdType VARCHAR(32) DEFAULT 'out_trade_no';

ALTER TABLE h_member ADD COLUMN h_lastUpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
insert into `h_Wallet` values ('CNYF', 'ru', 'rp', 18189, 'wp', now());

/* DONT FORGET to GET RIGHT RPC USER PWD AND PORT FOR THE CNY DOCKER */