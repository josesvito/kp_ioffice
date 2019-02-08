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
        $msg = 'gagal';
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();

            $query = "INSERT INTO mitra (name) VALUES(?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $mitra->getName(), PDO::PARAM_STR);
            $stmt->execute();
            $msg = 'sukses';
            $link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $msg;
    }

    function updateMitra(Mitra $mitra) {
        $link = PDOUtil::createPDOConnection();
        // 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "UPDATE genre SET name=? WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $mitra->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $mitra->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
    }

    function deleteMitra($id) {
        $link = PDOUtil::createPDOConnection();
        // 2. query delete
        try {
            $link->beginTransaction();
            $query = "DELETE FROM Mitra WHERE id=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $hasil = $stmt->execute();
            if ($hasil == FALSE) {
                $msg = 'Data genre tidak dapat dihapus.';
            } else {
                $link->commit();
                $msg = 'Data genre berhasil dihapus.';
            }
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $hasil;
    }

    function showAllJenisMitra() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM jenis_mitra ORDER BY id_jenis_mitra ASC";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'JenisMitra');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function getOneJenisMitra($id) {
        $link = PDOUtil::createPDOConnection();

        try {
            $query = 'SELECT * FROM jenis_mitra WHERE id_jenis_mitra = ?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'JenisMitra');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);

        return $stmt;
    }

}
