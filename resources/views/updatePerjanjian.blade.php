<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Update Perjanjian</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{action('PerjanjianController@update', $perjanjian->id_perjanjian) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" name="mitra">
                            @foreach ($mitras as $mitra)
                            @if ($perjanjian->Mitra_id_mitra == $mitra->id_mitra)
                            <option value="{{ $mitra->id_mitra }}" selected>
                                {{ $mitra->nama_mitra }}
                            </option>
                            @else
                            <option value="{{ $mitra->id_mitra }}">
                                {{ $mitra->nama_mitra }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Pihak 1" name="pihak1" value="{{ $perjanjian->pihak_1 }}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Pihak 2" name="pihak2" value="{{ $perjanjian->pihak_2 }}">
                    </div>
                    <div class="form-group">
                        {{-- <input type="text" class="form-control" name="nomorDokumen" placeholder="Nomor Dokumen">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                        </button>
                    </span> --}}
                        <select class="form-control" name="nomorDokumen">
                            @foreach ($dokumens as $dokumen)
                            @if ($perjanjian->Dokumen_no_dokumen == $dokumen->no_dokumen)
                            <option value="{{ $dokumen->no_dokumen }}" selected>
                                {{ $dokumen->no_dokumen }}
                            </option>
                            @else
                            <option value="{{ $dokumen->no_dokumen }}">
                                {{ $dokumen->no_dokumen }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Tanggal Awal" class="form-control" name="tanggalAwal" value="{{ $perjanjian->tanggal_awal }}">
                    </div>
                    <div class="form-group">
                        <input type="date" placeholder="Tanggal Akhir" class="form-control" name="tanggalAkhir" value="{{ $perjanjian->tanggal_akhir }}">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="aktivitasSkb">
                            @foreach ($SKBs as $SKB)
                            @if ($perjanjian->Aktivitas_SKB_id_aktivitas == $SKB->id_aktivitas)
                            <option value="{{ $SKB->id_aktivitas }}" selected>
                                {{ $SKB->id_aktivitas.' - '.$SKB->nama_aktivitas }}
                            </option>
                            @else
                            <option value="{{ $SKB->id_aktivitas }}">
                                {{ $SKB->id_aktivitas.' - '.$SKB->nama_aktivitas }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="aktivitasPks">
                            @foreach ($PKSs as $PKS)
                            @if ($perjanjian->Aktivitas_PKS_id_aktivitas == $PKS->id_aktivitas)
                            <option value="{{ $PKS->id_aktivitas }}" selected>
                                {{ $PKS->id_aktivitas.' - '.$PKS->nama_aktivitas }}
                            </option>
                            @else
                            <option value="{{ $PKS->id_aktivitas }}">
                                {{ $PKS->id_aktivitas.' - '.$PKS->nama_aktivitas }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="_method" value="put">
                    <a href="/perjanjian" class="btn btn-primary">Back</a>
                    <input type="submit" class="btn btn-primary pull-right" value="Save changes">
                </form>
            </div>
        </div>
    </div>
</div>