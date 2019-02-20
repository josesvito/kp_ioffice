<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenreController
 *
 * @author master
 */
class DokumenController {

    //put your code here
    private $skbDaoImpl;
    private $pksDaoImpl;
    private $dokumenDaoImpl;

    public function __construct() {
        $this->skbDaoImpl = new SKBDaoImpl();
        $this->pksDaoImpl = new PKSDaoImpl();
        $this->dokumenDaoImpl = new DokumenDaoImpl();
    }

    public function viewDokumen() {
        require_once '../pages/viewDokumen.php';
    }

}
