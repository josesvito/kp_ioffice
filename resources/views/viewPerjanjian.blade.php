<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Perjanjian</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Perjanjian
            </div>
            <div class="panel-body">
                <!--Modal-->
                <form action="{{action('PerjanjianController@store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Tambah Perjanjian</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <select class="form-control" name="mitra">
                                            <option disabled selected hidden>-Mitra-</option>
                                            @foreach ($mitras as $mitra)
                                            <option value="{{ $mitra->id_mitra }}">
                                                {{ $mitra->nama_mitra }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Pihak 1" name="pihak1">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Pihak 2" name="pihak2">
                                    </div>
                                    <div class="form-group">
                                        {{-- <input type="text" class="form-control" name="nomorDokumen" placeholder="Nomor Dokumen">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                        </button>
                                    </span> --}}
                                        <select class="form-control" name="nomorDokumen">
                                            <option disabled selected hidden>-Nomor Dokumen-</option>
                                            @foreach ($dokumens as $dokumen)
                                            <option value="{{ $dokumen->no_dokumen }}">
                                                {{ $dokumen->no_dokumen }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" placeholder="Tanggal Awal" class="form-control" name="tanggalAwal">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" placeholder="Tanggal Akhir" class="form-control" name="tanggalAkhir">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="aktivitasSkb">
                                            <option value="" disabled selected hidden>-Aktivitas SKB-</option>
                                            @foreach ($SKBs as $SKB)
                                            <option value="{{ $SKB->id_aktivitas }}">
                                                {{ $SKB->id_aktivitas.' - '.$SKB->nama_aktivitas }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="aktivitasPks">
                                            <option value="" disabled selected hidden>-Aktivitas PKS-</option>
                                            @foreach ($PKSs as $PKS)
                                            <option value="{{ $PKS->id_aktivitas }}">
                                                {{ $PKS->id_aktivitas.' - '.$PKS->nama_aktivitas }}
                                            </option>
                                            @endforeach
                                        </select>
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
                </form>

                <br>
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
                        @foreach ($perjanjians as $perjanjian)
                        <tr class="gradeC">
                            <td>{{ $perjanjian->Dokumen_no_dokumen }}</td>
                            <td>{{ $perjanjian->mitra->nama_mitra }}</td>
                            <td>{{ $perjanjian->pihak_1 }}</td>
                            <td>{{ $perjanjian->pihak_2 }}</td>
                            <td>{{ date_format(date_create($perjanjian->tanggal_awal), 'd F Y') }}</td>
                            <td>{{ date_format(date_create($perjanjian->tanggal_akhir), 'd F Y') }}</td>
                            <td>{{ $perjanjian->pks->nama_aktivitas }}</td>
                            <td>{{ $perjanjian->status }}</td>
                            <td>
                                <a href="/perjanjian/{{ $perjanjian->id_perjanjian }}/edit" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                        @endforeach

                        {{-- <tr class="gradeU">
                            <td>Other browsers</td>
                            <td>All others</td>
                            <td>-</td>
                            <td class="center">-</td>
                            <td class="center">U</td>
                        </tr> --}}
                    </tbody>
                </table>
                <!-- /.table-responsive -->
                <div class="well">
                    <!--                    <h4>DataTables Usage Information</h4>
                                        <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                        <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>-->
                    <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Tambah Perjanjian</button>
                    <button class="btn btn-lg btn-success btn-block">Import from Excel</button>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Kitchen Sink
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Basic Table
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Striped Rows
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Bordered Table
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive table-bordered">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Hover Rows
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Context Classes
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr class="info">
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr class="warning">
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            <tr class="danger">
                                <td>4</td>
                                <td>John</td>
                                <td>Smith</td>
                                <td>@jsmith</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->