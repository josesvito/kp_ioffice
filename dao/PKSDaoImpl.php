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
class PKSDaoImpl {

    function addPKS(AktivitasPKS $PKS) {
        $link = PDOUtil::createPDOConnection();
        try {
            $link->beginTransaction();

            $query = "INSERT INTO aktivitas_pks (nama_aktivitas, Aktivitas_SKB_id_aktivitas) VALUES(?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $PKS->getNama_aktivitas(), PDO::PARAM_STR);
            $stmt->bindValue(2, $PKS->getAktivitas_SKB_id_aktivitas(), PDO::PARAM_INT);
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

    function updatePKS(AktivitasPKS $PKS) {
        $link = PDOUtil::createPDOConnection();
        // 3. insert to DB
        try {
            $link->beginTransaction();
            $query = "UPDATE aktivitas_pks SET nama_aktivitas=?, Aktivitas_SKB_id_aktivitas=? WHERE id_aktivitas=?";
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $PKS->getNama_aktivitas(), PDO::PARAM_STR);
            $stmt->bindValue(2, $PKS->getAktivitas_SKB_id_aktivitas(), PDO::PARAM_INT);
            $stmt->bindValue(3, $PKS->getId_aktivitas(), PDO::PARAM_INT);
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

    function showAllPKS() {
        $link = PDOUtil::createPDOConnection();
        try {
            $query = "SELECT * FROM aktivitas_pks ";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'AktivitasPKS');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closePDOConnection($link);
        return $stmt;
    }

    function getOnePKS(AktivitasPKS $id) {
        $link = PDOUtil::createPDOConnection();

        try {
            $query = 'SELECT * FROM aktivitas_pks WHERE id_aktivitas = ?';
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
