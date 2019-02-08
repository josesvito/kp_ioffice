<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MitraDaoImpl
 *
 * @author master
 */
class KategoriMitraDaoImpl {

    function addNewKategori(KategoriMitra $mitra) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();

            $query = "INSERT INTO kategori_mitra (nama) VALUES(?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $mitra->getNama(), PDO::PARAM_STR);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function showAllKategoriMitra() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM kategori_mitra ORDER BY id_kategori_mitra ASC";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'KategoriMitra');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function getOneKategoriMitra(KategoriMitra $id) {
        $link = PDOUtil::createPDOConnection();

        try {
            $query = 'SELECT * FROM kategori_mitra WHERE id_kategori_mitra = ?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $id->getId_kategori_mitra(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'KategoriMitra');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);

        return $stmt;
    }

}
