/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : netjoven3

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2014-06-17 10:50:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for njv_search
-- ----------------------------
DROP TABLE IF EXISTS `njv_search`;
CREATE TABLE `njv_search` (
  `post_id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_parent_id` int(11) NOT NULL,
  `post_at` timestamp NULL DEFAULT NULL,
  `has_gallery` tinyint(1) DEFAULT NULL,
  `has_video` tinyint(1) DEFAULT NULL,
  `count_commented` int(8) DEFAULT NULL,
  `count_read` int(8) DEFAULT NULL,
  `count_shared` int(8) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `summary` text,
  `content` text,
  `type_video` char(1) DEFAULT NULL,
  `id_video` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `post_id` (`post_id`),
  KEY `has_gallery` (`has_gallery`),
  KEY `has_video` (`has_video`),
  KEY `count_commented` (`count_commented`),
  KEY `count_read` (`count_read`),
  KEY `count_shared` (`count_shared`),
  FULLTEXT KEY `search` (`tag`,`category`,`title`,`summary`,`content`),
  FULLTEXT KEY `tags` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
