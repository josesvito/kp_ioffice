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
                    <input class="form-control" name="namaMitra" id="namaMitra" autocomplete="off" required>
                    <label class="required">Nama Mitra</label>
                </div>
                <div class="form-group">
                    <select class="form-control" name="kategoriMitra" id="kategoriMitra" required>
                        <option disabled selected hidden value=''></option>
                        @foreach ($kategoriMitras as $kategoriMitra)
                        <option value='{{ $kategoriMitra->id_kategori_mitra }}'>
                            {{ $kategoriMitra->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label class="required">Kategori Mitra</label>
                </div>
                <div class="form-group">
                    <select class="form-control" name="jenisMitra" id="jenisMitra" required>
                        <option disabled selected hidden value=''></option>
                        @foreach ($jenisMitras as $jenisMitra)
                        <option value='{{ $jenisMitra->id_jenis_mitra }}'>
                            {{ $jenisMitra->nama }}
                        </option>
                        @endforeach
                    </select>
                    <label class="required">Jenis Mitra</label>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="emailMitra" id="emailMitra" autocomplete="off" required>
                    <label class="required">Email Mitra</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="nomorTeleponMitra" id="nomorTeleponMitra" autocomplete="off" required>
                    <label class="required">Nomor Telepon Mitra</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="negaraMitra" id="negaraMitra" autocomplete="off" required>
                    <label class="required">Negara Mitra</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="provinsiMitra" id="provinsiMitra" autocomplete="off" required>
                    <label class="required">Provinsi Mitra</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="kotaMitra" id="kotaMitra" autocomplete="off" required>
                    <label class="required">Kota Mitra</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="alamatMitra" id="alamatMitra" autocomplete="off" required>
                    <label class="required">Alamat Mitra</label>
                </div>
                <div class="form-group">
                    <input class="form-control" name="kodePosMitra" id="kodePosMitra" autocomplete="off" required>
                    <label class="required">Kode Pos Mitra</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <input type="submit" class="btn btn-primary" value="Simpan" />
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mitras as $mitra)
                        <tr class="gradeC">
                            <td>{{ $mitra->nama_mitra }}</td>
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
                            <td>
                                <a href="/mitra/{{ $mitra->id_mitra }}/detail" class="btn btn-primary">Detail</a>
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
