@extends('layouts.app')

@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!--Modal-->
                {!! Form::open(['action' => 'PesertaController@store', 'method' => 'POST']) !!}
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Tambah Peserta</h4>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="NIP" name="nip">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Nama" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" type ="email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Nomor Telepon" name="nomorTelepon">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Save changes"/>
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
                            <div class="card-header"><h3>Peserta</h4></div>
                            <div class="card-body">
                                <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Tambah Peserta</button>
                                <br>
                                <table class="table border" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama Peserta</th>
                                            <th>Email Peserta</th>
                                            <th>Telepon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesertas as $peserta)
                                            <tr class="gradeC">
                                                <td>{{ $peserta->no_induk_peserta }}</td>
                                                <td>{{ $peserta->nama_peserta }}</td>
                                                <td>{{ $peserta->email_peserta }}</td>
                                                <td>{{ $peserta->no_telepon }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

