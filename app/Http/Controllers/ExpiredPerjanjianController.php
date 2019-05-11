<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\Mitra;
use App\SKB;
use App\PKS;
use App\Dokumen;
use App\Perjanjian;

class ExpiredPerjanjianController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mitras = Mitra::all();
        $dokumens = Dokumen::all();
        $PKSs = PKS::all();
        $SKBs = SKB::all();
        $warnedTerms = DB::select('SELECT * FROM perjanjian
        WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
            datediff(current_date(), tanggal_akhir) <= 0');
        $wPerjanjian = Perjanjian::hydrate($warnedTerms);

        $expiredTerms = DB::select('SELECT * FROM perjanjian
        WHERE tanggal_akhir < current_date()');
        $ePerjanjian = Perjanjian::hydrate($expiredTerms);

        return view('admin')
            ->with('selectedView', 'viewExpiredPerjanjian')
            ->with('warnedTerms', $warnedTerms)
            ->with('expiredTerms', $expiredTerms)
            ->with('wPerjanjian', $wPerjanjian)
            ->with('ePerjanjian', $ePerjanjian)
            ->with('mitras', $mitras)
            ->with('SKBs', $SKBs)
            ->with('PKSs', $PKSs)
            ->with('dokumens', $dokumens);
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
        //
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
        $perjanjian = Perjanjian::find($id);
        $mitras = Mitra::all();
        $dokumens = Dokumen::all();
        $PKSs = PKS::all();
        $SKBs = SKB::all();
        return view('admin', ['selectedView' => 'updatePerjanjian'])
            ->with('perjanjian', $perjanjian)
            ->with('mitras', $mitras)
            ->with('dokumens', $dokumens)
            ->with('SKBs', $SKBs)
            ->with('PKSs', $PKSs);
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
        $this->validate($request, [
            'mitra' => 'required',
            'pihak1' => 'required',
            'pihak2' => 'required',
            'nomorDokumen' => 'required'
        ]);

        //Start Create Perjanjian
        $perjanjian = Perjanjian::find($id);
        $perjanjian->Mitra_id_mitra = $request->input('mitra');
        $perjanjian->pihak_1 = $request->input('pihak1');
        $perjanjian->pihak_2 = $request->input('pihak2');
        $perjanjian->Dokumen_no_dokumen = $request->input('nomorDokumen');
        $perjanjian->tanggal_awal = $request->input('tanggalAwal');
        $perjanjian->tanggal_akhir = $request->input('tanggalAkhir');
        $perjanjian->Aktivitas_SKB_id_aktivitas = $request->input('aktivitasSkb');
        $perjanjian->Aktivitas_PKS_id_aktivitas = $request->input('aktivitasPks');
        // $perjanjian->status = ($endDate - $startDate)/60/60/24;
        $perjanjian->status = 'Coming Soon';
        try {
            $perjanjian->save();
            return redirect('/perjanjian')->with('success', 'Perjanjian Berhasil Diupdate');
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/perjanjian')->with('error', 'Perjanjian Gagal Diupdate');
            }
        }
        //End Create Perjanjian
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
