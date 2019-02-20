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
class PerjanjianController {

    //put your code here
    private $skbDaoImpl;
    private $pksDaoImpl;

    public function __construct() {
        $this->skbDaoImpl = new SKBDaoImpl();
        $this->pksDaoImpl = new PKSDaoImpl();
    }

    public function viewPerjanjian() {
        require_once '../pages/viewPerjanjian.php';
    }

}
