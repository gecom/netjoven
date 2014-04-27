

-- -----------------------------------------------------
-- Table `njv_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_category` ;

CREATE TABLE IF NOT EXISTS `njv_category` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `parent_id` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(200) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `image` VARCHAR(50) NULL,
  `is_menu` TINYINT(1) NOT NULL DEFAULT '0',
  `status` CHAR(3) NOT NULL DEFAULT 'act',
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_category_parent_id` (`parent_id` ASC),
  CONSTRAINT `fk_njv_category_parent_id`
    FOREIGN KEY (`parent_id`)
    REFERENCES `njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_directory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_directory` ;

CREATE TABLE IF NOT EXISTS `njv_directory` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL,
  `status` CHAR(3) NULL DEFAULT 'act',
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_directory_njv_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_njv_directory_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_directory_publishing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_directory_publishing` ;

CREATE TABLE IF NOT EXISTS `njv_directory_publishing` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT INDEX `title` (`title` ASC),
  INDEX `fk_njv_directory_publishing_njv_directory1_idx` (`directory_id` ASC),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_directory_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_directory_gallery` ;

CREATE TABLE IF NOT EXISTS `njv_directory_gallery` (
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
    REFERENCES `njv_directory_publishing` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_color_palette`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_color_palette` ;

CREATE TABLE IF NOT EXISTS `njv_color_palette` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `color` CHAR(7) NOT NULL,
  `path` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_user` ;

CREATE TABLE IF NOT EXISTS `njv_user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `level` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `email_register` VARCHAR(45) NULL DEFAULT NULL,
  `user_social` VARCHAR(45) NULL DEFAULT NULL,
  `status` CHAR(3) NULL DEFAULT NULL,
  `remember_token` VARCHAR(255) NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_UNIQUE` (`user` ASC),
  INDEX `email` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_user_tools`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_user_tools` ;

CREATE TABLE IF NOT EXISTS `njv_user_tools` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `color_palette_id` INT NOT NULL,
  `type_module` CHAR(2) NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_user_tools_njv_user1_idx` (`user_id` ASC),
  INDEX `fk_njv_user_tools_njv_color_palette1_idx` (`color_palette_id` ASC),
  CONSTRAINT `fk_njv_user_tools_njv_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `njv_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_user_tools_njv_color_palette1`
    FOREIGN KEY (`color_palette_id`)
    REFERENCES `njv_color_palette` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `njv_banner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_banner` ;

CREATE TABLE IF NOT EXISTS `njv_banner` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NULL DEFAULT NULL,
  `code` TEXT NULL DEFAULT NULL,
  `created_at` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_banner_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_banner_detail` ;

CREATE TABLE IF NOT EXISTS `njv_banner_detail` (
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
    REFERENCES `njv_banner` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_banner_detail_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_tag` ;

CREATE TABLE IF NOT EXISTS `njv_tag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_banner_detail_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_banner_detail_tag` ;

CREATE TABLE IF NOT EXISTS `njv_banner_detail_tag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `banner_detail_id` INT(11) NOT NULL,
  `tag_id` INT(11) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_banner_detail_tag_njv_banner_detail1_idx` (`banner_detail_id` ASC),
  INDEX `fk_njv_banner_detail_tag_njv_tag1_idx` (`tag_id` ASC),
  CONSTRAINT `fk_njv_banner_detail_tag_njv_banner_detail1`
    FOREIGN KEY (`banner_detail_id`)
    REFERENCES `njv_banner_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_banner_detail_tag_njv_tag1`
    FOREIGN KEY (`tag_id`)
    REFERENCES `njv_tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_city` ;

CREATE TABLE IF NOT EXISTS `njv_city` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `city` VARCHAR(35) NOT NULL DEFAULT '',
  `country_code` CHAR(3) NOT NULL DEFAULT '',
  `country` VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_country`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_country` ;

CREATE TABLE IF NOT EXISTS `njv_country` (
  `code` CHAR(3) NOT NULL DEFAULT '',
  `country` CHAR(52) NOT NULL DEFAULT '',
  `continent` ENUM('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  `region` CHAR(26) NOT NULL DEFAULT '',
  `local_name` CHAR(45) NOT NULL DEFAULT '',
  `capital` INT(11) NULL DEFAULT NULL,
  `code2` CHAR(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_department`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_department` ;

CREATE TABLE IF NOT EXISTS `njv_department` (
  `id` CHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `department` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL DEFAULT NULL,
  `status` CHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_district`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_district` ;

CREATE TABLE IF NOT EXISTS `njv_district` (
  `id` INT(21) NOT NULL AUTO_INCREMENT,
  `id_city` INT(21) NOT NULL,
  `district` VARCHAR(50) NOT NULL,
  `link_uri` VARCHAR(50) NOT NULL,
  `place` POINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `link_uri` (`link_uri` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_ip2c`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_ip2c` ;

CREATE TABLE IF NOT EXISTS `njv_ip2c` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `begin_ip` VARCHAR(45) NOT NULL,
  `end_ip` VARCHAR(45) NOT NULL,
  `begin_ip_num` VARCHAR(45) NOT NULL,
  `end_ip_num` VARCHAR(45) NOT NULL,
  `country_code` CHAR(2) NOT NULL,
  `country_name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_post` ;

CREATE TABLE IF NOT EXISTS `njv_post` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tags_old` TEXT NULL,
  `id_old` INT(11) NULL,
  `category_id_old` INT(11) NULL,
  `category_id` INT(11) NULL,
  `id_video` VARCHAR(45) NULL DEFAULT NULL,
  `type_video` CHAR(1) NULL DEFAULT NULL,
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
  `display` TINYINT(2) NULL DEFAULT 1,
  `view_index` TINYINT(2) NOT NULL DEFAULT 0,
  `twitter` TINYINT(2) NULL,
  `america` TINYINT(2) NULL DEFAULT 0,
  `frecuencia` TINYINT(2) NULL DEFAULT 0,
  `is_recommended` TINYINT(1) NULL DEFAULT 0,
  `status` CHAR(3) NOT NULL DEFAULT 'act',
  `has_gallery` TINYINT(1) NULL,
  `total_read` INT NULL DEFAULT 0,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_publish_njv_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_njv_publish_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_post_featured`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_post_featured` ;

CREATE TABLE IF NOT EXISTS `njv_post_featured` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_id` INT(11) NOT NULL,
  `title` VARCHAR(150) NULL,
  `image` VARCHAR(50) NOT NULL,
  `type` CHAR(3) NOT NULL COMMENT 'va haber tres tipos super destacado(S), destacado normal(N), y  destacado a una categoria o subcategoria(N).Ademas solo puede haber un super destacado por noticia.',
  `post_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `expired_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_publish_featured_njv_publish1_idx` (`post_id` ASC),
  CONSTRAINT `fk_njv_publish_featured_njv_publish1`
    FOREIGN KEY (`post_id`)
    REFERENCES `njv_post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_post_tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_post_tag` ;

CREATE TABLE IF NOT EXISTS `njv_post_tag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `post_id` INT(11) NOT NULL,
  `tag_id` INT(11) NOT NULL,
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_news_tag_njv_news1_idx` (`post_id` ASC),
  INDEX `fk_njv_news_tag_njv_tag1_idx` (`tag_id` ASC),
  CONSTRAINT `fk_njv_news_tag_njv_news1`
    FOREIGN KEY (`post_id`)
    REFERENCES `njv_post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_njv_news_tag_njv_tag1`
    FOREIGN KEY (`tag_id`)
    REFERENCES `njv_tag` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_province`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_province` ;

CREATE TABLE IF NOT EXISTS `njv_province` (
  `id` CHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `department_id` CHAR(4) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  `province` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL DEFAULT NULL,
  `status` CHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_post_multimedia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_post_multimedia` ;

CREATE TABLE IF NOT EXISTS `njv_post_multimedia` (
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
    REFERENCES `njv_post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_search`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_search` ;

CREATE TABLE IF NOT EXISTS `njv_search` (
  `post_id` INT(11) NOT NULL,
  `tag` VARCHAR(255) NOT NULL,
  `category` VARCHAR(255) NULL,
  `title` VARCHAR(255) NULL,
  `summary` TEXT NULL,
  `content` TEXT NULL,
  `type` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_sys_variable`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_sys_variable` ;

CREATE TABLE IF NOT EXISTS `njv_sys_variable` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `attribute` VARCHAR(45) NOT NULL,
  `value` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `attribute_UNIQUE` (`attribute` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_theme_day`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_theme_day` ;

CREATE TABLE IF NOT EXISTS `njv_theme_day` (
  `id` INT(11) NULL AUTO_INCREMENT,
  `category_id` INT(11) NOT NULL,
  `user_id` INT(11) NULL,
  `name` VARCHAR(55) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `color` VARCHAR(45) NULL DEFAULT NULL,
  `params` VARCHAR(255) NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC),
  INDEX `fk_njv_theme_day_njv_category1_idx` (`category_id` ASC),
  UNIQUE INDEX `slug_UNIQUE` (`slug` ASC),
  CONSTRAINT `fk_njv_theme_day_njv_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `njv_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_theme_day_section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_theme_day_section` ;

CREATE TABLE IF NOT EXISTS `njv_theme_day_section` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `theme_day_id` INT(11) NOT NULL,
  `category_id` INT(11) NOT NULL,
  `updated_at` DATETIME NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `njv_theme_day_sectioncol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_njv_theme_day_section_njv_theme_day1_idx` (`theme_day_id` ASC),
  CONSTRAINT `fk_njv_theme_day_section_njv_theme_day1`
    FOREIGN KEY (`theme_day_id`)
    REFERENCES `njv_theme_day` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_user_activity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_user_activity` ;

CREATE TABLE IF NOT EXISTS `njv_user_activity` (
  `id` INT(21) NOT NULL AUTO_INCREMENT,
  `user_id` INT(21) NOT NULL DEFAULT '0',
  `description` VARCHAR(255) NOT NULL,
  `type` ENUM('creacion','eliminar','error','login') NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `type` (`type` ASC),
  INDEX `created_at` (`created_at` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `njv_user_profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `njv_user_profile` ;

CREATE TABLE IF NOT EXISTS `njv_user_profile` (
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
  INDEX `fk_njv_user_profile_njv_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_njv_user_profile_njv_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `njv_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;