
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for area
-- ----------------------------
CREATE TABLE `area` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Id` int(11) NOT NULL COMMENT '区域ID',
  `Lx` tinyint(4) NOT NULL COMMENT '区域类型：1-省/直辖市；2-地级市；3-县',
  `Mc` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '区域名称',
  `Bz` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `code_area_tid_id_mc_lx_index` (`tid`,`Id`,`Mc`,`Lx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
