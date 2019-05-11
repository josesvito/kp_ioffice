<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function charts(){
        return view('pages.charts');
    }

    public function perjanjian(){
        return view('pages.perjanjian');
    }

    public function dokumen(){
        return view('pages.dokumen');
    }

    public function mitra(){
        return view('pages.mitra');
    }

    public function peserta(){
        return view('pages.peserta');
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
