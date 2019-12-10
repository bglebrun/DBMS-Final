-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_s1751256_f19
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_s1751256_f19
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_s1751256_f19` DEFAULT CHARACTER SET utf8 ;
USE `db_s1751256_f19` ;

-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`Professors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`Professors` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`Professors` (
  `ProfessorID` INT NOT NULL AUTO_INCREMENT,
  `FName` VARCHAR(20) NOT NULL,
  `LName` VARCHAR(20) NOT NULL,
  `Department` INT NOT NULL,
  `Phone` VARCHAR(11) NULL,
  `email` VARCHAR(60) NULL,
  PRIMARY KEY (`ProfessorID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`Prefixes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`Prefixes` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`Prefixes` (
  `PrefixID` INT NOT NULL AUTO_INCREMENT,
  `Prefix` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`PrefixID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`Buildings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`Buildings` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`Buildings` (
  `BuildingID` INT NOT NULL AUTO_INCREMENT,
  `BuildingName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`BuildingID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`ClassRooms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`ClassRooms` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`ClassRooms` (
  `RoomID` INT NOT NULL AUTO_INCREMENT,
  `Building` INT NOT NULL,
  `RoomNumber` INT NOT NULL,
  `Capacity` INT NOT NULL,
  PRIMARY KEY (`RoomID`),
  INDEX `RoomBuilding_idx` (`Building` ASC),
  CONSTRAINT `RoomBuilding`
    FOREIGN KEY (`Building`)
    REFERENCES `db_s1751256_f19`.`Buildings` (`BuildingID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`Courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`Courses` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`Courses` (
  `CourseID` INT NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(45) NOT NULL,
  `Description` VARCHAR(500) NOT NULL,
  `CourseNumber` INT NOT NULL,
  `Prefix` INT NULL,
  `ClassRoom` INT NULL,
  `Instructor` INT NULL,
  PRIMARY KEY (`CourseID`),
  INDEX `CourseInstructor_idx` (`Instructor` ASC),
  INDEX `CoursePrefix_idx` (`Prefix` ASC),
  INDEX `CourseRoom_idx` (`ClassRoom` ASC),
  CONSTRAINT `CourseInstructor`
    FOREIGN KEY (`Instructor`)
    REFERENCES `db_s1751256_f19`.`Professors` (`ProfessorID`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `CoursePrefix`
    FOREIGN KEY (`Prefix`)
    REFERENCES `db_s1751256_f19`.`Prefixes` (`PrefixID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `CourseRoom`
    FOREIGN KEY (`ClassRoom`)
    REFERENCES `db_s1751256_f19`.`ClassRooms` (`RoomID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`ClassLevels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`ClassLevels` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`ClassLevels` (
  `LevelID` INT NOT NULL AUTO_INCREMENT,
  `Level` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`LevelID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`Departments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`Departments` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`Departments` (
  `DepartmentID` INT NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(45) NOT NULL,
  `Prefix` INT NULL,
  `DepartmentHead` INT NULL,
  `Description` VARCHAR(500) NULL,
  PRIMARY KEY (`DepartmentID`),
  INDEX `DeptHead_idx` (`DepartmentHead` ASC),
  INDEX `DeptPrefix_idx` (`Prefix` ASC),
  CONSTRAINT `DeptHead`
    FOREIGN KEY (`DepartmentHead`)
    REFERENCES `db_s1751256_f19`.`Professors` (`ProfessorID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `DeptPrefix`
    FOREIGN KEY (`Prefix`)
    REFERENCES `db_s1751256_f19`.`Prefixes` (`PrefixID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`Students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`Students` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`Students` (
  `StudentID` INT NOT NULL AUTO_INCREMENT,
  `FName` VARCHAR(20) NOT NULL,
  `LName` VARCHAR(20) NOT NULL,
  `email` VARCHAR(60) NULL,
  `ClassLevel` INT NOT NULL DEFAULT 1,
  `GPA` DECIMAL(3) NULL,
  `EmergencyContact` VARCHAR(11) NULL,
  PRIMARY KEY (`StudentID`),
  INDEX `StudentLevel_idx` (`ClassLevel` ASC),
  CONSTRAINT `StudentLevel`
    FOREIGN KEY (`ClassLevel`)
    REFERENCES `db_s1751256_f19`.`ClassLevels` (`LevelID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_s1751256_f19`.`StudentCourses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_s1751256_f19`.`StudentCourses` ;

CREATE TABLE IF NOT EXISTS `db_s1751256_f19`.`StudentCourses` (
  `StudentID` INT NOT NULL,
  `CourseID` INT NOT NULL,
  PRIMARY KEY (`StudentID`, `CourseID`),
  INDEX `StudentClassClassID_idx` (`CourseID` ASC),
  CONSTRAINT `StudentClassStuID`
    FOREIGN KEY (`StudentID`)
    REFERENCES `db_s1751256_f19`.`Students` (`StudentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `StudentClassClassID`
    FOREIGN KEY (`CourseID`)
    REFERENCES `db_s1751256_f19`.`Courses` (`CourseID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `db_s1751256_f19`;

DELIMITER $$

USE `db_s1751256_f19`$$
DROP TRIGGER IF EXISTS `db_s1751256_f19`.`Professors_BEFORE_INSERT` $$
USE `db_s1751256_f19`$$
CREATE DEFINER = CURRENT_USER TRIGGER `db_s1751256_f19`.`Professors_BEFORE_INSERT` BEFORE INSERT ON `Professors` FOR EACH ROW
BEGIN
	SET NEW.email = CONCAT_WS(NEW.FName, NEW.LName, "@myuniprofs.edu");
END$$


USE `db_s1751256_f19`$$
DROP TRIGGER IF EXISTS `db_s1751256_f19`.`Students_BEFORE_INSERT` $$
USE `db_s1751256_f19`$$
CREATE DEFINER = CURRENT_USER TRIGGER `db_s1751256_f19`.`Students_BEFORE_INSERT` BEFORE INSERT ON `Students` FOR EACH ROW
BEGIN
	SET NEW.email = CONCAT_WS( NEW.FName, NEW.LName, "@myuni.edu");
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
