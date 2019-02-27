<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function viewHome() {
        return view('home');
    }
    
    public function viewDoc() {
        return view('viewDokumen');
    }
    
    public function viewTerm() {
        return view('viewPerjanjian');
    }
    
    public function viewParticipant() {
        return view('viewPeserta');
    }
    
    public function viewPartner() {
        return view('viewMitra');
    }
}
