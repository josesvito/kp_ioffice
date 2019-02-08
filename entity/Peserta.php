<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Peserta
 *
 * @author master
 */
class Peserta {

    private $no_induk_peserta;
    private $nama_peserta;
    private $email_peserta;
    private $no_telepon;

    public function __construct($no_induk_peserta, $nama_peserta, $email_peserta, $no_telepon) {
        $this->no_induk_peserta = $no_induk_peserta;
        $this->nama_peserta = $nama_peserta;
        $this->email_peserta = $email_peserta;
        $this->no_telepon = $no_telepon;
    }

    public function getNo_induk_peserta() {
        return $this->no_induk_peserta;
    }

    public function getNama_peserta() {
        return $this->nama_peserta;
    }

    public function getEmail_peserta() {
        return $this->email_peserta;
    }

    public function getNo_telepon() {
        return $this->no_telepon;
    }

    public function setNo_induk_peserta($no_induk_peserta) {
        $this->no_induk_peserta = $no_induk_peserta;
    }

    public function setNama_peserta($nama_peserta) {
        $this->nama_peserta = $nama_peserta;
    }

    public function setEmail_peserta($email_peserta) {
        $this->email_peserta = $email_peserta;
    }

    public function setNo_telepon($no_telepon) {
        $this->no_telepon = $no_telepon;
    }

}
