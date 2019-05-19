@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Perjanjian</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['action' => ['PerjanjianController@update', $perjanjian->id_perjanjian], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group row">
                            <label for="nomorDokumen" class="col-sm-2 col-form-label">Nomor Dokumen</label>
                            <div class="col-sm-10">
                                <input class="form-control" placeholder="Nomor Dokumen" name="nomorDokumen" id="nomorDokumen" autocomplete="off" value="{{ $perjanjian->dokumen_no_dokumen }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judulDokumen" class="col-sm-2 col-form-label">Judul Dokumen</label>
                            <div class="col-sm-10">
                                    <input class="form-control" placeholder="Judul Dokumen" name="judulDokumen" id="judulDokumen" autocomplete="off" value="{{ $perjanjian->dokumen->judul_dokumen }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenisDokumen" class="col-sm-2 col-form-label">Jenis Dokumen</label>
                            <div class="col-sm-10">
                                    <select class="form-control" name="jenisDokumen">
                                    <option disabled selected hidden>-Jenis Mitra-</option>
                                    @foreach ($jenisDokumens as $jenisDokumen)
                                    @if ($perjanjian->dokumen->jenis_dokumen_id = $perjanjian->dokumen->jenisDokumen->id_jenis_dokumen)
                                        <option value='{{ $jenisDokumen->id_jenis_dokumen }}' selected>
                                            {{ $jenisDokumen->nama }}
                                        </option>
                                    @else
                                        <option value='{{ $jenisDokumen->id_jenis_dokumen }}'>
                                            {{ $jenisDokumen->nama }}
                                        </option>
                                    @endif
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="manfaatDokumen" class="col-sm-2 col-form-label">Manfaat Dokumen</label>
                            <div class="col-sm-10">
                                    <textarea class="form-control" placeholder="Manfaat Dokumen (Opsional)" rows="2" name="manfaatDokumen" id="manfaatDokumen" style="resize:none;">{{ $perjanjian->dokumen->manfaat_dokumen }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="linkDokumen" class="col-sm-2 col-form-label">File Dokumen</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="linkDokumen" id="linkDokumen" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="linkDokumen" id="labelFile">{{ $perjanjian->dokumen->link_dokumen }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="idMitra" id="idMitra" class="form-control" placeholder="ID Mitra" hidden value="{{ $perjanjian->mitra->id_mitra }}">
                        </div>
                        <div class="form-group row">
                            <label for="searchPihak1" class="col-sm-2 col-form-label">Pihak 1</label>
                            <div class="col-sm-10">
                                <input class="form-control" placeholder="Pihak 1" name="pihak1" id="searchPihak1" value="{{ $perjanjian->dokumen->pihak_1 }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="searchPihak2" class="col-sm-2 col-form-label">Pihak 2</label>
                            <div class="col-sm-10">
                                <input class="form-control" placeholder="Pihak 2" name="pihak2" id="searchPihak2" value="{{ $perjanjian->dokumen->pihak_2 }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggalAwal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-10">
                                <input type="date" placeholder="Tanggal Awal" class="form-control" name="tanggalAwal" id="tanggalAwal" value="{{ $perjanjian->dokumen->tanggal_awal }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggalAkhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-10">
                                <input type="date" placeholder="Tanggal Akhir" class="form-control" name="tanggalAkhir" id="tanggalAkhir" value="{{ $perjanjian->dokumen->tanggal_akhir }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="searchSkb" class="col-sm-2 col-form-label">Nomor Induk SKB</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Cari Dokumen SKB" class="form-control" name="noSkb" id="searchSkb" value="{{ $perjanjian->dokumen->no_skb }}">
                            </div>
                        </div>
                        {{ Form::hidden('_method', 'PUT') }}
                        <a href="{{url()->previous() }}" class="btn btn-primary">Kembali</a>
                        <input type="submit" class="btn btn-primary float-right" value="Simpan Perubahan">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
    $(function() {
        // Auto Complete untuk Dokumen SKB
        $("#searchSkb").autocomplete({
            source: "{{ route('perjanjian.searchDokumenSkb') }}",
            select: function( event, ui ) {
                $("#searchSkb").val(ui.item.value);
                return false;
            }
        });

        // Auto Complete untuk Pihak 1
        $("#searchPihak1").autocomplete({
            source: "{{ route('perjanjian.searchPihak1') }}",
            select: function( event, ui ) {
                $("#searchPihak1").val(ui.item.value);
                return false;
            }
        });

        // Auto Complete untuk Pihak 2
        $("#searchPihak2").autocomplete({
            source: "{{ route('perjanjian.searchPihak2') }}",
            select: function( event, ui ) {
                $("#searchPihak2").val(ui.item.value);
                $("#idMitra").val(ui.item.id);
                return false;
            }
        });

        // Untuk mendapatkan nama file yang di browse
        $('input[type=file][name=linkDokumen]').on('change', function(e) {
        var lbl = document.getElementById('labelFile');
        var fileName = e.target.files[0].name;
        lbl.innerText = fileName;
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
