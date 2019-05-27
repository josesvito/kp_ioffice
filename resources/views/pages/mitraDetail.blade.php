@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                    <h3>Daftar Perjanjian Kerja Sama {{ $mitra->nama_mitra }}</h3>
            </div>
            <div class="card-body">
                <br>
                <table class="table border" id="myTable">
                    <thead>
                        <tr>
                            <th>Nomor Dokumen</th>
                            <th>Judul Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perjanjians as $perjanjian)
                        {{-- @php
                        $aktivitasPks = DB::table('dokumen')
                                        ->select('no_dokumen')
                                        ->join('perjanjian', 'no_dokumen', '=', 'dokumen_no_dokumen')
                                        ->join('mitra', 'Mitra_id_mitra', '=', 'id_mitra')
                                        ->where('jenis_dokumen_id', '=', 2)
                                        ->where('id_mitra', '=', $id)
                                        ->get();
                        @endphp --}}
                            @if ($perjanjian->Mitra_id_mitra == $id)
                                <tr class="gradeC">
                                    <td>{{$perjanjian->dokumen->no_dokumen}}</td>
                                    <td>{{$perjanjian->dokumen->judul_dokumen}}</td>
                                </tr>
                            @endif
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
