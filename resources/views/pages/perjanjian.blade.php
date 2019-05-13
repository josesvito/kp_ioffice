@extends('layouts.app')

@section('content')
<!--Modal-->
{!! Form::open(['action' => 'PerjanjianController@store', 'method' => 'POST']) !!}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:215000000 !important;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Perjanjian</h4>
            </div>
            <div class="modal-body ui-front">
                <div class="form-group">
                    <select class="form-control" name="mitra">
                        <option disabled selected hidden>-Mitra-</option>
                        @foreach ($mitras as $mitra)
                        <option value="{{ $mitra->id_mitra }}">
                            {{ $mitra->nama_mitra }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Pihak 1" name="pihak1">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Pihak 2" name="pihak2">
                </div>
                <div class="form-group">
                    {{-- <select class="form-control" name="nomorDokumen">
                        <option disabled selected hidden>-Nomor Dokumen-</option>
                        @foreach ($dokumens as $dokumen)
                            <option value="{{ $dokumen->no_dokumen }}">
                    {{ $dokumen->no_dokumen }}
                    </option>
                    @endforeach
                    </select> --}}
                    <input type="text" name="nomorDokumen" id="searchNomorDokumen" class="form-control" placeholder="Nomor Dokumen" />
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Tanggal Awal" class="form-control" name="tanggalAwal" id="tglAwal">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Tanggal Akhir" class="form-control" name="tanggalAkhir" id="tglAkhir">
                </div>
                <div class="form-group">
                    <select class="form-control" name="aktivitasSkb">
                        <option value="" disabled selected hidden>-Aktivitas SKB-</option>
                        @foreach ($SKBs as $SKB)
                        <option value="{{ $SKB->id_aktivitas }}">
                            {{ $SKB->id_aktivitas.' - '.$SKB->nama_aktivitas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="aktivitasPks">
                        <option value="" disabled selected hidden>-Aktivitas PKS-</option>
                        @foreach ($PKSs as $PKS)
                        <option value="{{ $PKS->id_aktivitas }}">
                            {{ $PKS->id_aktivitas.' - '.$PKS->nama_aktivitas }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save changes" />
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{!! Form::close() !!}

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Perjanjian</h4>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Tambah Perjanjian</button>
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
                        @foreach ($perjanjians as $perjanjian)
                        <tr class="gradeC">
                            <td>{{ $perjanjian->dokumen_no_dokumen }}</td>
                            <td>{{ $perjanjian->mitra->nama_mitra }}</td>
                            <td>{{ $perjanjian->pihak_1 }}</td>
                            <td>{{ $perjanjian->pihak_2 }}</td>
                            <td>{{ date_format(date_create($perjanjian->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($perjanjian->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            if($perjanjian->aktivitas_pks_id_aktivitas == NULL){
                            $pksName = '';
                            } else {
                            $pksName = $perjanjian->pks->nama_aktivitas;
                            }
                            @endphp
                            <td>{{ $pksName }}</td>
                            @php
                            $difference = date_diff(date_create($perjanjian->tanggal_akhir), date_create(date('Y-m-d')));
                            if($difference->days > 0 && $difference->invert == 0){
                            $status = 'Expired - '.$difference->days.'d ago';
                            } else {
                            $status = 'Active - '.$difference->days.'d left';
                            }
                            @endphp
                            <td>{{ $status }}</td>
                            <td>
                                <a href="/perjanjian/{{ $perjanjian->id_perjanjian }}/edit" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var availableTags = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];
        $("#searchNomorDokumen").autocomplete({
            source: 'searchPerjanjian'
        });
    });
</script>

@endsection