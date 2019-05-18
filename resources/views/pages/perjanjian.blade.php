@extends('layouts.app')

@section('content')
<!--Modal-->
{!! Form::open(['action' => 'PerjanjianController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Perjanjian</h4>
            </div>
            <div class="modal-body ui-front">
            {{-- <div class="row">
                <div class="col-md-6"> --}}
                    {{-- Dokumen --}}
                    <div class="form-group">
                        <input class="form-control" placeholder="Nomor Dokumen" name="nomorDokumen">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Judul Dokumen" name="judulDokumen">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="jenisDokumen">
                            <option value="" disabled selected hidden>-Jenis Dokumen-</option>
                            <option value="Surat Keputusan Bersama">Surat Keputusan Bersama</option>
                            <option value="Perjanjian Kerja Sama">Perjanjian Kerja Sama</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Manfaat Dokumen(Opsional)" rows="2" name="manfaatDokumen"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Dokumen</label>
                        <input type="file" name="linkDokumen" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="mitra" id="searchMitra" class="form-control" placeholder="Mitra" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="idMitra" id="idMitra" class="form-control" placeholder="Mitra" hidden/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Pihak 1" name="pihak1" id="searchPihak1">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Pihak 2" name="pihak2" id="searchPihak2">
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Tanggal Awal" class="form-control" name="tanggalAwal" id="tglAwal">
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Tanggal Akhir" class="form-control" name="tanggalAkhir" id="tglAkhir">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" value="createNewSkb" id="createNewSkb" name="skb">
                            <label class="custom-control-label" for="createNewSkb">Buat Dokumen Tunggal</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" value="useExistingSkb" id="useExistingSkb" name="skb" checked>
                            <label class="custom-control-label" for="useExistingSkb">Pilih SKB</label>
                        </div>
                    </div>
                    <div class="form-group" id="searchDokumenSkb">
                        <input type="text" placeholder="Search SKB Dokumen" class="form-control" name="existingSkb" id="existingSkb"/>
                    </div>
                    {{-- Dokumen End --}}
                </div>
                {{-- new dokumen skb --}}
                {{-- <div class="col-md-6" id="newSkbForm"> --}}
                    {{-- Dokumen --}}
                    {{-- <div class="form-group">
                        <input class="form-control" placeholder="Nomor Dokumen SKB" name="nomorDokumenSkb">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Judul Dokumen SKB" name="judulDokumenSkb">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="jenisDokumenSkb">
                            <option value="Surat Keputusan Bersama" disabled selected>Surat Keputusan Bersama</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Deskripsi Dokumen" rows="2" name="deskripsiDokumenSkb"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Dokumen</label>
                        <input type="file" name="linkDokumenSkb" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Pihak 1" name="pihak1Skb" id="searchPihak1">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Pihak 2" name="pihak2Skb" id="searchPihak2">
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Tanggal Awal" class="form-control" name="tanggalAwalSkb" id="tglAwal">
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Tanggal Akhir" class="form-control" name="tanggalAkhirSkb" id="tglAkhir">
                    </div> --}}
                    {{-- Dokumen End --}}
                {{-- </div> --}}
            {{-- </div>
            </div> --}}
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
                            <th>Jumlah Aktivitas PKS</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perjanjians as $perjanjian)
                        <tr class="gradeC">
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
                                {{ count($jumlahPks) }}
                            </td>
                            @php
                            $difference = date_diff(date_create($perjanjian->dokumen->tanggal_akhir), date_create(date('Y-m-d')));
                            if($difference->days > 0 && $difference->invert == 0){
                            $status = 'Expired - '.$difference->days.'d ago';
                            } else {
                            $status = 'Active - '.$difference->days.'d left';
                            }
                            @endphp
                            <td>{{ $status }}</td>
                            <td>
                                @if(strpos($perjanjian->dokumen_no_dokumen, 'SKB'))
                                {{-- @if($perjanjian->dokumen->jenis_dokumen == 'Surat Keputusan Bersama') --}}
                                <a href="/perjanjian/{{ $perjanjian->id_perjanjian }}/edit" class="btn btn-primary">Update</a>
                                @else
                                <a href="/perjanjian/{{ $perjanjian->id_perjanjian }}/edit" class="btn btn-primary disabled">Update</a>
                                @endif
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
        $("#existingSkb").autocomplete({
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
$('document').ready(function(){
    $('#newSkbForm :input').attr('disabled', true);
});
$('input[type=radio][name=skb]').on('change', function() {
    if (this.value == 'createNewSkb') {
        $('#searchDokumenSkb').hide();
        $('#newSkbForm :input').attr('disabled', false);
    } else if (this.value == 'useExistingSkb') {
        $('#searchDokumenSkb').show();
        $('#newSkbForm :input').attr('disabled', true);
    }
    // else if (this.value == 'emptySkb'){
    //     $('#searchDokumenSkb').hide();
    //     $('#newSkbForm :input').attr('disabled', true);
    // }
});
</script>
@endsection
