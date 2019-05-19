<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perjanjian;

class PagesController extends Controller
{
    public function index()
    {
        $perjanjians = Perjanjian::orderBy('id_perjanjian', 'DESC')->paginate(10);
        return view('pages.index')->with('perjanjians', $perjanjians);
    }

    public function charts()
    {
        return view('pages.charts');
    }

    public function services()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
