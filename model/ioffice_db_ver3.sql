-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ioffice_db2019
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ioffice_db2019` ;

-- -----------------------------------------------------
-- Schema ioffice_db2019
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ioffice_db2019` DEFAULT CHARACTER SET utf8 ;
USE `ioffice_db2019` ;

-- -----------------------------------------------------
-- Table `ioffice_db2019`.`kategori_mitra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`kategori_mitra` (
  `id_kategori_mitra` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_kategori_mitra`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ioffice_db2019`.`Mitra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`Mitra` (
  `id_mitra` INT NOT NULL AUTO_INCREMENT,
  `nama_mitra` VARCHAR(45) NOT NULL,
  `kategori_mitra_id` INT NOT NULL,
  `tanggal_awal` DATE NOT NULL,
  `tanggal_akhir` DATE NOT NULL,
  `manfaat` VARCHAR(300) NOT NULL,
  `jumlah_aktivitas` INT NULL,
  `aktivitas_yang_dilakukan` VARCHAR(300) NULL,
  PRIMARY KEY (`id_mitra`),
  INDEX `fk_Mitra_kategori_mitra1_idx` (`kategori_mitra_id` ASC),
  CONSTRAINT `fk_Mitra_kategori_mitra1`
    FOREIGN KEY (`kategori_mitra_id`)
    REFERENCES `ioffice_db2019`.`kategori_mitra` (`id_kategori_mitra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ioffice_db2019`.`Aktivitas_SKB`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`Aktivitas_SKB` (
  `id_aktivitas` INT NOT NULL AUTO_INCREMENT,
  `nama_aktivitas` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_aktivitas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ioffice_db2019`.`Dokumen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`Dokumen` (
  `no_dokumen` VARCHAR(50) NOT NULL,
  `nama_dokumen` VARCHAR(45) NOT NULL,
  `jenis_dokumen` VARCHAR(45) NOT NULL,
  `deskripsi_dokumen` VARCHAR(200) NOT NULL,
  `link_dokumen` VARCHAR(45) NULL,
  PRIMARY KEY (`no_dokumen`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ioffice_db2019`.`Aktivitas_PKS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`Aktivitas_PKS` (
  `id_aktivitas` INT NOT NULL AUTO_INCREMENT,
  `nama_aktivitas` VARCHAR(45) NOT NULL,
  `Aktivitas_SKB_id_aktivitas` INT NOT NULL,
  PRIMARY KEY (`id_aktivitas`),
  INDEX `fk_Aktivitas_PKS_Aktivitas_SKB1_idx` (`Aktivitas_SKB_id_aktivitas` ASC),
  CONSTRAINT `fk_Aktivitas_PKS_Aktivitas_SKB1`
    FOREIGN KEY (`Aktivitas_SKB_id_aktivitas`)
    REFERENCES `ioffice_db2019`.`Aktivitas_SKB` (`id_aktivitas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ioffice_db2019`.`Perjanjian`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`Perjanjian` (
  `id_perjanjian` INT NOT NULL AUTO_INCREMENT,
  `Mitra_id_mitra` INT NOT NULL,
  `pihak_1` VARCHAR(45) NOT NULL,
  `pihak_2` VARCHAR(45) NOT NULL,
  `tanggal_awal` DATE NOT NULL,
  `tanggal_akhir` DATE NOT NULL,
  `status` TINYINT NOT NULL,
  `Dokumen_no_dokumen` VARCHAR(50) NOT NULL,
  `Aktivitas_id_aktivitas` INT NULL,
  `Aktivitas_PKS_id_aktivitas` INT NULL,
  PRIMARY KEY (`id_perjanjian`),
  INDEX `fk_Perjanjian_Mitra1_idx` (`Mitra_id_mitra` ASC),
  INDEX `fk_Perjanjian_Aktivitas1_idx` (`Aktivitas_id_aktivitas` ASC),
  INDEX `fk_Perjanjian_Dokumen1_idx` (`Dokumen_no_dokumen` ASC),
  INDEX `fk_Perjanjian_Aktivitas_PKS1_idx` (`Aktivitas_PKS_id_aktivitas` ASC),
  CONSTRAINT `fk_Perjanjian_Mitra1`
    FOREIGN KEY (`Mitra_id_mitra`)
    REFERENCES `ioffice_db2019`.`Mitra` (`id_mitra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Perjanjian_Aktivitas1`
    FOREIGN KEY (`Aktivitas_id_aktivitas`)
    REFERENCES `ioffice_db2019`.`Aktivitas_SKB` (`id_aktivitas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Perjanjian_Dokumen1`
    FOREIGN KEY (`Dokumen_no_dokumen`)
    REFERENCES `ioffice_db2019`.`Dokumen` (`no_dokumen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Perjanjian_Aktivitas_PKS1`
    FOREIGN KEY (`Aktivitas_PKS_id_aktivitas`)
    REFERENCES `ioffice_db2019`.`Aktivitas_PKS` (`id_aktivitas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ioffice_db2019`.`Peserta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`Peserta` (
  `no_induk_peserta` VARCHAR(45) NOT NULL,
  `nama_peserta` VARCHAR(45) NOT NULL,
  `email_peserta` VARCHAR(45) NOT NULL,
  `no_telepon` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`no_induk_peserta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ioffice_db2019`.`Aktivitas_PKS_has_Peserta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ioffice_db2019`.`Aktivitas_PKS_has_Peserta` (
  `Aktivitas_PKS_id_aktivitas` INT NOT NULL,
  `Peserta_no_induk_peserta` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Aktivitas_PKS_id_aktivitas`, `Peserta_no_induk_peserta`),
  INDEX `fk_Aktivitas_PKS_has_Peserta_Peserta1_idx` (`Peserta_no_induk_peserta` ASC),
  INDEX `fk_Aktivitas_PKS_has_Peserta_Aktivitas_PKS1_idx` (`Aktivitas_PKS_id_aktivitas` ASC),
  CONSTRAINT `fk_Aktivitas_PKS_has_Peserta_Aktivitas_PKS1`
    FOREIGN KEY (`Aktivitas_PKS_id_aktivitas`)
    REFERENCES `ioffice_db2019`.`Aktivitas_PKS` (`id_aktivitas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aktivitas_PKS_has_Peserta_Peserta1`
    FOREIGN KEY (`Peserta_no_induk_peserta`)
    REFERENCES `ioffice_db2019`.`Peserta` (`no_induk_peserta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
