DROP TABLE IF EXISTS `h_api_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_api_member` (
  `api_key` varchar(128) NOT NULL,
  `api_secret` varchar(256) NOT NULL,
  `active` int(4) DEFAULT '1' COMMENT '是否激活',
  `default_cnyf_address` varchar(128) DEFAULT NULL,
  `h_lastUpdatedAt` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `h_createdAt` datetime DEFAULT NULL,
  `name` varchar(128) NOT NULL DEFAULT '""' COMMENT '外部应用的名字',
  PRIMARY KEY (`api_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

