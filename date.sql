-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-06-02 09:51:23
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `date`
--

-- --------------------------------------------------------

--
-- 表的结构 `academy`
--

CREATE TABLE IF NOT EXISTS `academy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `academy`
--

INSERT INTO `academy` (`id`, `name`) VALUES
(1, '计算机'),
(2, '传媒'),
(3, '通信');

-- --------------------------------------------------------

--
-- 表的结构 `advertise`
--

CREATE TABLE IF NOT EXISTS `advertise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `advertise`
--

INSERT INTO `advertise` (`id`, `url`, `src`, `status`) VALUES
(1, 'https://www.baidu.com', 'http://106.184.7.12:8002/Public/test.jpg', 1),
(2, 'http://www.pornhub.com', 'http://106.184.7.12:8002/Public/test1.jpg', 1),
(3, 'http://www.taobao.com', 'http://106.184.7.12:8002/Public/test3.jpg', 1);

-- --------------------------------------------------------

--
-- 表的结构 `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `collection`
--

INSERT INTO `collection` (`id`, `date_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- 表的结构 `date`
--

CREATE TABLE IF NOT EXISTS `date` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `date`
--

INSERT INTO `date` (`id`, `user_id`, `title`, `date_type`, `cost_model`, `content`, `place`, `date_time`, `created_at`, `apply_num`, `sure_num`, `limit_num`, `gender_limit`, `score`, `scored_num`, `status`) VALUES
(1, 1, '来约炮!', 3, 1, 'test', '重邮宾馆', 1529456317, 1429446317, 0, 0, 1, 0, 3, 3, 1),
(2, 1, '来约炮!', 2, 1, 'test', '重邮宾馆', 1529456316, 1429446316, 0, 0, 1, 1, 0, 0, 2),
(3, 1, '来约炮!', 1, 1, 'test', '重邮宾馆', 1429456315, 1429446315, 0, 0, 1, 1, 0, 0, 2),
(4, 1, '来约炮!', 1, 1, 'test', '重邮宾馆', 1429456314, 1429446314, 0, 0, 1, 0, 0, 0, 2),
(5, 1, '来约炮!', 2, 1, 'test', '重邮宾馆', 1429456313, 1429446313, 0, 0, 1, 2, 0, 0, 2),
(26, 1, 'test', 1, 1, 'test1', 'menkou', 1431429313, 1431434132, 0, 0, 0, 0, 0, 0, 2),
(25, 1, 'test', 1, 1, 'test1', 'menkou', 1431429313, 1431434102, 0, 0, 0, 0, 0, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `date_limit`
--

CREATE TABLE IF NOT EXISTS `date_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `selectmodel` int(11) DEFAULT NULL,
  `condition` int(11) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

--
-- 转存表中的数据 `date_limit`
--

INSERT INTO `date_limit` (`id`, `date_id`, `selectmodel`, `condition`, `limit`) VALUES
(1, 1, 1, 1, 2012),
(2, 1, 1, 1, 2013),
(24, 1, 2, 2, 2013),
(23, 1, 2, 2, 2013),
(22, 1, 2, 2, 2014);

-- --------------------------------------------------------

--
-- 表的结构 `date_type`
--

CREATE TABLE IF NOT EXISTS `date_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `date_type`
--

INSERT INTO `date_type` (`id`, `type`) VALUES
(1, '吃饭'),
(2, '打牌'),
(3, '约炮');

-- --------------------------------------------------------

--
-- 表的结构 `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12013 ;

--
-- 转存表中的数据 `grade`
--

INSERT INTO `grade` (`id`, `name`) VALUES
(2012, '2012级'),
(2013, '2013级'),
(2014, '2014级'),
(2015, '2015级');

-- --------------------------------------------------------

--
-- 表的结构 `letter`
--

CREATE TABLE IF NOT EXISTS `letter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `content` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `letter`
--

INSERT INTO `letter` (`id`, `date_id`, `from`, `to`, `content`, `time`, `status`, `type`) VALUES
(1, 1, 1, 1, 'test', 1429446317, 1, 1),
(2, 2, 1, 1, 'test2', 1429446317, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `status_advertise`
--

CREATE TABLE IF NOT EXISTS `status_advertise` (
  `status_id` int(3) unsigned NOT NULL,
  `status_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `status_advertise`
--

INSERT INTO `status_advertise` (`status_id`, `status_name`) VALUES
(1, '启用'),
(2, '不启用');

-- --------------------------------------------------------

--
-- 表的结构 `status_cost_model`
--

CREATE TABLE IF NOT EXISTS `status_cost_model` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `status_cost_model`
--

INSERT INTO `status_cost_model` (`id`, `name`) VALUES
(1, 'AA'),
(2, '我请客'),
(3, '求请客');

-- --------------------------------------------------------

--
-- 表的结构 `status_date`
--

CREATE TABLE IF NOT EXISTS `status_date` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `status_date`
--

INSERT INTO `status_date` (`id`, `name`) VALUES
(0, '已结束'),
(1, '成功'),
(2, '受理中');

-- --------------------------------------------------------

--
-- 表的结构 `status_letter`
--

CREATE TABLE IF NOT EXISTS `status_letter` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `status_letter`
--

INSERT INTO `status_letter` (`id`, `name`) VALUES
(0, '未读'),
(1, '已读');

-- --------------------------------------------------------

--
-- 表的结构 `status_letter_type`
--

CREATE TABLE IF NOT EXISTS `status_letter_type` (
  `id` int(5) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `status_letter_type`
--

INSERT INTO `status_letter_type` (`id`, `name`) VALUES
(0, '拒绝'),
(1, '接受'),
(2, '未处理');

-- --------------------------------------------------------

--
-- 表的结构 `status_score`
--

CREATE TABLE IF NOT EXISTS `status_score` (
  `id` int(5) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `status_score`
--

INSERT INTO `status_score` (`id`, `name`) VALUES
(0, '未打分'),
(1, '已打分');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `stu_num`, `head`, `signature`, `nickname`, `gender`, `grade`, `academy`, `qq`, `weixin`, `telephone`, `token`, `created_at`, `updated_at`) VALUES
(1, '2013211000', 'http://106.184.7.12:8002/Public/head.jpg', 'i''m db', '刘晨凌东安', 2, 2, '3', '1234567890', 'we', '12345678900', 'nasdfnldssdaf', 1433003912, 1433003934),
(2, '2013211001', 'http://106.184.7.12:8002/Public/head.jpg', 'i''m db1', 'aliling', 1, 3, '1', '0987654321', 'ew', '00123456789', 'cdsagrebvfra', 1433003912, 1433003934);

-- --------------------------------------------------------

--
-- 表的结构 `user_date`
--

CREATE TABLE IF NOT EXISTS `user_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `score_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `user_date`
--

INSERT INTO `user_date` (`id`, `date_id`, `user_id`, `time`, `status`, `score_status`) VALUES
(8, 1, 1, 1431244033, 2, 0),
(2, 2, 1, 1429446317, 2, 0),
(3, 3, 1, 1429446317, 2, 0),
(6, 4, 1, 1431241589, 2, 0),
(10, 2, 2, 1431257920, 2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
