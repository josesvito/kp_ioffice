@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update Perjanjian</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['action' => ['PerjanjianController@update', $perjanjian->id_perjanjian], 'method' => 'POST']) !!}
                <div class="form-group">
                    <select class="form-control" name="mitra">
                        @foreach ($mitras as $mitra)
                        @if ($perjanjian->Mitra_id_mitra == $mitra->id_mitra)
                        <option value="{{ $mitra->id_mitra }}" selected>
                            {{ $mitra->nama_mitra }}
                        </option>
                        @else
                        <option value="{{ $mitra->id_mitra }}">
                            {{ $mitra->nama_mitra }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Pihak 1" name="pihak1" value="{{ $perjanjian->pihak_1 }}">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Pihak 2" name="pihak2" value="{{ $perjanjian->pihak_2 }}">
                </div>
                <div class="form-group">
                    {{-- <input type="text" class="form-control" name="nomorDokumen" placeholder="Nomor Dokumen">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                        </button>
                    </span> --}}
                    {{-- <select class="form-control" name="nomorDokumen">
                        @foreach ($dokumens as $dokumen)
                        @if ($perjanjian->Dokumen_no_dokumen == $dokumen->no_dokumen)
                        <option value="{{ $dokumen->no_dokumen }}" selected>
                    {{ $dokumen->no_dokumen }}
                    </option>
                    @else
                    <option value="{{ $dokumen->no_dokumen }}">
                        {{ $dokumen->no_dokumen }}
                    </option>
                    @endif
                    @endforeach
                    </select> --}}
                    <input type="text" class="form-control" name="nomorDokumen" id="searchNomorDokumen" placeholder="Nomor Dokumen" value="{{$perjanjian->dokumen_no_dokumen}}">
                </div>
                <div class="form-group">
                    <input type="date" placeholder="Tanggal Awal" class="form-control" id="tglAwal" name="tanggalAwal" value="{{ $perjanjian->tanggal_awal }}">
                </div>
                <div class="form-group">
                    <input type="date" placeholder="Tanggal Akhir" class="form-control" id="tglAkhir" name="tanggalAkhir" value="{{ $perjanjian->tanggal_akhir }}">
                </div>
                <div class="form-group">
                    <select class="form-control" name="aktivitasSkb">
                        <option value="" disabled selected hidden>-Aktivitas SKB-</option>
                        @foreach ($SKBs as $SKB)
                        @if ($perjanjian->Aktivitas_SKB_id_aktivitas == $SKB->id_aktivitas)
                        <option value="{{ $SKB->id_aktivitas }}" selected>
                            {{ $SKB->id_aktivitas.' - '.$SKB->nama_aktivitas }}
                        </option>
                        @else
                        <option value="{{ $SKB->id_aktivitas }}">
                            {{ $SKB->id_aktivitas.' - '.$SKB->nama_aktivitas }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="aktivitasPks">
                        <option value="" disabled selected hidden>-Aktivitas PKS-</option>
                        @foreach ($PKSs as $PKS)
                        @if ($perjanjian->Aktivitas_PKS_id_aktivitas == $PKS->id_aktivitas)
                        <option value="{{ $PKS->id_aktivitas }}" selected>
                            {{ $PKS->id_aktivitas.' - '.$PKS->nama_aktivitas }}
                        </option>
                        @else
                        <option value="{{ $PKS->id_aktivitas }}">
                            {{ $PKS->id_aktivitas.' - '.$PKS->nama_aktivitas }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{ Form::hidden('_method', 'PUT') }}
                <a href="{{url()->previous() }}" class="btn btn-primary">Back</a>
                <input type="submit" class="btn btn-primary pull-right" value="Save changes">
                {!! Form::close() !!}
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
            source: "{{ route('perjanjian.search') }}"
        });
    });
</script>

<script>
    jQuery.validator.addMethod("greaterThan", function(value, element, params) {
        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) ||
            (Number(value) > Number($(params).val()));
    }, 'Must be greater than {0}.');
</script>

<script>
    $("#tglAkhir").rules('add', {
        greaterThan: "#tglAwal"
    });
</script>
@endsection