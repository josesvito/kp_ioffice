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

    private $id_aktivitas;
    private $nama_aktivitas;

    public function __construct($id_aktivitas, $nama_aktivitas) {
        $this->id_aktivitas = $id_aktivitas;
        $this->nama_aktivitas = $nama_aktivitas;
    }

    public function getId_aktivitas() {
        return $this->id_aktivitas;
    }

    public function getNama_aktivitas() {
        return $this->nama_aktivitas;
    }

    public function setId_aktivitas($id_aktivitas) {
        $this->id_aktivitas = $id_aktivitas;
    }

    public function setNama_aktivitas($nama_aktivitas) {
        $this->nama_aktivitas = $nama_aktivitas;
    }

}
