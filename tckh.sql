/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50621
Source Host           : 127.0.0.1:3306
Source Database       : tckh

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2015-10-16 14:26:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for web_config
-- ----------------------------
DROP TABLE IF EXISTS `web_config`;
CREATE TABLE `web_config` (
  `cfgname` varchar(50) NOT NULL,
  `cfgvalue` varchar(200) DEFAULT NULL,
  `modname` varchar(50) DEFAULT NULL,
  `descr` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cfgname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_config
-- ----------------------------
INSERT INTO `web_config` VALUES ('app.swftools.path', 'F:\\PHPWorkspaces\\swftools_libs', null, 'Thư viện SWFTools');
INSERT INTO `web_config` VALUES ('tapchikhoahoc.files_dir', 'F:\\PHPWorkspaces\\tapchikhoahoc_2014\\app\\storage\\tapchikhoahoc', 'tapchikhoahoc', 'Nơi lưu file upload');
INSERT INTO `web_config` VALUES ('tapchikhoahoc.quantam_paging_size', '10', 'tapchikhoahoc', null);
INSERT INTO `web_config` VALUES ('tapchikhoahoc.search_result_pagesize', '20', 'tapchikhoahoc', null);

-- ----------------------------
-- Table structure for web_sessions
-- ----------------------------
DROP TABLE IF EXISTS `web_sessions`;
CREATE TABLE `web_sessions` (
  `id` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`) USING BTREE,
  UNIQUE KEY `sessions$sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_sessions
-- ----------------------------
INSERT INTO `web_sessions` VALUES ('45407f577da30611ab1d42993e7224b39c44bfd4', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXBLN1BuZnpzRVZnNlRlQ2ZOaDFBQUhjaXFSY0pqdjNyeHR5UW45cCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTk0ODY3NTU7czoxOiJjIjtpOjE0MTk0ODY3NTU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1419486755');
INSERT INTO `web_sessions` VALUES ('50b549f4cf168ea675745a6e7a493722856b3614', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1pwSjUxbHBndHZRamtFaDFsOEM5d29oa2xjTUVsbVk3VDFpSEUzeCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0MTk5MjM1NDE7czoxOiJjIjtpOjE0MTk5MjM1NDE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1419923543');
INSERT INTO `web_sessions` VALUES ('56b4f0f2290d8b7adadbd7fb32940549374be4d2', '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', '1419411604');

-- ----------------------------
-- Table structure for web_tckh_sotapchi
-- ----------------------------
DROP TABLE IF EXISTS `web_tckh_sotapchi`;
CREATE TABLE `web_tckh_sotapchi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `so_text` varchar(50) DEFAULT NULL,
  `so_number` int(11) DEFAULT NULL,
  `nam` int(11) DEFAULT NULL,
  `diengiai` varchar(200) DEFAULT NULL,
  `ghichu` varchar(200) DEFAULT NULL,
  `viewerno` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_tckh_sotapchi
-- ----------------------------
INSERT INTO `web_tckh_sotapchi` VALUES ('3', 'Số 1', '1', '2005', null, '', '6');
INSERT INTO `web_tckh_sotapchi` VALUES ('4', 'Số 2', '2', '2005', null, '', null);
INSERT INTO `web_tckh_sotapchi` VALUES ('5', 'Số 3', '3', '2005', null, '', null);

-- ----------------------------
-- Table structure for web_tckh_tapchi
-- ----------------------------
DROP TABLE IF EXISTS `web_tckh_tapchi`;
CREATE TABLE `web_tckh_tapchi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsotapchi` int(11) DEFAULT NULL,
  `fgroupname` varchar(500) DEFAULT NULL,
  `fdesc` varchar(500) DEFAULT NULL,
  `updatetime` varchar(10) DEFAULT NULL,
  `authors` varchar(200) DEFAULT NULL,
  `viewerno` int(11) DEFAULT '0',
  `quantam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_tckh_tapchi
-- ----------------------------
INSERT INTO `web_tckh_tapchi` VALUES ('9', '3', '75 Năm lịch sử vẻ vang của Đảng cộng sản Việt Nam', 'Rèn luyện đạo đức cách mạng theo tư tưởng Hồ Chí Minh', null, '[\"Lê Bảo Lâm\"]', '1', null);
INSERT INTO `web_tckh_tapchi` VALUES ('10', '3', '75 Năm lịch sử vẻ vang của Đảng cộng sản Việt Nam', 'Đổi mới tư duy lý luận - Một động lực tinh thần của sự nghiệp đổi mới', null, '[\"Tr\\u01b0\\u01a1ng Giang Long\"]', '1', null);
INSERT INTO `web_tckh_tapchi` VALUES ('11', '3', '60 Năm ngày thành lập quân đội nhân dân Việt Nam', 'Xây dựng ý chí \"quyết chiến, quyết thắng\" của Quân đội Nhân dân Việt Nam theo tư tưởng Hồ Chí Minh', null, '[\"Nguy\\u1ec5n \\u0110\\u00ecnh Minh\"]', null, null);
INSERT INTO `web_tckh_tapchi` VALUES ('12', '3', '60 Năm ngày thành lập quân đội nhân dân Việt Nam', 'Giáo dục đạo đức cách mạng - Một nội dung quan trong trong xây dựng quân đội về chính trị theo tư tưởng Hồ Chí Minh', null, '[\"Nguy\\u1ec5n \\u0110\\u1ee9c Ti\\u1ebfn\"]', null, null);
INSERT INTO `web_tckh_tapchi` VALUES ('13', '3', '60 Năm ngày thành lập quân đội nhân dân Việt Nam', '\"Trung, Hiếu\" trong phẩm chất bộ đội cụ Hồ', null, '[\"\\u0110o\\u00e0n Th\\u1ecb M\\u1ef9 H\\u1ea1nh\"]', '4', null);
INSERT INTO `web_tckh_tapchi` VALUES ('14', '5', 'test', 'test', null, '[\"test\"]', null, null);

-- ----------------------------
-- Table structure for web_uploaded_files
-- ----------------------------
DROP TABLE IF EXISTS `web_uploaded_files`;
CREATE TABLE `web_uploaded_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `context_id` varchar(50) DEFAULT NULL,
  `context_name` varchar(50) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `file_ext` varchar(10) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `tmp` tinyint(1) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `userupload` int(11) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_uploaded_files
-- ----------------------------
INSERT INTO `web_uploaded_files` VALUES ('56', '11', 'tapchikhoahoc', '22122014\\3.pdf', 'pdf', '198863', '0', '0', '4', null, '2014-12-22 08:37:39.000000', '2014-12-22 08:37:39.000000');
INSERT INTO `web_uploaded_files` VALUES ('57', '12', 'tapchikhoahoc', '22122014\\4.pdf', 'pdf', '183811', '0', '0', '4', null, '2014-12-22 08:39:18.000000', '2014-12-22 08:39:18.000000');
INSERT INTO `web_uploaded_files` VALUES ('58', '13', 'tapchikhoahoc', '22122014\\5.pdf', 'pdf', '178566', '0', '0', '4', null, '2014-12-22 08:40:15.000000', '2014-12-22 08:40:15.000000');
INSERT INTO `web_uploaded_files` VALUES ('61', '10', 'tapchikhoahoc', '24122014\\2.pdf', 'pdf', '190720', '0', '0', '4', null, '2014-12-24 11:57:40.000000', '2014-12-24 11:57:40.000000');
INSERT INTO `web_uploaded_files` VALUES ('64', '13', 'tapchikhoahoc', '24122014\\5.pdf', 'pdf', '178566', '0', '0', '4', null, '2014-12-24 12:00:53.000000', '2014-12-24 12:00:53.000000');
INSERT INTO `web_uploaded_files` VALUES ('65', '12', 'tapchikhoahoc', '24122014\\4.pdf', 'pdf', '183811', '0', '0', '4', null, '2014-12-24 12:01:14.000000', '2014-12-24 12:01:14.000000');
INSERT INTO `web_uploaded_files` VALUES ('66', '11', 'tapchikhoahoc', '24122014\\3.pdf', 'pdf', '198863', '0', '0', '4', null, '2014-12-24 12:01:34.000000', '2014-12-24 12:01:34.000000');
INSERT INTO `web_uploaded_files` VALUES ('67', '10', 'tapchikhoahoc', '24122014\\2.pdf', 'pdf', '190720', '0', '0', '4', null, '2014-12-24 12:02:01.000000', '2014-12-24 12:02:01.000000');

-- ----------------------------
-- Table structure for web_users
-- ----------------------------
DROP TABLE IF EXISTS `web_users`;
CREATE TABLE `web_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `sa` tinyint(1) NOT NULL DEFAULT '0',
  `allow_delete` tinyint(4) DEFAULT '1',
  `auth_domain` varchar(50) DEFAULT NULL,
  `auth_from` varchar(50) DEFAULT NULL,
  `lastaccess` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_users
-- ----------------------------
INSERT INTO `web_users` VALUES ('1', 'admin', 'Administartor', 'tranhuunhan82@gmail.com', '$2y$10$lB8ZTu3x9PGXkY.Tt.EtxOJtx/ICBx1tfD2mMA.1DAAvbY1yfnXJm', '1', '0', null, 'local', '1419239198', null, '2014-09-18 05:07:53', '2014-12-22 09:06:39');
INSERT INTO `web_users` VALUES ('4', 'ttqlhttt1', '', '', '', '0', '0', 'vuthao', 'http://webadmin.ou.edu.vn', '1419395598', null, '2014-09-20 10:35:24', '2014-12-24 04:33:18');
INSERT INTO `web_users` VALUES ('5', 'nhan.th', null, null, null, '0', '0', 'vuthao', 'http://webadmin.ou.edu.vn', '1419213421', null, '0000-00-00 00:00:00', '2014-12-22 01:57:01');
INSERT INTO `web_users` VALUES ('6', 'tapchikhoahoc1', null, null, null, '0', '0', 'vuthao', 'http://webadmin.ou.edu.vn', '1419213769', null, '0000-00-00 00:00:00', '2014-12-22 02:02:49');
