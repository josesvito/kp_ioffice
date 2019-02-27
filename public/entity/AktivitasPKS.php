<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AktivitasPKS
 *
 * @author master
 */
class AktivitasPKS {

    private $id_aktivitas;
    private $nama_aktivitas;
    private $Aktivitas_SKB_id_aktivitas;

    public function getId_aktivitas() {
        return $this->id_aktivitas;
    }

    public function getNama_aktivitas() {
        return $this->nama_aktivitas;
    }

    public function getAktivitas_SKB_id_aktivitas() {
        return $this->Aktivitas_SKB_id_aktivitas;
    }

    public function setId_aktivitas($id_aktivitas) {
        $this->id_aktivitas = $id_aktivitas;
    }

    public function setNama_aktivitas($nama_aktivitas) {
        $this->nama_aktivitas = $nama_aktivitas;
    }

    public function setAktivitas_SKB_id_aktivitas($Aktivitas_SKB_id_aktivitas) {
        $this->Aktivitas_SKB_id_aktivitas = $Aktivitas_SKB_id_aktivitas;
    }

    public function __set($name, $value) {
        if (!isset($this->Aktivitas_SKB_id_aktivitas)) {
            $this->Aktivitas_SKB_id_aktivitas = new AktivitasSKB();
        }
        if (isset($value)) {
            switch ($name) {
                case 'skb_id':
                    $this->Aktivitas_SKB_id_aktivitas->setId_aktivitas($value);
                case 'skb_name':
                    $this->Aktivitas_SKB_id_aktivitas->setNama_aktivitas($value);
                default:
                    break;
            }
        }
    }

}
