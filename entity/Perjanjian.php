<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Perjanjian
 *
 * @author master
 */
class Perjanjian {

    private $id_perjanjian;
    private $Mitra_id_mitra;
    private $pihak_1;
    private $pihak_2;
    private $tanggal_awal;
    private $tanggal_akhir;
    private $status;
    private $Dokumen_no_dokumen;
    private $Aktivitas_id_aktivitas;
    private $Aktivitas_PKS_id_aktivitas;

    public function __construct($id_perjanjian, $Mitra_id_mitra, $pihak_1, $pihak_2, $tanggal_awal, $tanggal_akhir, $status, $Dokumen_no_dokumen, $Aktivitas_id_aktivitas, $Aktivitas_PKS_id_aktivitas) {
        $this->id_perjanjian = $id_perjanjian;
        $this->Mitra_id_mitra = $Mitra_id_mitra;
        $this->pihak_1 = $pihak_1;
        $this->pihak_2 = $pihak_2;
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->status = $status;
        $this->Dokumen_no_dokumen = $Dokumen_no_dokumen;
        $this->Aktivitas_id_aktivitas = $Aktivitas_id_aktivitas;
        $this->Aktivitas_PKS_id_aktivitas = $Aktivitas_PKS_id_aktivitas;
    }

    public function getId_perjanjian() {
        return $this->id_perjanjian;
    }

    public function getMitra_id_mitra() {
        return $this->Mitra_id_mitra;
    }

    public function getPihak_1() {
        return $this->pihak_1;
    }

    public function getPihak_2() {
        return $this->pihak_2;
    }

    public function getTanggal_awal() {
        return $this->tanggal_awal;
    }

    public function getTanggal_akhir() {
        return $this->tanggal_akhir;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDokumen_no_dokumen() {
        return $this->Dokumen_no_dokumen;
    }

    public function getAktivitas_id_aktivitas() {
        return $this->Aktivitas_id_aktivitas;
    }

    public function getAktivitas_PKS_id_aktivitas() {
        return $this->Aktivitas_PKS_id_aktivitas;
    }

    public function setId_perjanjian($id_perjanjian) {
        $this->id_perjanjian = $id_perjanjian;
    }

    public function setMitra_id_mitra($Mitra_id_mitra) {
        $this->Mitra_id_mitra = $Mitra_id_mitra;
    }

    public function setPihak_1($pihak_1) {
        $this->pihak_1 = $pihak_1;
    }

    public function setPihak_2($pihak_2) {
        $this->pihak_2 = $pihak_2;
    }

    public function setTanggal_awal($tanggal_awal) {
        $this->tanggal_awal = $tanggal_awal;
    }

    public function setTanggal_akhir($tanggal_akhir) {
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setDokumen_no_dokumen($Dokumen_no_dokumen) {
        $this->Dokumen_no_dokumen = $Dokumen_no_dokumen;
    }

    public function setAktivitas_id_aktivitas($Aktivitas_id_aktivitas) {
        $this->Aktivitas_id_aktivitas = $Aktivitas_id_aktivitas;
    }

    public function setAktivitas_PKS_id_aktivitas($Aktivitas_PKS_id_aktivitas) {
        $this->Aktivitas_PKS_id_aktivitas = $Aktivitas_PKS_id_aktivitas;
    }

    public function __set($name, $value) {
        if (!isset($this->Dokumen_no_dokumen)) {
            $this->Dokumen_no_dokumen = new Dokumen();
        } else if (!isset($this->Mitra_id_mitra)) {
            $this->Mitra_id_mitra = new Mitra();
        } else if (!isset($this->Aktivitas_id_aktivitas)) {
            $this->Aktivitas_id_aktivitas = new AktivitasSKB();
        } else if (!isset($this->Aktivitas_PKS_id_aktivitas)) {
            $this->Aktivitas_PKS_id_aktivitas = new AktivitasPKS();
        }
        if (isset($value)) {
            switch ($name) {
                default:
                    break;
            }
        }
    }

}
