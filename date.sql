/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : date

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-03 17:14:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for academy
-- ----------------------------
DROP TABLE IF EXISTS `academy`;
CREATE TABLE `academy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of academy
-- ----------------------------
INSERT INTO `academy` VALUES ('1', '计算机');
INSERT INTO `academy` VALUES ('2', '传媒');
INSERT INTO `academy` VALUES ('3', '通信');

-- ----------------------------
-- Table structure for advertise
-- ----------------------------
DROP TABLE IF EXISTS `advertise`;
CREATE TABLE `advertise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of advertise
-- ----------------------------
INSERT INTO `advertise` VALUES ('1', 'https://www.baidu.com', 'http://106.184.7.12:8002/Public/test.jpg', '1');
INSERT INTO `advertise` VALUES ('2', 'http://www.pornhub.com', 'http://106.184.7.12:8002/Public/test1.jpg', '1');
INSERT INTO `advertise` VALUES ('3', 'http://www.taobao.com', 'http://106.184.7.12:8002/Public/test3.jpg', '1');

-- ----------------------------
-- Table structure for advice
-- ----------------------------
DROP TABLE IF EXISTS `advice`;
CREATE TABLE `advice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of advice
-- ----------------------------

-- ----------------------------
-- Table structure for collection
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of collection
-- ----------------------------
INSERT INTO `collection` VALUES ('1', '1', '1');
INSERT INTO `collection` VALUES ('2', '2', '1');
INSERT INTO `collection` VALUES ('3', '3', '1');
INSERT INTO `collection` VALUES ('4', '4', '1');

-- ----------------------------
-- Table structure for date
-- ----------------------------
DROP TABLE IF EXISTS `date`;
CREATE TABLE `date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_type` int(2) DEFAULT NULL,
  `cost_model` int(11) DEFAULT NULL,
  `content` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `apply_num` int(11) DEFAULT NULL,
  `sure_num` int(11) DEFAULT NULL,
  `limit_num` int(11) DEFAULT NULL,
  `gender_limit` int(11) DEFAULT NULL,
  `score` float DEFAULT NULL,
  `scored_num` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of date
-- ----------------------------
INSERT INTO `date` VALUES ('1', '1', '来约炮!', '3', '1', 'test', '重邮宾馆', '1529456317', '1429446317', '0', '0', '1', '0', '3', '3', '1');
INSERT INTO `date` VALUES ('2', '1', '来约炮!', '2', '1', 'test', '重邮宾馆', '1529456316', '1429446316', '0', '0', '1', '1', '0', '0', '2');
INSERT INTO `date` VALUES ('3', '1', '来约炮!', '1', '1', 'test', '重邮宾馆', '1429456315', '1429446315', '0', '0', '1', '1', '0', '0', '2');
INSERT INTO `date` VALUES ('4', '1', '来约炮!', '1', '1', 'test', '重邮宾馆', '1429456314', '1429446314', '0', '0', '1', '0', '0', '0', '2');
INSERT INTO `date` VALUES ('5', '1', '来约炮!', '2', '1', 'test', '重邮宾馆', '1429456313', '1429446313', '0', '0', '1', '2', '0', '0', '2');
INSERT INTO `date` VALUES ('26', '1', 'test', '1', '1', 'test1', 'menkou', '1431429313', '1431434132', '0', '0', '0', '0', '0', '0', '2');
INSERT INTO `date` VALUES ('25', '1', 'test', '1', '1', 'test1', 'menkou', '1431429313', '1431434102', '0', '0', '0', '0', '0', '0', '2');

-- ----------------------------
-- Table structure for date_limit
-- ----------------------------
DROP TABLE IF EXISTS `date_limit`;
CREATE TABLE `date_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `selectmodel` int(11) DEFAULT NULL,
  `condition` int(11) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of date_limit
-- ----------------------------
INSERT INTO `date_limit` VALUES ('1', '1', '1', '1', '2');
INSERT INTO `date_limit` VALUES ('2', '1', '1', '1', '3');
INSERT INTO `date_limit` VALUES ('24', '1', '2', '2', '3');
INSERT INTO `date_limit` VALUES ('23', '1', '2', '2', '3');
INSERT INTO `date_limit` VALUES ('22', '1', '2', '2', '4');

-- ----------------------------
-- Table structure for date_type
-- ----------------------------
DROP TABLE IF EXISTS `date_type`;
CREATE TABLE `date_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of date_type
-- ----------------------------
INSERT INTO `date_type` VALUES ('1', '吃饭');
INSERT INTO `date_type` VALUES ('2', '打牌');
INSERT INTO `date_type` VALUES ('3', '约炮');

-- ----------------------------
-- Table structure for grade
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12013 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grade
-- ----------------------------
INSERT INTO `grade` VALUES ('1', '2012级');
INSERT INTO `grade` VALUES ('2', '2013级');
INSERT INTO `grade` VALUES ('3', '2014级');
INSERT INTO `grade` VALUES ('4', '2015级');
INSERT INTO `grade` VALUES ('100', '其他');

-- ----------------------------
-- Table structure for letter
-- ----------------------------
DROP TABLE IF EXISTS `letter`;
CREATE TABLE `letter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `content` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of letter
-- ----------------------------
INSERT INTO `letter` VALUES ('1', '1', '1', '1', 'test', '1429446317', '1', '1');
INSERT INTO `letter` VALUES ('2', '2', '1', '1', 'test2', '1429446317', '1', '1');

-- ----------------------------
-- Table structure for status_advertise
-- ----------------------------
DROP TABLE IF EXISTS `status_advertise`;
CREATE TABLE `status_advertise` (
  `status_id` int(3) unsigned NOT NULL,
  `status_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_advertise
-- ----------------------------
INSERT INTO `status_advertise` VALUES ('1', '启用');
INSERT INTO `status_advertise` VALUES ('2', '不启用');

-- ----------------------------
-- Table structure for status_cost_model
-- ----------------------------
DROP TABLE IF EXISTS `status_cost_model`;
CREATE TABLE `status_cost_model` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_cost_model
-- ----------------------------
INSERT INTO `status_cost_model` VALUES ('1', 'AA');
INSERT INTO `status_cost_model` VALUES ('2', '我请客');
INSERT INTO `status_cost_model` VALUES ('3', '求请客');

-- ----------------------------
-- Table structure for status_date
-- ----------------------------
DROP TABLE IF EXISTS `status_date`;
CREATE TABLE `status_date` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_date
-- ----------------------------
INSERT INTO `status_date` VALUES ('0', '已结束');
INSERT INTO `status_date` VALUES ('1', '成功');
INSERT INTO `status_date` VALUES ('2', '受理中');

-- ----------------------------
-- Table structure for status_letter
-- ----------------------------
DROP TABLE IF EXISTS `status_letter`;
CREATE TABLE `status_letter` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_letter
-- ----------------------------
INSERT INTO `status_letter` VALUES ('0', '未读');
INSERT INTO `status_letter` VALUES ('1', '已读');

-- ----------------------------
-- Table structure for status_letter_type
-- ----------------------------
DROP TABLE IF EXISTS `status_letter_type`;
CREATE TABLE `status_letter_type` (
  `id` int(5) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_letter_type
-- ----------------------------
INSERT INTO `status_letter_type` VALUES ('0', '拒绝');
INSERT INTO `status_letter_type` VALUES ('1', '接受');
INSERT INTO `status_letter_type` VALUES ('2', '未处理');

-- ----------------------------
-- Table structure for status_score
-- ----------------------------
DROP TABLE IF EXISTS `status_score`;
CREATE TABLE `status_score` (
  `id` int(5) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of status_score
-- ----------------------------
INSERT INTO `status_score` VALUES ('0', '未打分');
INSERT INTO `status_score` VALUES ('1', '已打分');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `head` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `grade` int(1) DEFAULT NULL,
  `academy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qq` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weixin` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '2013211000', 'http://106.184.7.12:8002/Public/head.jpg', 'i\'m db', '刘晨凌东安', '2', '2', '3', '1234567890', 'we', '12345678900', 'nasdfnldssdaf', '1433003912', '1433003934');
INSERT INTO `users` VALUES ('2', '2013211001', 'http://106.184.7.12:8002/Public/head.jpg', 'i\'m db1', 'aliling', '1', '3', '1', '0987654321', 'ew', '00123456789', 'cdsagrebvfra', '1433003912', '1433003934');

-- ----------------------------
-- Table structure for user_date
-- ----------------------------
DROP TABLE IF EXISTS `user_date`;
CREATE TABLE `user_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `score_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_date
-- ----------------------------
INSERT INTO `user_date` VALUES ('8', '1', '1', '1431244033', '2', '0');
INSERT INTO `user_date` VALUES ('2', '2', '1', '1429446317', '2', '0');
INSERT INTO `user_date` VALUES ('3', '3', '1', '1429446317', '2', '0');
INSERT INTO `user_date` VALUES ('6', '4', '1', '1431241589', '2', '0');
INSERT INTO `user_date` VALUES ('10', '2', '2', '1431257920', '2', '0');
