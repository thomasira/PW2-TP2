-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Table `pw2_tp2`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp2_category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stamp`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp2_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stamp`.`aspect`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp2_aspect` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aspect` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stamp`.`stamp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp2_stamp` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  `origin` VARCHAR(45) NULL,
  `year` SMALLINT NULL,
  `user_id` INT NOT NULL,
  `aspect_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_stamp_user_idx` (`user_id` ASC),
  INDEX `fk_stamp_aspect1_idx` (`aspect_id` ASC),
  CONSTRAINT `fk_stamp_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `e2395387`.`pw2tp2_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stamp_aspect1`
    FOREIGN KEY (`aspect_id`)
    REFERENCES `e2395387`.`pw2tp2_aspect` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `stamp`.`stamp_has_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e2395387`.`pw2tp2_stamp_category` (
  `stamp_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`stamp_id`, `category_id`),
  INDEX `fk_stamp_has_category_category1_idx` (`category_id` ASC),
  INDEX `fk_stamp_has_category_stamp1_idx` (`stamp_id` ASC),
  CONSTRAINT `fk_stamp_has_category_stamp1`
    FOREIGN KEY (`stamp_id`)
    REFERENCES `e2395387`.`pw2tp2_stamp` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stamp_has_category_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `e2395387`.`pw2tp2_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
