<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perjanjian;
use DB;

class PagesController extends Controller
{
    public function index()
    {
        $query = DB::select("SELECT MAX(nama_mitra) AS nama_mitra, MIN(tanggal_awal) AS tanggal_awal, MAX(tanggal_akhir) AS tanggal_akhir FROM perjanjian
            JOIN dokumen ON perjanjian.dokumen_no_dokumen = dokumen.no_dokumen
            JOIN mitra ON perjanjian.mitra_id_mitra = mitra.id_mitra
            GROUP by mitra_id_mitra
            ORDER by tanggal_akhir DESC");
        $perjanjians = Perjanjian::hydrate($query);
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
