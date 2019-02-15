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
class KategoriMitraController {

    //put your code here
    private $genreDaoImpl;

    public function __construct() {
        $this->genreDaoImpl = new GenreDaoImpl();
    }

    public function vidGenre() {
        $com = FILTER_INPUT(INPUT_GET, 'command');
        if ($com == 'delete') {
            $id = FILTER_INPUT(INPUT_GET, 'id');
            if ($this->genreDaoImpl->deleteGenre($id) == FALSE) {
                $er = 'Data genre tidak dapat dihapus.';
            } else {
                header("location:index.php?menu=gen");
            }
        }

        $msg = 'none';
        $btnSaveGenre = FILTER_INPUT(INPUT_POST, 'btnSaveGenre');
        if ($btnSaveGenre) {
            $genrename = FILTER_INPUT(INPUT_POST, 'namagenre');
            $g = new Mitra();
            $g->setName($genrename);
            $msg = $this->genreDaoImpl->addGenre($g);
            header("location:index.php?menu=gen&msg=" . $msg);
        }
        $hasil = $this->genreDaoImpl->showAllGenre();
        require_once 'genre.php';

//        require_once 'update_genre.php';
    }

    public function updateGenre() {
        //untuk ambil data sebelumnya
        $id = FILTER_INPUT(INPUT_GET, 'id');
        if (isset($id)) {
            $data = $this->genreDaoImpl->getOneGenre($id);
            $hasil = $data->fetch();
            $namaGenreLama = $hasil->getName();
        }
        //untuk proses update sesudah button update diklik
        $btnUpdateGenre = FILTER_INPUT(INPUT_POST, 'btnUpdateGenre');
        if ($btnUpdateGenre) {
            $newgenrename = FILTER_INPUT(INPUT_POST, 'namagenre');

            $g = new Mitra();
            $g->setId($id);
            $g->setName($newgenrename);

            $this->genreDaoImpl->updateGenre($g);
            header('location:index.php?menu=gen');
        }
        require_once 'update_genre.php';
    }

}
