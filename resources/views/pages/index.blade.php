@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Selamat Datang di Web DKS</h4>
            </div>
            <div class="card-body">
                <table class="table border" id="tableHome">
                    <thead>
                        <tr>
                            <th>Mitra</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perjanjians as $perjanjian)
                        <tr class="gradeC">
                            <td>{{ $perjanjian->nama_mitra }}</td>
                            <td>{{ date_format(date_create($perjanjian->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($perjanjian->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            $difference = date_diff(date_create($perjanjian->tanggal_akhir),
                            date_create(date('Y-m-d')));
                            if($difference->days > 0 && $difference->invert == 0){
                            $status = 'Expired - '.$difference->days.'d ago';
                            } else {
                            $status = 'Active - '.$difference->days.'d left';
                            }
                            @endphp
                            <td>{{ $status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection