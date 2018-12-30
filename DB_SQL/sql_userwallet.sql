
DROP TABLE IF EXISTS `h_Wallet`;
CREATE TABLE `h_Wallet` (
  `h_crypto` varchar(8) NOT NULL,
  `h_ru` varchar(32) NOT NULL,
  `h_rp` varchar(256) NOT NULL,
  `h_port` int(11) DEFAULT 0 NOT NULL,
  `h_walletpassphrase` varchar(32) DEFAULT NULL,
  `h_lastUpdatedAt` datetime NOT NULL,
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
  `h_lastUpdatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (userId)
    REFERENCES h_member(id)
    ON DELETE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

insert into `h_Wallet` values ('CNYF', 'ru', 'rp', 18188, 'wp', now())

