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
class KategoriMitra {

    private $id_kategori_mitra;
    private $nama;

    function __construct($id_kategori_mitra, $nama) {
        $this->id_kategori_mitra = $id_kategori_mitra;
        $this->nama = $nama;
    }

    public function getId_kategori_mitra() {
        return $this->id_kategori_mitra;
    }

    public function getNama() {
        return $this->nama;
    }

    public function setId_kategori_mitra($id_kategori_mitra) {
        $this->id_kategori_mitra = $id_kategori_mitra;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

}
