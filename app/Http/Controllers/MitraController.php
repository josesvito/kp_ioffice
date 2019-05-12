<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mitra;
use App\KategoriMitra;
use Illuminate\Support\Facades\DB as DB;

class MitraController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mitras = Mitra::all();
        $kategoriMitras = KategoriMitra::all();
        $warnedTerms = DB::select('SELECT * FROM perjanjian
        WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
            datediff(current_date(), tanggal_akhir) <= 0');
        $expiredTerms = DB::select('SELECT * FROM perjanjian
        WHERE tanggal_akhir < current_date()');
        return view('admin')
            ->with('selectedView', 'viewMitra')
            ->with('mitras', $mitras)
            ->with('kategoriMitras', $kategoriMitras)
            ->with('warnedTerms', $warnedTerms)
            ->with('expiredTerms', $expiredTerms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'namaMitra' => 'required',
            'kategoriMitra' => 'required',
            'negaraMitra' => 'required',
            'provinsiMitra' => 'required',
            'manfaatMitra' => 'required'
        ]);

        //Start Create Mitra
        $mitra = new Mitra();
        $mitra->nama_mitra = $request->input('namaMitra');
        $mitra->kategori_mitra_id = $request->input('kategoriMitra');
        $mitra->negara = $request->input('negaraMitra');
        $mitra->provinsi = $request->input('provinsiMitra');
        $mitra->manfaat = $request->input('manfaatMitra');
        try {
            $mitra->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/mitra')->with('error', 'Mitra Gagal Ditambahkan');
            }
        }
        return redirect('/mitra')->with('success', 'Mitra Berhasil Ditambahkan');
        //End Create Mitra
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
