<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Peserta;
use App\Perjanjian;
use App\PerjanjianHasPeserta;
use App\Log;
use Auth;

class PesertaController extends Controller
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
        $relasis = PerjanjianHasPeserta::rightJoin('peserta as s', 'peserta_no_induk_peserta', '=', 'no_induk_peserta')
            ->leftJoin('perjanjian as p', 'perjanjian_id_perjanjian', '=', 'id_perjanjian')
            ->leftJoin('dokumen as d', 'dokumen_no_dokumen', '=', 'no_dokumen')
            ->where('s.is_deleted', 0)->paginate(10);

        // dd($relasis);

        return view('pages.peserta')->with('relasis', $relasis);
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

        $log = new Log();
        $log->users_id = Auth::id();
        //Start Create Peserta
        $peserta = new Peserta();
        $peserta->no_induk_peserta = $request->input('nip');
        $peserta->nama_peserta = $request->input('nama');
        $peserta->email_peserta = $request->input('email');
        $peserta->no_telepon = $request->input('nomorTelepon');
        $relasi = new PerjanjianHasPeserta();
        $relasi->perjanjian_id_perjanjian = $request->input('idPerjanjian');
        $relasi->peserta_no_induk_peserta = $peserta->no_induk_peserta;
        
        if (count(Peserta::find($peserta)) == 0) {
            $peserta->save();
            $log->action = 'Add peserta '.$peserta->no_induk_peserta;
            $log->save();
        }
        
        if ($relasi->perjanjian_id_perjanjian != null) {
            $find = PerjanjianHasPeserta::where('perjanjian_id_perjanjian', $relasi->perjanjian_id_perjanjian)
                ->where('peserta_no_induk_peserta', $peserta->no_induk_peserta)
                ->get();
    
            if (count($find) == 0) {
                $relasi->save();
                $log->action = 'Add peserta '.$peserta->no_induk_peserta.' to perjanjian '.$relasi->perjanjian_id_perjanjian;
                $log->save();
                return redirect('/peserta')->with('success', 'Peserta Berhasil Didaftarkan');
            } else {
                return redirect('/peserta')->with('error', 'Peserta Sudah Terdaftar');
            }
        }
        return redirect('/peserta')->with('success', 'Data Peserta Sudah Masuk');
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

    public function searchPerjanjian(Request $request)
    {
        $term = $request->get('term', '');

        $queries=DB::table('perjanjian')
        ->join('dokumen', 'dokumen_no_dokumen', '=', 'dokumen.no_dokumen')
        ->where('no_dokumen', 'LIKE', '%'.$term.'%')
        ->where('jenis_dokumen', '=', 'Perjanjian Kerja Sama')
        ->select('id_perjanjian', 'no_dokumen')
        ->get();

        $results=array();

        foreach ($queries as  $query) {
            $results[] = ['id' => $query->id_perjanjian, 'value' => $query->no_dokumen];
        }
        if (count($results)) {
            return response()->json($results);
        } else {
            return ['id'=>'','value'=>'Perjanjian tidak ditemukan'];
        }
    }
}
