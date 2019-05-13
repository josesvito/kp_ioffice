@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Data Perjanjian Warned</h4>
            </div>
            <div class="card-body">
                <br>
                <table class="table border" id="myTable">
                    <thead>
                        <tr>
                            <th>Dokumen</th>
                            <th>Mitra</th>
                            <th>Pihak 1</th>
                            <th>Pihak 2</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Aktivitas PKS</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wPerjanjian as $term)
                        <tr class="gradeC">
                            <td>{{ $term->dokumen_no_dokumen }}</td>
                            <td>{{ $term->mitra->nama_mitra }}</td>
                            <td>{{ $term->pihak_1 }}</td>
                            <td>{{ $term->pihak_2 }}</td>
                            <td>{{ date_format(date_create($term->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($term->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            if($term->aktivitas_pks_id_aktivitas == NULL){
                            $pksName = '';
                            } else {
                            $pksName = $term->pks->nama_aktivitas;
                            }
                            @endphp
                            <td>{{ $pksName }}</td>
                            @php
                            $difference = date_diff(date_create($term->tanggal_akhir), date_create(date('Y-m-d')));
                            $status = 'Active - '.$difference->days.'d left';
                            @endphp
                            <td>{{ $status }}</td>
                            <td>
                                <a href="/perjanjian/{{ $term->id_perjanjian }}/edit" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Data Perjanjian Expired</h4>
            </div>
            <div class="card-body">
                <br>
                <table class="table border" id="myTable2">
                    <thead>
                        <tr>
                            <th>Dokumen</th>
                            <th>Mitra</th>
                            <th>Pihak 1</th>
                            <th>Pihak 2</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Aktivitas PKS</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ePerjanjian as $term)
                        <tr class="gradeC">
                            <td>{{ $term->dokumen_no_dokumen }}</td>
                            <td>{{ $term->mitra->nama_mitra }}</td>
                            <td>{{ $term->pihak_1 }}</td>
                            <td>{{ $term->pihak_2 }}</td>
                            <td>{{ date_format(date_create($term->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($term->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            if($term->aktivitas_pks_id_aktivitas == NULL){
                            $pksName = '';
                            } else {
                            $pksName = $term->pks->nama_aktivitas;
                            }
                            @endphp
                            <td>{{ $pksName }}</td>
                            @php
                            $difference = date_diff(date_create($term->tanggal_akhir), date_create(date('Y-m-d')));
                            if($difference->days > 0 && $difference->invert == 0){
                            $status = 'Expired - '.$difference->days.'d ago';
                            } else {
                            $status = 'Active - '.$difference->days.'d left';
                            }
                            @endphp
                            <td>{{ $status }}</td>
                            <td>
                                <a href="/perjanjian/{{ $term->id_perjanjian }}/edit" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><br>
@endsection