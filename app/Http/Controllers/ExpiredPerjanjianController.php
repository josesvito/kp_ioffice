<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\Mitra;
use App\Dokumen;
use App\Perjanjian;

class ExpiredPerjanjianController extends Controller
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
        $mitras = Mitra::all();
        $dokumens = Dokumen::all();

        $warnedTerms = DB::select('SELECT * FROM perjanjian
            JOIN dokumen ON dokumen.no_dokumen = perjanjian.dokumen_no_dokumen
            JOIN mitra ON mitra.id_mitra = perjanjian.Mitra_id_mitra
            WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
                datediff(current_date(), tanggal_akhir) <= 0');
        $wPerjanjian = Perjanjian::hydrate($warnedTerms);

        $expiredTerms = DB::select('SELECT * FROM perjanjian
            JOIN dokumen ON dokumen.no_dokumen = perjanjian.dokumen_no_dokumen
            JOIN mitra ON mitra.id_mitra = perjanjian.Mitra_id_mitra
            WHERE tanggal_akhir < current_date()');
        $ePerjanjian = Perjanjian::hydrate($expiredTerms);

        return view('pages.viewExpiredPerjanjian')
            ->with('wPerjanjian', $wPerjanjian)
            ->with('ePerjanjian', $ePerjanjian)
            ->with('mitras', $mitras)
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
        return view('pages.viewExpiredPerjanjian')
            ->with('perjanjian', $perjanjian)
            ->with('mitras', $mitras)
            ->with('dokumens', $dokumens);
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
        $perjanjian->Dokumen_no_dokumen = $request->input('nomorDokumen');
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

    public function searchDokumenSkb(Request $request)
    {
        $term = $request->term;
        $dokumens = Dokumen::where('no_dokumen', 'LIKE', '%' . $term . '%')
            ->where('no_dokumen', 'LIKE', '%SKB%')
            ->get();
        if (count($dokumens) == 0) {
            $searchResult[] = 'Dokumen tidak ditemukan';
        } else {
            foreach ($dokumens as $key => $value) {
                $searchResult[] = $value->no_dokumen;
            }
        }
        return $searchResult;
    }

    public function searchMitra(Request $request)
    {
        $term = $request->term;
        $mitras = Mitra::where('nama_mitra', 'LIKE', '%' . $term . '%')->get();
        if (count($mitras) == 0) {
            $searchResult[] = 'Mitra tidak ditemukan';
        } else {
            foreach ($mitras as $key => $value) {
                $searchResult[] = $value->nama_mitra;
            }
        }
        return $searchResult;
    }
}
