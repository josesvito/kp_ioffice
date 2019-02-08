<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dokumen
 *
 * @author master
 */
class Dokumen {

    private $no_dokumen;
    private $nama_dokumen;
    private $jenis_dokumen;
    private $deskripsi_dokumen;
    private $link_dokumen;

    public function __construct($no_dokumen, $nama_dokumen, $jenis_dokumen, $deskripsi_dokumen, $link_dokumen) {
        $this->no_dokumen = $no_dokumen;
        $this->nama_dokumen = $nama_dokumen;
        $this->jenis_dokumen = $jenis_dokumen;
        $this->deskripsi_dokumen = $deskripsi_dokumen;
        $this->link_dokumen = $link_dokumen;
    }

    public function getNo_dokumen() {
        return $this->no_dokumen;
    }

    public function getNama_dokumen() {
        return $this->nama_dokumen;
    }

    public function getJenis_dokumen() {
        return $this->jenis_dokumen;
    }

    public function getDeskripsi_dokumen() {
        return $this->deskripsi_dokumen;
    }

    public function getLink_dokumen() {
        return $this->link_dokumen;
    }

    public function setNo_dokumen($no_dokumen) {
        $this->no_dokumen = $no_dokumen;
    }

    public function setNama_dokumen($nama_dokumen) {
        $this->nama_dokumen = $nama_dokumen;
    }

    public function setJenis_dokumen($jenis_dokumen) {
        $this->jenis_dokumen = $jenis_dokumen;
    }

    public function setDeskripsi_dokumen($deskripsi_dokumen) {
        $this->deskripsi_dokumen = $deskripsi_dokumen;
    }

    public function setLink_dokumen($link_dokumen) {
        $this->link_dokumen = $link_dokumen;
    }

}
