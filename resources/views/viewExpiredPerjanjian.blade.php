<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Warning List</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Perjanjian Warned
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Dokumen</th>
                            <th>Mitra</th>
                            <th>Pihak 1</th>
                            <th>Pihak 2</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Aktivitas PKS</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wPerjanjian as $term)
                        <tr class="gradeC">
                            <td>{{ $term->dokumen_no_dokumen }}</td>
                            <td>{{ $term->mitra->nama_mitra }}</td>
                            <td>{{ $term->pihak_1 }}</td>
                            <td>{{ $term->pihak_2 }}</td>
                            <td>{{ date_format(date_create($term->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($term->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            if($term->Aktivitas_PKS_id_aktivitas == NULL){
                            $pksName = '';
                            } else {
                            $pksName = $term->pks->nama_aktivitas;
                            }
                            @endphp
                            <td>{{ $pksName }}</td>
                            <td>{{ $term->status }}</td>
                            <td>
                                <a href="/perjanjian/{{ $term->id_perjanjian }}/edit" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Perjanjian Expired
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>

                            <th>Dokumen</th>
                            <th>Mitra</th>
                            <th>Pihak 1</th>
                            <th>Pihak 2</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Aktivitas PKS</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ePerjanjian as $term)
                        <tr class="gradeC">
                            <td>{{ $term->dokumen_no_dokumen }}</td>
                            <td>{{ $term->mitra->nama_mitra }}</td>
                            <td>{{ $term->pihak_1 }}</td>
                            <td>{{ $term->pihak_2 }}</td>
                            <td>{{ date_format(date_create($term->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($term->tanggal_akhir), 'd F Y') }}</td>
                            @php
                            if($term->Aktivitas_PKS_id_aktivitas == NULL){
                            $pksName = '';
                            } else {
                            $pksName = $term->pks->nama_aktivitas;
                            }
                            @endphp
                            <td>{{ $pksName }}</td>
                            <td>{{ $term->status }}</td>
                            <td>
                                <a href="/perjanjian/{{ $term->id_perjanjian }}/edit" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->