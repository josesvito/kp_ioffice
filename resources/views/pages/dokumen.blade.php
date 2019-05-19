@extends('layouts.app')

@section('content')
<!--Modal-->
{!! Form::open(['action' => 'DokumenController@store', 'method' => 'POST']) !!}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Dokumen</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" placeholder="Nomor Dokumen" name="nomorDokumen">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Judul Dokumen" name="judulDokumen">
                </div>
                <div class="form-group">
                    <select class="form-control" name="jenisDokumen">
                        <option disabled selected hidden>-Jenis Dokumen-</option>
                        <option value='Surat Keputusan Bersama'>Surat Keputusan Bersama</option>
                        <option value='Perjanjian Kerja Sama'>Perjanjian Kerja Sama</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Deskripsi Dokumen" rows="2" name="deskripsiDokumen"></textarea>
                </div>
                <div class="form-group">
                    <label>Upload Dokumen</label>
                    <input type="file" name="linkDokumen" />
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
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header"><h3>Dokumen</h4></div>
            <div class="card-body">
                {{-- <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Tambah Dokumen</button> --}}
                <br>
                <table class="table border" id="myTable">
                    <thead>
                        <tr>
                            <th>Nomor Dokumen</th>
                            <th>Nama Dokumen</th>
                            <th>Jenis Dokumen</th>
                            <th>Reference</th>
                            <th>Link Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumens as $dokumen)
                        <tr class="gradeC">
                            <td>{{$dokumen->no_dokumen}}</td>
                            <td>{{$dokumen->judul_dokumen}}</td>
                            <td>{{$dokumen->jenisDokumen->nama}}</td>
                            <td>
                                @if ($dokumen->no_skb == null)
                                    Belum ada SKB
                                @else
                                    {{$dokumen->no_skb}}
                                @endif
                            </td>
                            <td>
                                @if ($dokumen->link_dokumen == null)
                                    <a href=""></a>
                                @else
                                    <a href="/storage/linkDokumen/{{ $dokumen->link_dokumen }}">{{ $dokumen->link_dokumen }}</a>
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
@endsection

