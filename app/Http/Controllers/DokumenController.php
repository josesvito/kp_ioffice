<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\Dokumen;

class DokumenController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumens = Dokumen::all();
        $warnedTerms = DB::select('SELECT * FROM perjanjian
        WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
            datediff(current_date(), tanggal_akhir) <= 0');
        $expiredTerms = DB::select('SELECT * FROM perjanjian
        WHERE tanggal_akhir < current_date()');
        return view('admin')
            ->with('selectedView', 'viewDokumen')
            ->with('dokumens', $dokumens)
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
            'nomorDokumen' => 'required',
            'judulDokumen' => 'required',
            'jenisDokumen' => 'required',
            'deskripsiDokumen' => 'required',
            'linkDokumen' => 'required'
        ]);

        //Start Create Dokumen
        $dokumen = new Dokumen();
        $dokumen->no_dokumen = $request->input('nomorDokumen');
        $dokumen->judul_dokumen = $request->input('judulDokumen');
        $dokumen->jenis_dokumen = $request->input('jenisDokumen');
        $dokumen->deskripsi_dokumen = $request->input('deskripsiDokumen');
        $dokumen->link_dokumen = $request->file('linkDokumen')->getClientOriginalName();
        try {
            $dokumen->save();
            return redirect('/dokumen')->with('success', 'Dokumen Berhasil Ditambahkan');
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/dokumen')->with('error', 'Nomor Dokumen Sudah Ada');
            }
        }
        //End Create Dokumen
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
