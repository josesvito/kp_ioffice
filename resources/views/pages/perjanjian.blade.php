@extends('layouts.app')

@section('content')
<!--Modal-->
{!! Form::open(['action' => 'PerjanjianController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Perjanjian</h4>
            </div>
            <div class="modal-body ui-front">
                <div class="form-group">
                    <input class="form-control" name="nomorDokumen" id="nomorDokumen" autocomplete="off" required>
                    <label class="required">Nomor Dokumen</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="judulDokumen" id="judulDokumen" autocomplete="off" required>
                    <label class="required">Judul Dokumen</label>
                </div>
                <div class="form-group">
                    <select class="form-control" name="jenisDokumen" required>
                        <option disabled selected hidden value=""></option>
                        @foreach ($jenisDokumens as $jenisDokumen)
                        <option value='{{ $jenisDokumen->id_jenis_dokumen }}'>
                            {{ $jenisDokumen->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label class="required">Jenis Dokumen</label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Manfaat Dokumen (Opsional)" rows="2"
                        name="manfaatDokumen" style="resize:none;"></textarea>
                </div>
                <div class="input-group">
                    <div class="custom-file" style="position:block;">
                        <input type="file" class="custom-file-input" name="linkDokumen" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01" required>
                        <label class="custom-file-label required" for="inputGroupFile01" id="labelFile"
                            style="color:grey;">Ukuran Maksimum : 4096kb <span style="color:red;">*</span> </label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="idMitra" id="idMitra" class="form-control" placeholder="ID Mitra" hidden>
                </div>
                <div class="form-group">
                    <input class="form-control" name="pihak1" id="searchPihak1" required>
                    <label class="required">Pihak 1</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="pihak2" id="searchPihak2" required>
                    <label class="required">Pihak 2</label>
                </div>
                <div class="form-group">
                    <input type="date" placeholder="Tanggal Awal" class="form-control" name="tanggalAwal"
                        id="tanggalAwal" required>
                    <label class="required">Tanggal Awal</label>
                </div>
                <div class="form-group">
                    <input type="date" placeholder="Tanggal Akhir" class="form-control" name="tglAkhir" id="tglAkhir"
                        required>
                    <label class="required">Tanggal Akhir</label>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" value="createNewDoc" id="createNewDoc"
                            name="skb" checked>
                        <label class="custom-control-label" for="createNewDoc">Buat Dokumen Tunggal</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" value="createNewDocWithSkb"
                            id="createNewDocWithSkb" name="skb">
                        <label class="custom-control-label" for="createNewDocWithSkb">Pilih Dokumen Referensi</label>
                    </div>
                </div>
                <div class="form-group" id="searchDokumenSkb">
                    <input type="text" placeholder="Cari Dokumen SKB" class="form-control" name="noSkb" id="searchSkb">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <input type="submit" class="btn btn-primary" value="Simpan" />
            </div>
        </div>
    </div>
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
                <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Tambah
                    Perjanjian</button>
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
                            <th>Jumlah Aktivitas PKS</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perjanjians as $perjanjian)
                        @php
                        if($perjanjian->is_deleted == 1){
                        $style = 'color: rgba(0,0,0,0.5);';
                        } else {
                        $style = 'color: rgba(0,0,0,1)';
                        }
                        @endphp
                        <tr style="{{$style}}" class="gradeC">
                            <td>{{ $perjanjian->dokumen_no_dokumen }}</td>
                            <td>{{ $perjanjian->mitra->nama_mitra }}</td>
                            <td>{{ $perjanjian->dokumen->pihak_1 }}</td>
                            <td>{{ $perjanjian->dokumen->pihak_2 }}</td>
                            <td>{{ date_format(date_create($perjanjian->dokumen->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($perjanjian->dokumen->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            $jumlahPks = DB::table('dokumen')
                            ->where('no_skb', '=', $perjanjian->dokumen_no_dokumen)
                            ->get();
                            @endphp
                            <td>
                                @if ($perjanjian->dokumen->jenis_dokumen_id == 1 && $perjanjian->dokumen->no_dokumen ==
                                $perjanjian->dokumen->no_skb)
                                {{ count($jumlahPks) -1 }}
                                @else
                                @if ($perjanjian->dokumen->jenis_dokumen_id == 1)
                                {{ count($jumlahPks) }}
                                @else
                                Merupakan PKS
                                @endif
                                @endif
                            </td>
                            @php
                            $difference = date_diff(date_create($perjanjian->dokumen->tanggal_akhir),
                            date_create(date('Y-m-d')));
                            if($difference->days > 0 && $difference->invert == 0){
                            $status = 'Expired - '.$difference->days.'d ago';
                            } else {
                            $status = 'Active - '.$difference->days.'d left';
                            }
                            @endphp
                            <td>{{ $status }}</td>
                            <td>
                                <a href="/perjanjian/{{ $perjanjian->id_perjanjian }}/edit"
                                    class="btn btn-primary">Ubah</a>
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
    $(document).ready(function(){
    $('#searchDokumenSkb').hide();

    $("#searchSkb").autocomplete({
        source: "{{ route('perjanjian.searchDokumenSkb') }}",
        select: function( event, ui ) {
            $("#searchSkb").val(ui.item.value);
            return false;
        }
    });

    $("#searchPihak1").autocomplete({
        source: "{{ route('perjanjian.searchPihak1') }}",
        select: function( event, ui ) {
            $("#searchPihak1").val(ui.item.value);
            return false;
        }
    });

    $("#searchPihak2").autocomplete({
        source: "{{ route('perjanjian.searchPihak2') }}",
        select: function( event, ui ) {
            $("#searchPihak2").val(ui.item.value);
            $("#idMitra").val(ui.item.id);
            return false;
        }
    });

    $('input[type=radio][name=skb]').on('change', function() {
    if (this.value == 'createNewDoc') {
        $('#searchDokumenSkb').hide();
    } else if (this.value == 'createNewDocWithSkb') {
        $('#searchDokumenSkb').show();
    }
    });

    $('input[type=file][name=linkDokumen]').on('change', function(e) {
        var lbl = document.getElementById('labelFile');
        var fileName = e.target.files[0].name;
        lbl.innerText = fileName;
    });

    $('.placeholder').click(function() {
        $(this).siblings('input').focus();
    });
    $('.form-control').focus(function() {
        $(this).siblings('.placeholder').hide();
    });
    $('.form-control').blur(function() {
        var $this = $(this);
        if ($this.val().length == 0)
            $(this).siblings('.placeholder').show();
    });
    $('.form-control').blur();
});
</script>
@endsection