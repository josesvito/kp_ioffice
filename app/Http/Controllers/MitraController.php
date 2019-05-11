<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mitra;
use App\KategoriMitra;

class MitraController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $mitras = Mitra::all();
        $kategoriMitras = KategoriMitra::all();
        return view('admin', ['selectedView' => 'viewMitra'])
                        ->with('kategoriMitras', $kategoriMitras)
                        ->with('mitras', $mitras);
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
        $mitra->save();
        //End Create Mitra

        return redirect('/mitra')->with('success', 'Mitra Berhasil Ditambahkan');
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
