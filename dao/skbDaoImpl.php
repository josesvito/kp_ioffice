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
class SKBDaoImpl {

    function addSKB(AktivitasSKB $SKB) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();

            $query = "INSERT INTO aktivitas_skb (nama_aktivitas) VALUES(?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $SKB->getNama_aktivitas(), PDO::PARAM_STR);
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

    function updateSKB(AktivitasSKB $SKB) {
        $link = PDOUtil::createPDOConnection();
        // 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "UPDATE aktivitas_skb SET nama_aktivitas=? WHERE id_aktivitas=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $SKB->getNama_aktivitas(), PDO::PARAM_STR);
            $stmt->bindValue(2, $SKB->getId_aktivitas(), PDO::PARAM_INT);
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

    function showAllSKB() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM aktivitas_skb ";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'AktivitasSKB');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function getOneSKB(AktivitasSKB $id) {
        $link = PDOUtil::createPDOConnection();

        try {
            $query = 'SELECT * FROM aktivitas_skb WHERE id_aktivitas = ?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $id->getId_aktivitas(), PDO::PARAM_INT);
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
