<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokumen;
use App\Log;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumens = Dokumen::where('is_deleted', 0)->get();
        return view('pages.dokumen')->with('dokumens', $dokumens);
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
            'deskripsiDokumen' => 'required'
        ]);

        //Start Create Dokumen
        $dokumen = new Dokumen();
        $dokumen->no_dokumen = $request->input('nomorDokumen');
        $dokumen->judul_dokumen = $request->input('judulDokumen');
        $dokumen->jenis_dokumen = $request->input('jenisDokumen');
        $dokumen->deskripsi_dokumen = $request->input('deskripsiDokumen');
        $dokumen->link_dokumen = $request->input('linkDokumen');
        try {
            $dokumen->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/dokumen')->with('error', 'Nomor Dokumen Sudah Ada');
            }
        }
        return redirect('/dokumen')->with('success', 'Dokumen Berhasil Ditambahkan');
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
