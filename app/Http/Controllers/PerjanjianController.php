<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Perjanjian;
use App\Mitra;
use App\Dokumen;
use App\PKS;
use App\SKB;

class PerjanjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perjanjians = Perjanjian::where('is_deleted', 0)
            ->orderBy('id_perjanjian', 'DESC')->paginate(10);
        $mitras = Mitra::all();
        $dokumens = Dokumen::all();
        $PKSs = PKS::all();
        $SKBs = SKB::all();
        return view('pages.perjanjian')
            ->with('perjanjians', $perjanjians)
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
        $this->validate($request, [
            'mitra' => 'required',
            'pihak1' => 'required',
            'pihak2' => 'required',
            'nomorDokumen' => 'required'
        ]);

        //Start Create Perjanjian
        $perjanjian = new Perjanjian();
        $perjanjian->Mitra_id_mitra = $request->input('mitra');
        $perjanjian->pihak_1 = $request->input('pihak1');
        $perjanjian->pihak_2 = $request->input('pihak2');
        $perjanjian->Dokumen_no_dokumen = $request->input('nomorDokumen');
        $perjanjian->tanggal_awal = $request->input('tanggalAwal');
        $perjanjian->tanggal_akhir = $request->input('tanggalAkhir');
        $perjanjian->Aktivitas_SKB_id_aktivitas = $request->input('aktivitasSkb');
        $perjanjian->Aktivitas_PKS_id_aktivitas = $request->input('aktivitasPks');
        try {
            $perjanjian->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/perjanjian')->with('error', 'Perjanjian Gagal Ditambahkan');
            }
        }
        return redirect('/perjanjian')->with('success', 'Perjanjian Berhasil Ditambahkan');
        //End Create Perjanjian
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
        return view('pages.updatePerjanjian')
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
        $perjanjian->save();
        //End Create Perjanjian

        return redirect('/perjanjian')->with('success', 'Perjanjian Berhasil Diupdate');
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

    public function search(Request $request)
    {
        $term = $request->term;
        $dokumens = Dokumen::where('no_dokumen', 'LIKE', '%' . $term . '%')->get();
        // return $dokumen;
        if (count($dokumens) == 0) {
            $searchResult[] = 'Tidak ada dokumen yang di temukan';
        } else {
            foreach ($dokumens as $key => $value) {
                $searchResult[] = $value->no_dokumen;
            }
        }
        return $searchResult;
    }
}
