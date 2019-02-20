<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DokumenDaoImpl
 *
 * @author master
 */
class DokumenDaoImpl {

    function addDokumen(Dokumen $dokumen) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();

            $query = "INSERT INTO Dokumen (no_dokumen, nama_dokumen, jenis_dokumen, deskripsi_dokumen, link_dokumen) VALUES(?, ?, ?, ?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $dokumen->getNo_dokumen(), PDO::PARAM_STR);
            $stmt->bindValue(2, $dokumen->getNama_dokumen(), PDO::PARAM_STR);
            $stmt->bindValue(3, $dokumen->getJenis_dokumen(), PDO::PARAM_STR);
            $stmt->bindValue(4, $dokumen->getDeskripsi_dokumen(), PDO::PARAM_STR);
            $stmt->bindValue(5, $dokumen->getLink_dokumen(), PDO::PARAM_STR);
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

    function showAllDokumen() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM dokumen";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Dokumen');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function getOneDokumen(Dokumen $dokumen) {
        $link = PDOUtil::createPDOConnection();

        try {
            $query = 'SELECT * FROM dokumen WHERE no_dokumen = ?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $dokumen->getNo_dokumen(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);

        return $stmt;
    }

}
