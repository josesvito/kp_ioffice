<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perjanjian;
use App\Dokumen;
use App\Mitra;
use App\KategoriMitra;
use App\JenisMitra;
use App\Log;
use DB;
use Auth;
use Carbon\Carbon;

class MitraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mitras = Mitra::where('is_deleted', 0)->get();
        $kategoriMitras = KategoriMitra::all();
        $jenisMitras = JenisMitra::all();
        return view('pages.mitra')
            ->with('kategoriMitras', $kategoriMitras)
            ->with('jenisMitras', $jenisMitras)
            ->with('mitras', $mitras);
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
            'jenisMitra' => 'required',
            'nomorTeleponMitra' => 'required',
            'emailMitra' => 'required',
            'negaraMitra' => 'required',
            'provinsiMitra' => 'required',
            'kotaMitra' => 'required',
            'alamatMitra' => 'required',
            'kodePosMitra' => 'required',
        ]);

        //Start Create Mitra
        $mitra = new Mitra();
        $mitra->nama_mitra = $request->input('namaMitra');
        $mitra->kategori_mitra_id = $request->input('kategoriMitra');
        $mitra->jenis_mitra_id = $request->input('jenisMitra');
        $mitra->no_telepon = $request->input('nomorTeleponMitra');
        $mitra->email = $request->input('emailMitra');
        $mitra->negara = $request->input('negaraMitra');
        $mitra->provinsi = $request->input('provinsiMitra');
        $mitra->kota = $request->input('kotaMitra');
        $mitra->alamat = $request->input('alamatMitra');
        $mitra->kode_pos = $request->input('kodePosMitra');
        try {
            $mitra->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/mitra')->with('error', 'Mitra Gagal Ditambahkan');
            }
        }
        $log = new Log();
        $log->users_id = Auth::id();
        $log->action = 'create new mitra id:'.$mitra->id_mitra;
        $log->save();
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

    public function detailMitra($id)
    {
        $mitra = Mitra::find($id);
        $perjanjians = Perjanjian::all();
        $dokumens = Dokumen::all();
        return view('pages.mitraDetail')
        ->with('mitra', $mitra)
        ->with('perjanjians', $perjanjians)
        ->with('dokumens', $dokumens)
        ->with('id', $id);
    }
}
