<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peserta;
use Illuminate\Support\Facades\DB as DB;

class PesertaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesertas = Peserta::orderBy('no_induk_peserta', 'DESC')->paginate(10);
        $warnedTerms = DB::select('SELECT * FROM perjanjian
        WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
            datediff(current_date(), tanggal_akhir) <= 0');
        $expiredTerms = DB::select('SELECT * FROM perjanjian
        WHERE tanggal_akhir < current_date()');
        return view('admin')
            ->with('selectedView', 'viewPeserta')
            ->with('warnedTerms', $warnedTerms)
            ->with('expiredTerms', $expiredTerms)
            ->with('pesertas', $pesertas);
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
            return redirect('/peserta')->with('success', 'Peserta Berhasil Ditambahkan');
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/peserta')->with('error', 'Peserta Gagal Ditambahkan');
            }
        }
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
