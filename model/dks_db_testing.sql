-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dks_db2019
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `dks_db2019` ;

-- -----------------------------------------------------
-- Schema dks_db2019
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dks_db2019` DEFAULT CHARACTER SET utf8 ;
USE `dks_db2019` ;

-- -----------------------------------------------------
-- Table `dks_db2019`.`kategori_mitra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`kategori_mitra` (
  `id_kategori_mitra` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_kategori_mitra`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`Mitra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`Mitra` (
  `id_mitra` INT NOT NULL AUTO_INCREMENT,
  `nama_mitra` VARCHAR(45) NOT NULL,
  `kategori_mitra_id` INT NOT NULL,
  `tanggal_inisiasi` DATE NOT NULL,
  `tanggal_akhir` DATE NOT NULL,
  `manfaat` VARCHAR(300) NOT NULL,
  `jumlah_aktivitas` INT NULL,
  `aktivitas_yang_dilakukan` VARCHAR(300) NULL,
  `negara` VARCHAR(45) NULL,
  `provinsi` VARCHAR(45) NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_mitra`),
  INDEX `fk_Mitra_kategori_mitra1_idx` (`kategori_mitra_id` ASC),
  CONSTRAINT `fk_Mitra_kategori_mitra1`
    FOREIGN KEY (`kategori_mitra_id`)
    REFERENCES `dks_db2019`.`kategori_mitra` (`id_kategori_mitra`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`Aktivitas_SKB`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`Aktivitas_SKB` (
  `id_aktivitas` INT NOT NULL AUTO_INCREMENT,
  `nama_aktivitas` VARCHAR(45) NOT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_aktivitas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`user` (
  `id` VARCHAR(7) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`faculty`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`faculty` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `user_id` VARCHAR(7) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_faculty_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_faculty_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dks_db2019`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`Dokumen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`Dokumen` (
  `no_dokumen` VARCHAR(50) NOT NULL,
  `judul_dokumen` VARCHAR(45) NOT NULL,
  `jenis_dokumen` VARCHAR(45) NOT NULL,
  `deskripsi_dokumen` VARCHAR(200) NOT NULL,
  `link_dokumen` VARCHAR(45) NULL,
  `faculty_id` INT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`no_dokumen`),
  INDEX `fk_Dokumen_faculty1_idx` (`faculty_id` ASC),
  CONSTRAINT `fk_Dokumen_faculty1`
    FOREIGN KEY (`faculty_id`)
    REFERENCES `dks_db2019`.`faculty` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`Aktivitas_PKS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`Aktivitas_PKS` (
  `id_aktivitas` INT NOT NULL AUTO_INCREMENT,
  `nama_aktivitas` VARCHAR(45) NOT NULL,
  `Aktivitas_SKB_id_aktivitas` INT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_aktivitas`),
  INDEX `fk_Aktivitas_PKS_Aktivitas_SKB1_idx` (`Aktivitas_SKB_id_aktivitas` ASC),
  CONSTRAINT `fk_Aktivitas_PKS_Aktivitas_SKB1`
    FOREIGN KEY (`Aktivitas_SKB_id_aktivitas`)
    REFERENCES `dks_db2019`.`Aktivitas_SKB` (`id_aktivitas`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`Perjanjian`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`Perjanjian` (
  `id_perjanjian` INT NOT NULL AUTO_INCREMENT,
  `Mitra_id_mitra` INT NOT NULL,
  `pihak_1` VARCHAR(45) NOT NULL,
  `pihak_2` VARCHAR(45) NOT NULL,
  `pihak_3` VARCHAR(45) NULL,
  `pihak_4` VARCHAR(45) NULL,
  `tanggal_awal` DATE NOT NULL,
  `tanggal_akhir` DATE NOT NULL,
  `status` TINYINT NOT NULL,
  `Dokumen_no_dokumen` VARCHAR(50) NOT NULL,
  `Aktivitas_SKB_id_aktivitas` INT NULL,
  `Aktivitas_PKS_id_aktivitas` INT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_perjanjian`),
  INDEX `fk_Perjanjian_Mitra1_idx` (`Mitra_id_mitra` ASC),
  INDEX `fk_Perjanjian_Aktivitas1_idx` (`Aktivitas_SKB_id_aktivitas` ASC),
  INDEX `fk_Perjanjian_Dokumen1_idx` (`Dokumen_no_dokumen` ASC),
  INDEX `fk_Perjanjian_Aktivitas_PKS1_idx` (`Aktivitas_PKS_id_aktivitas` ASC),
  CONSTRAINT `fk_Perjanjian_Mitra1`
    FOREIGN KEY (`Mitra_id_mitra`)
    REFERENCES `dks_db2019`.`Mitra` (`id_mitra`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Perjanjian_Aktivitas1`
    FOREIGN KEY (`Aktivitas_SKB_id_aktivitas`)
    REFERENCES `dks_db2019`.`Aktivitas_SKB` (`id_aktivitas`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Perjanjian_Dokumen1`
    FOREIGN KEY (`Dokumen_no_dokumen`)
    REFERENCES `dks_db2019`.`Dokumen` (`no_dokumen`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Perjanjian_Aktivitas_PKS1`
    FOREIGN KEY (`Aktivitas_PKS_id_aktivitas`)
    REFERENCES `dks_db2019`.`Aktivitas_PKS` (`id_aktivitas`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`Peserta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`Peserta` (
  `no_induk_peserta` VARCHAR(45) NOT NULL,
  `nama_peserta` VARCHAR(45) NOT NULL,
  `email_peserta` VARCHAR(45) NOT NULL,
  `no_telepon` VARCHAR(45) NOT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`no_induk_peserta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`Aktivitas_PKS_has_Peserta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`Aktivitas_PKS_has_Peserta` (
  `Aktivitas_PKS_id_aktivitas` INT NOT NULL,
  `Peserta_no_induk_peserta` VARCHAR(45) NOT NULL,
  `is_deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`Aktivitas_PKS_id_aktivitas`, `Peserta_no_induk_peserta`),
  INDEX `fk_Aktivitas_PKS_has_Peserta_Peserta1_idx` (`Peserta_no_induk_peserta` ASC),
  INDEX `fk_Aktivitas_PKS_has_Peserta_Aktivitas_PKS1_idx` (`Aktivitas_PKS_id_aktivitas` ASC),
  CONSTRAINT `fk_Aktivitas_PKS_has_Peserta_Aktivitas_PKS1`
    FOREIGN KEY (`Aktivitas_PKS_id_aktivitas`)
    REFERENCES `dks_db2019`.`Aktivitas_PKS` (`id_aktivitas`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Aktivitas_PKS_has_Peserta_Peserta1`
    FOREIGN KEY (`Peserta_no_induk_peserta`)
    REFERENCES `dks_db2019`.`Peserta` (`no_induk_peserta`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dks_db2019`.`log_history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dks_db2019`.`log_history` (
  `user_id` VARCHAR(7) NOT NULL,
  `action` VARCHAR(200) NOT NULL,
  `time` TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  INDEX `fk_log_history_user1_idx` (`user_id` ASC),
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_log_history_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `dks_db2019`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
