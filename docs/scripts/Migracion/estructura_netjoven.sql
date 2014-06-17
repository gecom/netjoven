/*
Navicat MySQL Data Transfer

Source Server         : s1.netjoven.pe
Source Server Version : 50536
Source Host           : s1.netjoven.pe:3306
Source Database       : netjoven_dev

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-06-17 10:45:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for njv_banner
-- ----------------------------
DROP TABLE IF EXISTS `njv_banner`;
CREATE TABLE `njv_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `code` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_banner_detail
-- ----------------------------
DROP TABLE IF EXISTS `njv_banner_detail`;
CREATE TABLE `njv_banner_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `country` char(2) NOT NULL,
  `tag` text,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` int(2) DEFAULT NULL,
  `time_end` int(2) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `sector` varchar(100) NOT NULL,
  `weight` tinyint(3) DEFAULT NULL,
  `status` char(3) NOT NULL DEFAULT 'act',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_nej_banner_detail_nej_banner1_idx` (`banner_id`),
  KEY `fk_njv_banner_detail_njv_banner_sector1` (`sector_id`),
  KEY `fk_njv_banner_detail_njv_banner_module1` (`module_id`),
  FULLTEXT KEY `tags` (`tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_banner_module
-- ----------------------------
DROP TABLE IF EXISTS `njv_banner_module`;
CREATE TABLE `njv_banner_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `order` tinyint(2) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `fk_njv_banner_detail_njv_banner_module2` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_banner_sector
-- ----------------------------
DROP TABLE IF EXISTS `njv_banner_sector`;
CREATE TABLE `njv_banner_sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` char(3) DEFAULT 'act',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_category
-- ----------------------------
DROP TABLE IF EXISTS `njv_category`;
CREATE TABLE `njv_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(50) DEFAULT NULL,
  `is_menu` tinyint(1) NOT NULL DEFAULT '0',
  `status` char(3) NOT NULL DEFAULT 'act',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_category_parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_city
-- ----------------------------
DROP TABLE IF EXISTS `njv_city`;
CREATE TABLE `njv_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(35) NOT NULL DEFAULT '',
  `country_code` char(3) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_color_palette
-- ----------------------------
DROP TABLE IF EXISTS `njv_color_palette`;
CREATE TABLE `njv_color_palette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` char(7) NOT NULL,
  `path` varchar(255) NOT NULL,
  `is_default` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_country
-- ----------------------------
DROP TABLE IF EXISTS `njv_country`;
CREATE TABLE `njv_country` (
  `code` char(3) NOT NULL DEFAULT '',
  `country` char(52) NOT NULL DEFAULT '',
  `continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  `region` char(26) NOT NULL DEFAULT '',
  `local_name` char(45) NOT NULL DEFAULT '',
  `capital` int(11) DEFAULT NULL,
  `code2` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_department
-- ----------------------------
DROP TABLE IF EXISTS `njv_department`;
CREATE TABLE `njv_department` (
  `id` char(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `department` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` char(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_directory
-- ----------------------------
DROP TABLE IF EXISTS `njv_directory`;
CREATE TABLE `njv_directory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` char(3) DEFAULT 'act',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_directory_njv_category1_idx` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_directory_publishing
-- ----------------------------
DROP TABLE IF EXISTS `njv_directory_publishing`;
CREATE TABLE `njv_directory_publishing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `observation` text NOT NULL,
  `banner` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `place` point NOT NULL,
  `id_district` int(21) NOT NULL,
  `type` varchar(15) NOT NULL,
  `status` char(3) DEFAULT 'act',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `fk_njv_directory_publishing_njv_directory1_idx` (`directory_id`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_directory_publishing_featured
-- ----------------------------
DROP TABLE IF EXISTS `njv_directory_publishing_featured`;
CREATE TABLE `njv_directory_publishing_featured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory_publishing_id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `image` varchar(55) DEFAULT NULL,
  `post_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_directory_publishing_featured_njv_directory_publishi_idx` (`directory_publishing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_district
-- ----------------------------
DROP TABLE IF EXISTS `njv_district`;
CREATE TABLE `njv_district` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `id_city` int(21) NOT NULL,
  `district` varchar(50) NOT NULL,
  `link_uri` varchar(50) NOT NULL,
  `place` point NOT NULL,
  PRIMARY KEY (`id`),
  KEY `link_uri` (`link_uri`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_group
-- ----------------------------
DROP TABLE IF EXISTS `njv_group`;
CREATE TABLE `njv_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name_full` varchar(150) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_ip2c
-- ----------------------------
DROP TABLE IF EXISTS `njv_ip2c`;
CREATE TABLE `njv_ip2c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `begin_ip` varchar(45) NOT NULL,
  `end_ip` varchar(45) NOT NULL,
  `begin_ip_num` varchar(45) NOT NULL,
  `end_ip_num` varchar(45) NOT NULL,
  `country_code` char(2) NOT NULL,
  `country_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_post
-- ----------------------------
DROP TABLE IF EXISTS `njv_post`;
CREATE TABLE `njv_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tags_old` text,
  `id_old` int(11) DEFAULT NULL,
  `category_id_old` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `id_video` varchar(45) DEFAULT NULL,
  `type_video` char(1) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text,
  `summary` text,
  `counter` int(11) NOT NULL,
  `ip` varchar(24) NOT NULL,
  `post_at` timestamp NULL DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `display` tinyint(2) DEFAULT '1',
  `view_index` tinyint(2) NOT NULL DEFAULT '0',
  `twitter` tinyint(2) DEFAULT NULL,
  `america` tinyint(2) DEFAULT '0',
  `frecuencia` tinyint(2) DEFAULT '0',
  `is_recommended` tinyint(1) DEFAULT '0',
  `status` char(3) NOT NULL DEFAULT 'pbl',
  `has_gallery` tinyint(1) DEFAULT NULL,
  `total_read` int(11) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_publish_njv_category1_idx` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_post_featured
-- ----------------------------
DROP TABLE IF EXISTS `njv_post_featured`;
CREATE TABLE `njv_post_featured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `type` char(3) NOT NULL COMMENT 'va haber tres tipos super destacado(S), destacado normal(N), y  destacado a una categoria o subcategoria(N).Ademas solo puede haber un super destacado por noticia.',
  `post_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_publish_featured_njv_publish1_idx` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_post_multimedia
-- ----------------------------
DROP TABLE IF EXISTS `njv_post_multimedia`;
CREATE TABLE `njv_post_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  `thumbnail_two` varchar(50) DEFAULT NULL,
  `thumbnail_one` varchar(50) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_gallery` tinyint(1) DEFAULT '0',
  `is_principal` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_gallery_photos_njv_publish1_idx` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_post_photos
-- ----------------------------
DROP TABLE IF EXISTS `njv_post_photos`;
CREATE TABLE `njv_post_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(70) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `njv_post_tag`;
CREATE TABLE `njv_post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_news_tag_njv_news1_idx` (`post_id`),
  KEY `fk_njv_news_tag_njv_tag1_idx` (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_post_visits
-- ----------------------------
DROP TABLE IF EXISTS `njv_post_visits`;
CREATE TABLE `njv_post_visits` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `country` varchar(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idnews` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_province
-- ----------------------------
DROP TABLE IF EXISTS `njv_province`;
CREATE TABLE `njv_province` (
  `id` char(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `department_id` char(4) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `province` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` char(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  FULLTEXT KEY `search` (`tag`,`category`,`title`,`summary`,`content`),
  FULLTEXT KEY `tags` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_slider_more
-- ----------------------------
DROP TABLE IF EXISTS `njv_slider_more`;
CREATE TABLE `njv_slider_more` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `tags` text,
  `id_video` varchar(45) DEFAULT NULL,
  `type_video` char(1) DEFAULT NULL,
  `count_read` int(8) DEFAULT '0',
  `count_commented` int(8) DEFAULT '0',
  `count_shared` int(8) DEFAULT '0',
  `has_gallery` tinyint(1) DEFAULT '0',
  `has_video` tinyint(1) DEFAULT '0',
  UNIQUE KEY `post_id` (`post_id`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_sys_variable
-- ----------------------------
DROP TABLE IF EXISTS `njv_sys_variable`;
CREATE TABLE `njv_sys_variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute` varchar(45) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attribute_UNIQUE` (`attribute`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_tag
-- ----------------------------
DROP TABLE IF EXISTS `njv_tag`;
CREATE TABLE `njv_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(150) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_theme_day
-- ----------------------------
DROP TABLE IF EXISTS `njv_theme_day`;
CREATE TABLE `njv_theme_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `color` varchar(45) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_njv_theme_day_njv_tag1_idx` (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_theme_day_section
-- ----------------------------
DROP TABLE IF EXISTS `njv_theme_day_section`;
CREATE TABLE `njv_theme_day_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `theme_day_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_theme_day_section_njv_theme_day1_idx` (`theme_day_id`),
  KEY `fk_njv_theme_day_section_njv_category1_idx` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_user
-- ----------------------------
DROP TABLE IF EXISTS `njv_user`;
CREATE TABLE `njv_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `email_register` varchar(45) DEFAULT NULL,
  `user_social` varchar(45) DEFAULT NULL,
  `status` char(3) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_user_activity
-- ----------------------------
DROP TABLE IF EXISTS `njv_user_activity`;
CREATE TABLE `njv_user_activity` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `user_id` int(21) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  `type` enum('creacion','eliminar','error','login') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_user_group
-- ----------------------------
DROP TABLE IF EXISTS `njv_user_group`;
CREATE TABLE `njv_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_user_group_njv_user1_idx` (`user_id`),
  KEY `fk_njv_user_group_njv_group1_idx` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_user_profile
-- ----------------------------
DROP TABLE IF EXISTS `njv_user_profile`;
CREATE TABLE `njv_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `country` varchar(40) NOT NULL,
  `city` varchar(255) NOT NULL,
  `department` varchar(40) NOT NULL,
  `gender` char(1) NOT NULL DEFAULT 'H',
  `phone` varchar(45) DEFAULT NULL,
  `acerca` varchar(45) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `youtube` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_user_profile_njv_user1_idx` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for njv_user_tools
-- ----------------------------
DROP TABLE IF EXISTS `njv_user_tools`;
CREATE TABLE `njv_user_tools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `color_palette_id` int(11) NOT NULL,
  `type_module` char(2) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_njv_user_tools_njv_user1_idx` (`user_id`),
  KEY `fk_njv_user_tools_njv_color_palette1_idx` (`color_palette_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
