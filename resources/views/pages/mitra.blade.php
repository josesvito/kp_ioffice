@extends('layouts.app')

@section('content')
<!--Modal-->
{!! Form::open(['action' => 'MitraController@store', 'method' => 'POST']) !!}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Mitra</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" placeholder="Nama Mitra" name="namaMitra">
                </div>
                <div class="form-group">
                    <select class="form-control" name="kategoriMitra">
                        <option disabled selected hidden>-Kategori Mitra-</option>
                        @foreach ($kategoriMitras as $kategoriMitra)
                        <option value='{{ $kategoriMitra->id_kategori_mitra }}'>
                            {{ $kategoriMitra->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="jenisMitra">
                        <option disabled selected hidden>-Jenis Mitra-</option>
                        @foreach ($jenisMitras as $jenisMitra)
                        <option value='{{ $jenisMitra->id_jenis_mitra }}'>
                            {{ $jenisMitra->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="E-mail" name="emailMitra">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Negara" name="negaraMitra">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Provinsi" name="provinsiMitra">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Kota" name="kotaMitra">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Alamat" name="alamatMitra">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Kode Pos" name="kodePosMitra">
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
                <h3>Mitra</h4>
            </div>
            <div class="card-body">
                <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Tambah Mitra</button>
                <br>
                <table class="table border" id="myTable">
                    <thead>
                        <tr>
                            <th>Nama Mitra</th>
                            <th>Kategori Mitra</th>
                            <th>Jenis Mitra</th>
                            <th>Jumlah Aktivitas PKS</th>
                            {{-- <th>Aktivitas PKS</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mitras as $mitra)
                        <tr class="gradeC">
                            <td>{{$mitra->nama_mitra}}</td>
                            <td>{{$mitra->jenisMitra->nama}}</td>
                            <td>{{$mitra->kategoriMitra->nama}}</td>
                            @php
                                $jumlahPks = DB::table('dokumen')
                                            ->join('perjanjian', 'no_dokumen', '=', 'dokumen_no_dokumen')
                                            ->join('mitra', 'Mitra_id_mitra', '=', 'id_mitra')
                                            ->where('jenis_dokumen_id', '=', 2)
                                            ->where('id_mitra', '=', $mitra->id_mitra)
                                            ->get();
                            @endphp
                            <td>
                                {{ count($jumlahPks) }}
                            </td>
                            {{-- <td> --}}
                                {{-- Isi Query Select Aktivitas PKS where id_mitra = ? --}}
                            {{-- </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
