@extends('layouts.app')

@section('content')
<!--Modal-->
{!! Form::open(['action' => 'PesertaController@store', 'method' => 'POST']) !!}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Peserta</h4>
            </div>
            <div class="modal-body ui-front">
                <div class="form-group">
                    <input class="form-control" placeholder="Perjanjian" id="searchPerjanjian">
                    <input hidden name="idPerjanjian" id="idPerjanjian">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="NIP" name="nip">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Nama" name="nama">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="E-mail" type="email" name="email">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Nomor Telepon" name="nomorTelepon">
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
            <div class="card-header">
                <h3>Peserta</h4>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Tambah
                    Peserta ke Perjanjian</button>
                <br>
                <table class="table border" id="myTable">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Peserta</th>
                            <th>Email Peserta</th>
                            <th>Telepon</th>
                            <th>Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($relasis as $relasi)
                        <tr class="gradeC">
                            <td>{{ $relasi->no_induk_peserta }}</td>
                            <td>{{ $relasi->nama_peserta }}</td>
                            <td>{{ $relasi->email_peserta }}</td>
                            <td>{{ $relasi->no_telepon }}</td>
                            <td>{{ $relasi->judul_dokumen }}</td>
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
        $("#searchPerjanjian").autocomplete({
            source: "{{ route('peserta.searchPerjanjian') }}",
                                select: function( event, ui ) {
                                $( "#searchPerjanjian" ).val( ui.item.value );
                                $( "#idPerjanjian" ).val( ui.item.id );
                                return false;
                                }
                                });
                                });
</script>

@endsection
