<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Perjanjian;
use App\Mitra;
use App\Dokumen;
use App\Log;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;

class PerjanjianController extends Controller
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
        $perjanjians = Perjanjian::where('is_deleted', 0)
            ->orderBy('id_perjanjian', 'DESC')->paginate(10);
        $mitras = Mitra::all();
        $dokumens = Dokumen::all();
        return view('pages.perjanjian')
            ->with('perjanjians', $perjanjians)
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
        $this->validate($request, [
            'nomorDokumen' => 'required',
            'judulDokumen' => 'required',
            'jenisDokumen' => 'required',
            'deskripsiDokumen' => 'required',
            'linkDokumen' => 'file|nullable|max:4000',
            'mitra' => 'required',
            'pihak1' => 'required',
            'pihak2' => 'required',
            'tanggalAwal' => 'required',
            'tanggalAkhir' => 'required',
            'skb' => 'required'
            ]);

        // Handle File Upload
        if ($request->hasFile('linkDokumen')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('linkDokumen')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('linkDokumen')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore =  $fileName.'.'.$extension;
            // Upload Image
            $path = $request->file('linkDokumen')->storeAs('public/linkDokumen', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Start Create Perjanjian
        $dokumen = new Dokumen();
        $dokumen->no_dokumen = $request->input('nomorDokumen');
        $dokumen->judul_dokumen = $request->input('judulDokumen');
        $dokumen->jenis_dokumen = $request->input('jenisDokumen');
        $dokumen->deskripsi_dokumen = $request->input('deskripsiDokumen');
        $dokumen->link_dokumen = $fileNameToStore;
        $dokumen->pihak_1 = $request->input('pihak1');
        $dokumen->pihak_2 = $request->input('pihak2');
        $dokumen->tanggal_awal = Carbon::parse($request->input('tanggalAwal'));
        $dokumen->tanggal_akhir = Carbon::parse($request->input('tanggalAkhir'));
        if ($request->input('jenisDokumen') == 'Surat Keputusan Bersama') {
            $dokumen->no_skb = $dokumen->no_dokumen;
        } elseif ($request->input('skb') == 'useExistingSkb') {
            $dokumen->no_skb = $request->input('existingSkb');
        }
        $perjanjian = new Perjanjian();
        $perjanjian->Mitra_id_mitra = $request->input('idMitra');
        $perjanjian->dokumen_no_dokumen = $dokumen->no_dokumen;
        try {
            $dokumen->save();
            $perjanjian->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/perjanjian')->with('error', 'Perjanjian Gagal Ditambahkan');
            }
        }
        $log = new Log();
        $log->users_id = Auth::id();
        $log->action = 'create new perjanjian id:'.$perjanjian->id.', new dokumen:'.$dokumen->no_dokumen;
        $log->save();
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
        return view('pages.updatePerjanjian')
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
            'nomorDokumen' => 'required',
            'judulDokumen' => 'required',
            'jenisDokumen' => 'required',
            'deskripsiDokumen' => 'required',
            'linkDokumen' => 'file|nullable|max:2000',
            'mitra' => 'required',
            'pihak1' => 'required',
            'pihak2' => 'required',
            'tanggalAwal' => 'required',
            'tanggalAkhir' => 'required',
        ]);

        // Handle File Upload
        if ($request->hasFile('linkDokumen')) {
            // Get filename with the extension
            $fileNameWithExt = $request->file('linkDokumen')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('linkDokumen')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore =  $fileName.'.'.$extension;
            // Upload Image
            $path = $request->file('linkDokumen')->storeAs('public/linkDokumen', $fileNameToStore);
        }

        //Start Update Perjanjian
        $perjanjian = Perjanjian::find($id);
        $perjanjian->dokumen->no_dokumen = $request->input('nomorDokumen');
        $perjanjian->dokumen->judul_dokumen = $request->input('judulDokumen');
        $perjanjian->dokumen->jenis_dokumen = $request->input('jenisDokumen');
        $perjanjian->dokumen->deskripsi_dokumen = $request->input('deskripsiDokumen');
        if ($request->hasFile('linkDokumen')) {
            $perjanjian->dokumen->link_dokumen = $fileNameToStore;
        }
        $perjanjian->dokumen->pihak_1 = $request->input('pihak1');
        $perjanjian->dokumen->pihak_2 = $request->input('pihak2');
        $perjanjian->dokumen->tanggal_awal = Carbon::parse($request->input('tanggalAwal'));
        $perjanjian->dokumen->tanggal_akhir = Carbon::parse($request->input('tanggalAkhir'));
        $perjanjian->Mitra_id_mitra = $request->input('idMitra');
        $perjanjian->Dokumen_no_dokumen = $perjanjian->dokumen->no_dokumen;
        try {
            $perjanjian->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if ($code == '1062') {
                return redirect('/perjanjian')->with('error', 'Perjanjian Gagal Diupdate');
            }
        }
        return redirect('/perjanjian')->with('success', 'Perjanjian Berhasil Diupdate');
        //End Update Perjanjian
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
        $term = $request->get('term', '');

        $queries=DB::table('mitra')
        ->where('nama_mitra', 'LIKE', '%'.$term.'%')
        ->select('id_mitra', 'nama_mitra')
        ->get();

        $results=array();

        foreach ($queries as  $query) {
            $results[] = ['id' => $query->id_mitra, 'value' => $query->nama_mitra];
        }
        if (count($results)) {
            return response()->json($results);
        } else {
            return ['id'=>'','value'=>'Mitra tidak ditemukan'];
        }
    }

    public function searchPihak1(Request $request)
    {
        $term = $request->get('term', '');

        $queries=DB::table('mitra')
        ->where('nama_mitra', 'LIKE', '%'.$term.'%')
        ->where('jenis_mitra_id', '=', 1)
        ->select('nama_mitra')
        ->get();

        $results=array();

        foreach ($queries as  $query) {
            $results[] = ['value' => $query->nama_mitra];
        }
        if (count($results)) {
            return response()->json($results);
        } else {
            return ['value'=>'Pihak tidak ditemukan'];
        }
    }

    public function searchPihak2(Request $request)
    {
        $term = $request->get('term', '');

        $queries=DB::table('mitra')
        ->where('nama_mitra', 'LIKE', '%'.$term.'%')
        ->where('jenis_mitra_id', '=', 2)
        ->select('nama_mitra')
        ->get();

        $results=array();

        foreach ($queries as  $query) {
            $results[] = ['value' => $query->nama_mitra];
        }
        if (count($results)) {
            return response()->json($results);
        } else {
            return ['value'=>'Pihak tidak ditemukan'];
        }
    }

    // Bekas
    // public function searchMitra(Request $request)
    // {
        // $term = $request->term;
        // $mitras = Mitra::where('nama_mitra', 'LIKE', '%' . $term . '%')->get();
        // if (count($mitras) == 0) {
        //     $searchResult[] = 'Mitra tidak ditemukan';
        // } else {
        //     foreach ($mitras as $key => $value) {
        //         $searchResult[] = $value->nama_mitra;
        //     }
        // }
        // return $searchResult;
    // }
}
