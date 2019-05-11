<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokumen;

class DokumenController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $dokumens = Dokumen::all();
        return view('admin', ['selectedView' => 'viewDokumen'])->with('dokumens', $dokumens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
        $dokumen->link_dokumen = $request->input('linkDokumen');
        $dokumen->save();
        //End Create Dokumen

        return redirect('/dokumen')->with('success', 'Dokumen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
