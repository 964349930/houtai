-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2014 at 05:46 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ybao`
--

-- --------------------------------------------------------

--
-- Table structure for table `y_articles`
--

CREATE TABLE IF NOT EXISTS `y_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `date_create` int(10) unsigned NOT NULL,
  `date_modify` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `y_articles`
--

INSERT INTO `y_articles` (`id`, `group_id`, `title`, `info`, `date_create`, `date_modify`) VALUES
(1, 1, '基金份额换海外房产人民币出境曝新“暗道”', '基金份额换海外房产人民币出境曝新“暗道”啊啊啊啊啊啊啊啊啊啊啊啊啊啊', 1411524134, 1411524134),
(2, 1, '基金份额换海外房产人民币', '基金份额换海外房产人民币啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊', 1411524190, 1411524383);

-- --------------------------------------------------------

--
-- Table structure for table `y_articles_group`
--

CREATE TABLE IF NOT EXISTS `y_articles_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `y_articles_group`
--

INSERT INTO `y_articles_group` (`id`, `title`, `cover`, `sort`) VALUES
(1, '公共版区', '201409/24/54221e8eb3eab.jpg', 1),
(2, '黄金论坛', '201409/24/54221ed66668f.jpg', 2),
(3, '银行论坛', '201409/24/54221ee98f7fb.jpg', 3),
(4, '基金论坛', '201409/24/54221ef8a3a6e.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `y_banners`
--

CREATE TABLE IF NOT EXISTS `y_banners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `sort` int(11) unsigned NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `y_banners`
--

INSERT INTO `y_banners` (`id`, `group_id`, `title`, `img`, `sort`, `link`) VALUES
(1, 1, '1', '201409/24/542237b350176.jpg', 1, ''),
(2, 1, '2', '201409/24/54223803b5aaf.jpg', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `y_banners_group`
--

CREATE TABLE IF NOT EXISTS `y_banners_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `y_banners_group`
--

INSERT INTO `y_banners_group` (`id`, `title`) VALUES
(1, '首页幻灯片'),
(2, '进宝圈幻灯片');

-- --------------------------------------------------------

--
-- Table structure for table `y_circles`
--

CREATE TABLE IF NOT EXISTS `y_circles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_create` int(10) unsigned NOT NULL,
  `date_modify` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `y_collect`
--

CREATE TABLE IF NOT EXISTS `y_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `obj_type` varchar(100) NOT NULL,
  `obj_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `y_collect`
--

INSERT INTO `y_collect` (`id`, `user_id`, `obj_type`, `obj_id`) VALUES
(6, 3, 'goods', 3),
(25, 3, 'goods', 1),
(19, 3, 'shops', 4),
(14, 3, 'shops', 2),
(16, 3, 'articles', 1),
(23, 3, 'articles', 2);

-- --------------------------------------------------------

--
-- Table structure for table `y_goods`
--

CREATE TABLE IF NOT EXISTS `y_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `intro` text NOT NULL,
  `yield` varchar(20) NOT NULL COMMENT '收益率',
  `deadline` varchar(20) NOT NULL COMMENT '期限',
  `begin` varchar(20) NOT NULL COMMENT '投资起点',
  `date_create` int(10) unsigned NOT NULL,
  `date_modify` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `y_goods`
--

INSERT INTO `y_goods` (`id`, `shop_id`, `name`, `type_id`, `intro`, `yield`, `deadline`, `begin`, `date_create`, `date_modify`) VALUES
(1, 2, '合盈优选SA465号', 2, '合盈优选SA465号描述', '9', '1', '500', 1411436561, 1411438439),
(2, 1, '测试产品', 2, '测试产品描述', '4', '2', '10000', 1411437900, 1411438452),
(3, 4, '建行产品', 2, '斯蒂芬森', '4', '3', '5000', 1411458595, 1411458595),
(4, 4, '测试产品2', 2, '测试产品2', '4', '5', '75500', 1411625525, 1411625525);

-- --------------------------------------------------------

--
-- Table structure for table `y_orders`
--

CREATE TABLE IF NOT EXISTS `y_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned NOT NULL,
  `manager_id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `goods_id` int(11) unsigned NOT NULL,
  `date_create` int(10) unsigned NOT NULL,
  `date_modify` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `y_orders`
--

INSERT INTO `y_orders` (`id`, `customer_id`, `manager_id`, `name`, `goods_id`, `date_create`, `date_modify`, `status`) VALUES
(3, 3, 0, '合盈优选SA465号', 1, 1411544104, 1411544104, 1),
(2, 3, 10, '建行产品', 3, 1411544058, 1411544058, 4),
(4, 3, 10, '测试产品2', 4, 1411625669, 1411625669, 4),
(5, 3, 0, '合盈优选SA465号', 1, 1411703243, 1411703243, 1),
(6, 3, 0, '合盈优选SA465号', 1, 1411722532, 1411722532, 1);

-- --------------------------------------------------------

--
-- Table structure for table `y_shops`
--

CREATE TABLE IF NOT EXISTS `y_shops` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `banner` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `y_shops`
--

INSERT INTO `y_shops` (`id`, `user_id`, `banner`, `title`, `cover`, `intro`) VALUES
(1, 6, '', '中国银行济南分行', '201409/22/541fc44ac0a8e.jpg', '中国银行济南分行'),
(2, 7, '', '招商银行济南分行', '201409/22/541fc4c723b3e.jpg', '招商银行济南分行'),
(4, 5, '201409/25/5423cd6641ad5.jpg', '建设银行济南分行', '201409/23/542126f35d2ca.jpg', '建设银行是一家***的银行，拥有***和***等');

-- --------------------------------------------------------

--
-- Table structure for table `y_users`
--

CREATE TABLE IF NOT EXISTS `y_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `date_reg` int(10) unsigned NOT NULL,
  `date_login` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `y_users`
--

INSERT INTO `y_users` (`id`, `group_id`, `shop_id`, `name`, `password`, `mobile`, `email`, `status`, `date_reg`, `date_login`) VALUES
(1, 0, '', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', '', 1, 0, 0),
(3, 1, '', 'chen', 'e10adc3949ba59abbe56e057f20f883e', '15550005746', 'chen.orange@yahoo.cn', 1, 0, 1411700902),
(5, 3, '', '建设银行济南分行', 'e10adc3949ba59abbe56e057f20f883e', '15562595986', 'chen.orange@aliyun.com', 1, 1411457575, 1411638733),
(6, 3, '', '中国银行', 'e10adc3949ba59abbe56e057f20f883e', '15562595865', 'orangechen.1991@gmail.com', 1, 1411458708, 1411458708),
(7, 3, '', '招商银行', 'e10adc3949ba59abbe56e057f20f883e', '15562595968', 'orangechen.1991@gmail.com', 1, 1411458740, 1411458740),
(8, 1, '', '', 'e10adc3949ba59abbe56e057f20f883e', '15550005744', '', 1, 1411459277, 1411459277),
(9, 2, '4', 'some经理', 'e10adc3949ba59abbe56e057f20f883e', '15550005741', 'haha0@yahoo.cn', 0, 1411459349, 1411612957),
(10, 2, '4', 'KING', 'e10adc3949ba59abbe56e057f20f883e', '15550005742', '', 1, 1411609407, 1411625792);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
