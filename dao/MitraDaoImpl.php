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
class MitraDaoImpl {

    function addMitra(Mitra $mitra) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();
            $query = "INSERT INTO mitra (id_mitra, nama_mitra, kategori_mitra_id, tanggal_awal, tanggal_akhir, manfaat, jumlah_aktivitas, aktivitas_yang_dilakukan) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $mitra->getId_mitra(), PDO::PARAM_INT);
            $stmt->bindValue(2, $mitra->getNama_mitra(), PDO::PARAM_STR);
            $stmt->bindValue(3, $mitra->getKategori_mitra()->getId_kategori_mitra(), PDO::PARAM_INT);
            $stmt->bindValue(4, $mitra->getTanggal_awal(), PDO::PARAM_STR);
            $stmt->bindValue(5, $mitra->getTanggal_akhir(), PDO::PARAM_STR);
            $stmt->bindValue(6, $mitra->getManfaat(), PDO::PARAM_STR);
            $stmt->bindValue(7, $mitra->getJumlah_aktivitas(), PDO::PARAM_INT);
            $stmt->bindValue(8, $mitra->getAktivitas_yang_dilakukan(), PDO::PARAM_STR);
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

    function updateMitra(Mitra $mitra) {
        $link = PDOUtil::createPDOConnection();
        // 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "UPDATE genre SET nama_mitra=?, kategori_mitra_id=?, tanggal_awal=?, tanggal_akhir=?, manfaat=?, jumlah_aktivitas=?, aktivitas_yang_dilakukan=? WHERE id_mitra=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $mitra->getNama_mitra(), PDO::PARAM_STR);
            $stmt->bindValue(2, $mitra->getKategori_mitra()->getId_kategori_mitra(), PDO::PARAM_INT);
            $stmt->bindValue(3, $mitra->getTanggal_awal(), PDO::PARAM_STR);
            $stmt->bindValue(4, $mitra->getTanggal_akhir(), PDO::PARAM_STR);
            $stmt->bindValue(5, $mitra->getManfaat(), PDO::PARAM_STR);
            $stmt->bindValue(6, $mitra->getJumlah_aktivitas(), PDO::PARAM_INT);
            $stmt->bindValue(7, $mitra->getAktivitas_yang_dilakukan(), PDO::PARAM_STR);
            $stmt->bindValue(8, $mitra->getId_mitra(), PDO::PARAM_INT);
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

    function showAllMitra() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM mitra ORDER BY tanggal_awal DESC";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Mitra');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function getOneMitra(Mitra $mitra) {
        $link = PDOUtil::createPDOConnection();

        try {
            $query = 'SELECT * FROM mitra WHERE id_mitra = ?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $mitra->getId_mitra(), PDO::PARAM_INT);
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
