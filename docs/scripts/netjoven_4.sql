SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
CREATE SCHEMA IF NOT EXISTS `netjoven` DEFAULT CHARACTER SET latin1 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `netjoven`.`njv_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_category` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(200) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `image` VARCHAR(50) NULL,
  `is_menu` TINYINT(1) NOT NULL DEFAULT '0',
  `type` VARCHAR(15) NOT NULL COMMENT 'hay tre tipo category, videos, gallery',
  `status` CHAR(3) NOT NULL DEFAULT 'act',
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_category_parent_id` (`parent_id` ASC),
  CONSTRAINT `fk_njv_category_parent_id`
    FOREIGN KEY (`parent_id`)
    REFERENCES `netjoven`.`njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_directory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_directory` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_directory` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL,
  `status` CHAR(3) NULL DEFAULT 'act',
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_directory_njv_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_njv_directory_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `netjoven`.`njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_directory_publishing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_directory_publishing` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_directory_publishing` (
  `id` INT(11) NOT NULL,
  `directory_id` INT(11) NOT NULL,
  `user_id` INT(11) NULL,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(200) NULL,
  `address` VARCHAR(255) NOT NULL,
  `web` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `observation` TEXT NOT NULL,
  `banner` VARCHAR(50) NOT NULL,
  `image` VARCHAR(50) NOT NULL,
  `place` POINT NOT NULL,
  `id_district` INT(21) NOT NULL,
  `type` ENUM('Bar','Discotecas','Lounges') NULL DEFAULT NULL,
  `status` CHAR(3) NULL DEFAULT 'act',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT INDEX `title` (`title` ASC),
  INDEX `fk_njv_directory_publishing_njv_directory1_idx` (`directory_id` ASC),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`njv_directory_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`njv_directory_gallery` ;

CREATE TABLE IF NOT EXISTS `mydb`.`njv_directory_gallery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `directory_publishing_id` INT(11) NOT NULL,
  `image` VARCHAR(50) NOT NULL,
  `title` VARCHAR(200) NULL,
  `is_featured` TINYINT(1) NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_directory_gallery_njv_directory_publishing_idx` (`directory_publishing_id` ASC),
  CONSTRAINT `fk_njv_directory_gallery_njv_directory_publishing`
    FOREIGN KEY (`directory_publishing_id`)
    REFERENCES `netjoven`.`njv_directory_publishing` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`njv_category_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`njv_category_gallery` ;

CREATE TABLE IF NOT EXISTS `mydb`.`njv_category_gallery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL,
  `image` VARCHAR(50) NOT NULL,
  `title` VARCHAR(200) NULL,
  `is_featured` TINYINT(1) NULL DEFAULT 0,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_category_gallery_njv_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_njv_category_gallery_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `netjoven`.`njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `netjoven` ;

-- -----------------------------------------------------
-- Table `netjoven`.`njv_banner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_banner` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_banner` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NULL DEFAULT NULL,
  `code` TEXT NULL DEFAULT NULL,
  `created_at` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_banner_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_banner_detail` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_banner_detail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `banner_id` INT(11) NOT NULL,
  `category_id` INT(11) NULL DEFAULT NULL,
  `tag` TEXT NULL DEFAULT NULL,
  `date_start` DATE NULL DEFAULT NULL,
  `date_end` DATE NULL DEFAULT NULL,
  `time_start` TIME NULL DEFAULT NULL,
  `time_end` TIME NULL DEFAULT NULL,
  `module` VARCHAR(100) NULL DEFAULT NULL,
  `type` VARCHAR(100) NULL DEFAULT NULL,
  `sector` VARCHAR(100) NOT NULL,
  `weight` TINYINT(3) NULL DEFAULT NULL,
  `status` CHAR(3) NOT NULL DEFAULT 'act',
  `updated_at` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_nej_banner_detail_nej_banner1_idx` (`banner_id` ASC),
  INDEX `fk_njv_banner_detail_njv_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_nej_banner_detail_nej_banner1`
    FOREIGN KEY (`banner_id`)
    REFERENCES `netjoven`.`njv_banner` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_banner_detail_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `netjoven`.`njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_tag` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_tag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NULL DEFAULT NULL,
  `is_view_page` TINYINT(1) NOT NULL DEFAULT '0',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_banner_detail_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_banner_detail_tag` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_banner_detail_tag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `banner_detail_id` INT(11) NOT NULL,
  `tag_id` INT(11) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_banner_detail_tag_njv_banner_detail1_idx` (`banner_detail_id` ASC),
  INDEX `fk_njv_banner_detail_tag_njv_tag1_idx` (`tag_id` ASC),
  CONSTRAINT `fk_njv_banner_detail_tag_njv_banner_detail1`
    FOREIGN KEY (`banner_detail_id`)
    REFERENCES `netjoven`.`njv_banner_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_banner_detail_tag_njv_tag1`
    FOREIGN KEY (`tag_id`)
    REFERENCES `netjoven`.`njv_tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_section_page`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_section_page` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_section_page` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `slug` (`slug` ASC),
  INDEX `name` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_category_section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_category_section` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_category_section` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL,
  `section_page_id` INT(11) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_category_section_njv_category1_idx` (`category_id` ASC),
  INDEX `fk_njv_category_section_njv_section_page1_idx` (`section_page_id` ASC),
  CONSTRAINT `fk_njv_category_section_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `netjoven`.`njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_category_section_njv_section_page1`
    FOREIGN KEY (`section_page_id`)
    REFERENCES `netjoven`.`njv_section_page` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_city` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_city` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `city` VARCHAR(35) NOT NULL DEFAULT '',
  `country_code` CHAR(3) NOT NULL DEFAULT '',
  `country` VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_post` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_post` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tags_old` TEXT NULL,
  `id_old` INT(11) NULL,
  `category_id_old` INT(11) NULL,
  `category_id` INT(11) NULL,
  `id_youtube` VARCHAR(45) NULL DEFAULT NULL,
  `dailymotion_code` VARCHAR(45) NULL DEFAULT NULL,
  `type` VARCHAR(20) NULL DEFAULT NULL,
  `title` VARCHAR(200) NULL DEFAULT NULL,
  `slug` VARCHAR(255) NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  `summary` TEXT NULL,
  `counter` INT(11) NOT NULL,
  `ip` VARCHAR(24) NOT NULL,
  `post_at` DATETIME NOT NULL,
  `expire_at` DATETIME NOT NULL,
  `user_id` INT(11) NULL,
  `is_exclusive` TINYINT(4) NOT NULL DEFAULT '0',
  `display` TINYINT(2) NULL,
  `view_index` TINYINT(2) NOT NULL,
  `twitter` CHAR(2) NULL,
  `america` CHAR(2) NULL DEFAULT 'no',
  `frecuencia` CHAR(2) NULL DEFAULT 'no',
  `is_recommended` TINYINT(1) NULL DEFAULT 0,
  `status` CHAR(3) NOT NULL DEFAULT 'act',
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_publish_njv_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_njv_publish_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `netjoven`.`njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_comment` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_comment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_id` INT(11) NOT NULL,
  `user_id` INT(11) NULL DEFAULT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `user_email` VARCHAR(45) NULL DEFAULT NULL,
  `comment` VARCHAR(45) NOT NULL,
  `vote` VARCHAR(45) NOT NULL DEFAULT '0',
  `status` CHAR(3) NOT NULL DEFAULT 'act',
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_comment_njv_publish1_idx` (`post_id` ASC),
  CONSTRAINT `fk_njv_comment_njv_publish1`
    FOREIGN KEY (`post_id`)
    REFERENCES `netjoven`.`njv_post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_country`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_country` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_country` (
  `code` CHAR(3) NOT NULL DEFAULT '',
  `country` CHAR(52) NOT NULL DEFAULT '',
  `continent` ENUM('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  `region` CHAR(26) NOT NULL DEFAULT '',
  `local_name` CHAR(45) NOT NULL DEFAULT '',
  `capital` INT(11) NULL DEFAULT NULL,
  `code2` CHAR(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_department`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_department` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_department` (
  `id` CHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `department` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL DEFAULT NULL,
  `status` CHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_district`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_district` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_district` (
  `id` INT(21) NOT NULL AUTO_INCREMENT,
  `id_city` INT(21) NOT NULL,
  `district` VARCHAR(50) NOT NULL,
  `link_uri` VARCHAR(50) NOT NULL,
  `place` POINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `link_uri` (`link_uri` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_ip2c`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_ip2c` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_ip2c` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `begin_ip` VARCHAR(45) NOT NULL,
  `end_ip` VARCHAR(45) NOT NULL,
  `begin_ip_num` VARCHAR(45) NOT NULL,
  `end_ip_num` VARCHAR(45) NOT NULL,
  `country_code` CHAR(2) NOT NULL,
  `country_name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_post_featured`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_post_featured` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_post_featured` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NULL DEFAULT NULL,
  `post_id` INT(11) NOT NULL,
  `title` VARCHAR(150) NULL,
  `type` VARCHAR(45) NULL DEFAULT 'N' COMMENT 'va haber tres tipos super destacado(S), destacado normal(N), y  destacado a una categoria o subcategoria(N).Ademas solo puede haber un super destacado por noticia.',
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_publish_featured_njv_category1_idx` (`category_id` ASC),
  INDEX `fk_njv_publish_featured_njv_publish1_idx` (`post_id` ASC),
  CONSTRAINT `fk_njv_publish_featured_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `netjoven`.`njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_publish_featured_njv_publish1`
    FOREIGN KEY (`post_id`)
    REFERENCES `netjoven`.`njv_post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_post_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_post_tag` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_post_tag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_id` INT(11) NOT NULL,
  `tag_id` INT(11) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_news_tag_njv_news1_idx` (`post_id` ASC),
  INDEX `fk_njv_news_tag_njv_tag1_idx` (`tag_id` ASC),
  CONSTRAINT `fk_njv_news_tag_njv_news1`
    FOREIGN KEY (`post_id`)
    REFERENCES `netjoven`.`njv_post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_news_tag_njv_tag1`
    FOREIGN KEY (`tag_id`)
    REFERENCES `netjoven`.`njv_tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_province`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_province` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_province` (
  `id` CHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `department_id` CHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `province` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL DEFAULT NULL,
  `status` CHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_post_multimedia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_post_multimedia` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_post_multimedia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_id` INT(11) NOT NULL,
  `title` VARCHAR(150) NULL DEFAULT NULL,
  `image` VARCHAR(50) NOT NULL,
  `thumbnail_two` VARCHAR(50) NULL DEFAULT NULL,
  `thumbnail_one` VARCHAR(50) NULL DEFAULT NULL,
  `video` VARCHAR(50) NULL DEFAULT NULL,
  `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
  `is_gallery` TINYINT(1) NULL DEFAULT 0,
  `is_principal` TINYINT(1) NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_gallery_photos_njv_publish1_idx` (`post_id` ASC),
  CONSTRAINT `fk_njv_gallery_photos_njv_publish1`
    FOREIGN KEY (`post_id`)
    REFERENCES `netjoven`.`njv_post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_search`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_search` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_search` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tag` TEXT NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_sys_variable`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_sys_variable` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_sys_variable` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `attribute` VARCHAR(45) NOT NULL,
  `value` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `attribute_UNIQUE` (`attribute` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_theme_day`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_theme_day` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_theme_day` (
  `id` INT(11) NULL,
  `user_id` INT(11) NULL,
  `name` VARCHAR(45) NOT NULL,
  `color` VARCHAR(45) NULL DEFAULT NULL,
  `url` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_theme_day_section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_theme_day_section` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_theme_day_section` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `section_page_id` INT(11) NOT NULL,
  `theme_day_id` INT(11) NOT NULL,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_theme_day_section_njv_theme_day1_idx` (`theme_day_id` ASC),
  INDEX `fk_njv_theme_day_section_njv_section_page1_idx` (`section_page_id` ASC),
  CONSTRAINT `fk_njv_theme_day_section_njv_theme_day1`
    FOREIGN KEY (`theme_day_id`)
    REFERENCES `netjoven`.`njv_theme_day` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_theme_day_section_njv_section_page1`
    FOREIGN KEY (`section_page_id`)
    REFERENCES `netjoven`.`njv_section_page` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_user` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `level` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `email_register` VARCHAR(45) NULL DEFAULT NULL,
  `user_social` VARCHAR(45) NULL DEFAULT NULL,
  `status` CHAR(3) NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_UNIQUE` (`user` ASC),
  INDEX `email` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_user_activity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_user_activity` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_user_activity` (
  `id` INT(21) NOT NULL AUTO_INCREMENT,
  `user_id` INT(21) NOT NULL DEFAULT '0',
  `description` VARCHAR(255) NOT NULL,
  `type` ENUM('creacion','eliminar','error','login') NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `type` (`type` ASC),
  INDEX `created_at` (`created_at` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `netjoven`.`njv_user_profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `netjoven`.`njv_user_profile` ;

CREATE TABLE IF NOT EXISTS `netjoven`.`njv_user_profile` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `gender` CHAR(1) NOT NULL DEFAULT 'H',
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `acerca` VARCHAR(45) NULL DEFAULT NULL,
  `web` VARCHAR(45) NULL DEFAULT NULL,
  `twitter` VARCHAR(45) NULL DEFAULT NULL,
  `youtube` VARCHAR(45) NULL DEFAULT NULL,
  `birthday` DATE NULL DEFAULT NULL,
  `image` VARCHAR(150) NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_user_description_njv_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_njv_user_description_njv_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `netjoven`.`njv_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
