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
                {!! Form::open(['action' => ['PerjanjianController@update', $perjanjian->id_perjanjian], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <input type="text" class="form-control" name="nomorDokumen" id="searchNomorDokumen" placeholder="Nomor Dokumen" value="{{$perjanjian->dokumen_no_dokumen}}">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Judul Dokumen" name="judulDokumen" value="{{ $perjanjian->dokumen->judul_dokumen }}">
                </div>
                <div class="form-group">
                    <select class="form-control" name="jenisDokumen">
                        <option value="" disabled selected hidden>-Jenis Dokumen-</option>
                        <option value="Surat Keputusan Bersama">Surat Keputusan Bersama</option>
                        <option value="Perjanjian Kerja Sama">Perjanjian Kerja Sama</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Deskripsi Dokumen" rows="2" name="deskripsiDokumen">{{ $perjanjian->dokumen->deskripsi_dokumen }}</textarea>
                </div>
                <div class="form-group">
                    <label>Upload Dokumen</label>
                    <input type="file" name="linkDokumen" />
                </div>
                <div class="form-group">
                    <input type="text" name="mitra" id="searchMitra" class="form-control" placeholder="Mitra" value="{{ $perjanjian->mitra->nama_mitra }}"/>
                </div>
                <div class="form-group">
                    <input type="text" name="idMitra" id="idMitra" class="form-control" placeholder="Mitra" value="{{ $perjanjian->Mitra_id_mitra }}" hidden/>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Pihak 1" name="pihak1" id="searchPihak1" value="{{ $perjanjian->dokumen->pihak_1 }}">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Pihak 2" name="pihak2" id="searchPihak2" value="{{ $perjanjian->dokumen->pihak_2 }}">
                </div>
                <div class="form-group">
                    <input type="date" placeholder="Tanggal Awal" class="form-control" id="tglAwal" name="tanggalAwal" value="{{ $perjanjian->dokumen->tanggal_awal }}">
                </div>
                <div class="form-group">
                    <input type="date" placeholder="Tanggal Akhir" class="form-control" id="tglAkhir" name="tanggalAkhir" value="{{ $perjanjian->dokumen->tanggal_akhir }}">
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
        $("#searchNomorDokumen").autocomplete({
            source: "{{ route('perjanjian.searchDokumenSkb') }}"
        });

        $("#searchMitra").autocomplete({
            source: "{{ route('perjanjian.searchMitra') }}",
            select: function( event, ui ) {
                $( "#searchMitra" ).val( ui.item.value );
                $( "#idMitra" ).val( ui.item.id );
                return false;
            }
        });

        $("#searchPihak1").autocomplete({
            source: "{{ route('perjanjian.searchPihak1') }}"
        });

        $("#searchPihak2").autocomplete({
            source: "{{ route('perjanjian.searchPihak2') }}"
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
