<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Genre
 *
 * @author master
 */
class Mitra {

    private $id_mitra;
    private $nama_mitra;
    private $kategori_mitra;
    private $skbMitra;
    private $tanggal_awal;
    private $tanggal_akhir;
    private $manfaat;
    private $jumlah_aktivitas;
    private $aktivitas_yang_dilakukan;

    public function __construct($id_mitra, $nama_mitra, $kategori_mitra, $skbMitra, $tanggal_awal, $tanggal_akhir, $manfaat, $jumlah_aktivitas, $aktivitas_yang_dilakukan) {
        $this->id_mitra = $id_mitra;
        $this->nama_mitra = $nama_mitra;
        $this->kategori_mitra = $kategori_mitra;
        $this->skbMitra = $skbMitra;
        $this->tanggal_awal = $tanggal_awal;
        $this->tanggal_akhir = $tanggal_akhir;
        $this->manfaat = $manfaat;
        $this->jumlah_aktivitas = $jumlah_aktivitas;
        $this->aktivitas_yang_dilakukan = $aktivitas_yang_dilakukan;
    }

    public function getId_mitra() {
        return $this->id_mitra;
    }

    public function getNama_mitra() {
        return $this->nama_mitra;
    }

    public function getKategori_mitra() {
        return $this->kategori_mitra;
    }

    public function getSkbMitra() {
        return $this->skbMitra;
    }

    public function getTanggal_awal() {
        return $this->tanggal_awal;
    }

    public function getTanggal_akhir() {
        return $this->tanggal_akhir;
    }

    public function getManfaat() {
        return $this->manfaat;
    }

    public function getJumlah_aktivitas() {
        return $this->jumlah_aktivitas;
    }

    public function getAktivitas_yang_dilakukan() {
        return $this->aktivitas_yang_dilakukan;
    }

    public function setId_mitra($id_mitra) {
        $this->id_mitra = $id_mitra;
    }

    public function setNama_mitra($nama_mitra) {
        $this->nama_mitra = $nama_mitra;
    }

    public function setKategori_mitra($kategori_mitra) {
        $this->kategori_mitra = $kategori_mitra;
    }

    public function setSkbMitra($skbMitra) {
        $this->skbMitra = $skbMitra;
    }

    public function setTanggal_awal($tanggal_awal) {
        $this->tanggal_awal = $tanggal_awal;
    }

    public function setTanggal_akhir($tanggal_akhir) {
        $this->tanggal_akhir = $tanggal_akhir;
    }

    public function setManfaat($manfaat) {
        $this->manfaat = $manfaat;
    }

    public function setJumlah_aktivitas($jumlah_aktivitas) {
        $this->jumlah_aktivitas = $jumlah_aktivitas;
    }

    public function setAktivitas_yang_dilakukan($aktivitas_yang_dilakukan) {
        $this->aktivitas_yang_dilakukan = $aktivitas_yang_dilakukan;
    }

    public function __set($name, $value) {
        if (!isset($this->kategori_mitra)) {
            $this->kategori_mitra = new KategoriMitra();
        }
        if (isset($value)) {
            switch ($name) {
                case 'cat_id':
                    $this->kategori_mitra->setId_kategori_mitra($value);
                case 'cat_name':
                    $this->kategori_mitra->setNama($value);
                default:
                    break;
            }
        }
    }

}
