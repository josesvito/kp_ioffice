<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author master
 */
class HomeController {

    //put your code here
    private $skbDaoImpl;
    private $pksDaoImpl;

    public function __construct() {
        $this->skbDaoImpl = new SKBDaoImpl();
        $this->pksDaoImpl = new PKSDaoImpl();
    }

    public function viewHome() {
        require_once '../pages/home.php';
    }

}
