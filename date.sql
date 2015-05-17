/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : date

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-05-17 17:28:36
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
INSERT INTO `date_limit` VALUES ('1', '1', '1', '1', '1');
INSERT INTO `date_limit` VALUES ('2', '1', '1', '1', '2');
INSERT INTO `date_limit` VALUES ('24', '1', '2', '2', '2');
INSERT INTO `date_limit` VALUES ('23', '1', '2', '2', '1');
INSERT INTO `date_limit` VALUES ('22', '1', '2', '2', '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grade
-- ----------------------------
INSERT INTO `grade` VALUES ('1', '大一');
INSERT INTO `grade` VALUES ('2', '大二');
INSERT INTO `grade` VALUES ('3', '大三');
INSERT INTO `grade` VALUES ('4', '大四及以上');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '2013211000', 'http://106.184.7.12:8002/Public/head.jpg', 'i\'m db', '刘晨凌', '2', '2', '3', '1234567890', 'we', '12345678900', 'nasdfnldssdaf');
INSERT INTO `users` VALUES ('2', '2013211001', 'http://106.184.7.12:8002/Public/head.jpg', 'i\'m db1', 'aliling', '1', '3', '1', '0987654321', 'ew', '00123456789', 'cdsagrebvfra');

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
