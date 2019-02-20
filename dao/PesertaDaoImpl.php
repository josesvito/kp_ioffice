<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PesertaDaoImpl
 *
 * @author master
 */
class PesertaDaoImpl {

    function addPeserta(Peserta $peserta) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();

            $query = "INSERT INTO peserta (no_induk_peserta, nama_peserta, email_peserta, no_telepon) VALUES(?, ?, ?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $peserta->getNo_induk_peserta(), PDO::PARAM_STR);
            $stmt->bindValue(2, $peserta->getNama_peserta(), PDO::PARAM_STR);
            $stmt->bindValue(3, $peserta->getEmail_peserta(), PDO::PARAM_STR);
            $stmt->bindValue(4, $peserta->getNo_telepon(), PDO::PARAM_STR);
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

    function updatePeserta(Peserta $peserta) {
        $link = PDOUtil::createPDOConnection();
        // 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "UPDATE peserta SET nama_peserta=?, email_peserta=?, no_telepon=? WHERE no_induk_peserta=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $peserta->getName(), PDO::PARAM_STR);
            $stmt->bindValue(2, $peserta->getEmail_peserta(), PDO::PARAM_STR);
            $stmt->bindValue(3, $peserta->getNo_telepon(), PDO::PARAM_STR);
            $stmt->bindValue(4, $peserta->getNo_induk_peserta(), PDO::PARAM_STR);
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

    function deletePeserta(Peserta $peserta) {
        $link = PDOUtil::createPDOConnection();
        // 2. query delete
        try {
            $link->beginTransaction();
            $query = "DELETE FROM Peserta WHERE no_induk_peserta=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $peserta->getNo_induk_peserta(), PDO::PARAM_STR);
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

    function showAllPeserta() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM peserta";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Peserta');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function getOnePeserta($id) {
        $link = PDOUtil::createPDOConnection();

        try {
            $query = 'SELECT * FROM peserta WHERE id_peserta = ?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
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
