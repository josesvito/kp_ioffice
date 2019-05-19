@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Peringatan Data Perjanjian</h4>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perjanjian as $term)
                        <tr class="gradeC">
                            <td>{{ $term->dokumen_no_dokumen }}</td>
                            <td>{{ $term->mitra->nama_mitra }}</td>
                            <td>{{ $term->dokumen->pihak_1 }}</td>
                            <td>{{ $term->dokumen->pihak_2 }}</td>
                            <td>{{ date_format(date_create($term->dokumen->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($term->dokumen->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            $difference = date_diff(date_create($term->dokumen->tanggal_akhir),
                            date_create(date('Y-m-d')));
                            if($difference->days > 0 && $difference->invert == 0){
                            $status = 'Expired - '.$difference->days.'d ago';
                            } else {
                            $status = 'Aktif - '.$difference->days.'d left';
                            }
                            @endphp
                            <td>{{ $status }}</td>
                            <td>
                                {!! Form::open(['action' => ['PerjanjianController@destroy',
                                $term->id_perjanjian], 'method' => 'POST']) !!}
                                {{ Form::hidden('_method', 'DELETE')}}
                                @if(strpos($status, 'Aktif') !== false)
                                <a href="{{route('perjanjian.destroy', $term->id_perjanjian)}}"
                                    class="btn btn-primary disabled">Mark for Delete</a>
                                @else
                                <input type="submit" class="btn btn-primary" value="Mark for Delete">
                                @endif
                                {!! Form::close() !!}
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