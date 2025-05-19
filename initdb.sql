-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `email_verified_at` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `rol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`document_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`document_types` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`employees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`employees` (
  `id` INT NOT NULL,
  `identification` VARCHAR(45) NULL,
  `name` VARCHAR(45) NULL,
  `document_type_id` VARCHAR(45) NULL,
  `cellphone` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  `status` TINYINT NULL,
  `document_types_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_employees_document_types1_idx` (`document_types_id` ASC) VISIBLE,
  INDEX `fk_employees_users1_idx` (`users_id` ASC) VISIBLE,
  CONSTRAINT `fk_employees_document_types1`
    FOREIGN KEY (`document_types_id`)
    REFERENCES `mydb`.`document_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employees_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`neighborhood`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`neighborhood` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`stores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`stores` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  `name_charge` VARCHAR(45) NULL,
  `phone_1` VARCHAR(45) NULL,
  `phone_2` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `latitud` VARCHAR(45) NULL,
  `longitud` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  `descripcion` TEXT NULL,
  `neihgborhood_id1` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_stores_neihgborhood1_idx` (`neihgborhood_id1` ASC) VISIBLE,
  CONSTRAINT `fk_stores_neihgborhood1`
    FOREIGN KEY (`neihgborhood_id1`)
    REFERENCES `mydb`.`neighborhood` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`routes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`routes` (
  `id` INT NOT NULL,
  `name` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`route_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`route_detail` (
  `id` INT NOT NULL,
  `year` VARCHAR(45) NULL,
  `day_week` VARCHAR(45) NULL,
  `month` VARCHAR(45) NULL,
  `routes_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_route_detail_routes1_idx` (`routes_id` ASC) VISIBLE,
  CONSTRAINT `fk_route_detail_routes1`
    FOREIGN KEY (`routes_id`)
    REFERENCES `mydb`.`routes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`route_details_stores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`route_details_stores` (
  `id` INT NOT NULL,
  `stores_id` INT NOT NULL,
  `route_detail_id` INT NOT NULL,
  `visit_date` DATE NULL,
  `visit_status` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `real_visit_date` VARCHAR(45) NULL,
  `longitud` VARCHAR(45) NULL,
  `latitud` VARCHAR(45) NULL,
  `employees_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_route_details_stores_stores1_idx` (`stores_id` ASC) VISIBLE,
  INDEX `fk_route_details_stores_route_detail1_idx` (`route_detail_id` ASC) VISIBLE,
  INDEX `fk_route_details_stores_employees1_idx` (`employees_id` ASC) VISIBLE,
  CONSTRAINT `fk_route_details_stores_stores1`
    FOREIGN KEY (`stores_id`)
    REFERENCES `mydb`.`stores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_route_details_stores_route_detail1`
    FOREIGN KEY (`route_detail_id`)
    REFERENCES `mydb`.`route_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_route_details_stores_employees1`
    FOREIGN KEY (`employees_id`)
    REFERENCES `mydb`.`employees` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`location_history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`location_history` (
  `id` INT NOT NULL,
  `latitud` VARCHAR(45) NULL,
  `longitud` VARCHAR(45) NULL,
  `visit_date` TIMESTAMP NULL,
  `location_historycol` INT NULL,
  `route_details_stores_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_location_history_route_details_stores1_idx` (`route_details_stores_id` ASC) VISIBLE,
  CONSTRAINT `fk_location_history_route_details_stores1`
    FOREIGN KEY (`route_details_stores_id`)
    REFERENCES `mydb`.`route_details_stores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
