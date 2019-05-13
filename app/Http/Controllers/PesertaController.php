<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peserta;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesertas = Peserta::where('is_deleted', 0)->orderBy('no_induk_peserta', 'DESC')->paginate(1);
        return view('pages.peserta')->with('pesertas', $pesertas);
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
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'nomorTelepon' => 'required'
        ]);

        //Start Create Peserta
        $peserta = new Peserta();
        $peserta->no_induk_peserta = $request->input('nip');
        $peserta->nama_peserta = $request->input('nama');
        $peserta->email_peserta = $request->input('email');
        $peserta->no_telepon = $request->input('nomorTelepon');
        try {
            $peserta->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/peserta')->with('error', 'Peserta Gagal Ditambahkan');
            }
        }
        return redirect('/peserta')->with('success', 'Peserta Berhasil Ditambahkan');
        //End Create Peserta
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
