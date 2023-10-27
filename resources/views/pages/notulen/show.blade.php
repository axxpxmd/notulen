@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h4>
                        <i class="icon icon-document-list mr-2"></i>
                        Menampilkan {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route('notulen') }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-document-list"></i>Data WP</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content my-3" id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-2">
                            <h6 class="card-header font-weight-bold">Data Notulen</h6>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12 font-weight-bold">OPD :</label>
                                        <label class="col-md-8 s-12">{{ $data->opd->nama }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12 font-weight-bold">Bidang :</label>
                                        <label class="col-md-8 s-12">{{ $data->bidang->nama }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12 font-weight-bold">Sub Bidang :</label>
                                        <label class="col-md-8 s-12">{{ $data->subBidang->nama }}</label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12 font-weight-bold">Acuan :</label>
                                        <label class="col-md-8 s-12">{{ $data->acuan }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 text-right s-12 font-weight-bold">File Acuan :</label>
                                        <label class="col-md-8 s-12">
                                            <button class="btn btn-sm btn-primary mr-1 py-1 px-2" data-toggle="modal" data-target="#preview-file-acuan"><i class="icon-document-file-pdf2 mr-2"></i>Lihat File</button>
                                        </label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-md-4 text-right s-12 font-weight-bold">Judul Agenda :</label>
                                                <label class="col-md-8 s-12">{{ $data->judul_agenda }}</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 text-right s-12 font-weight-bold">Tanggal Agenda :</label>
                                                <label class="col-md-8 s-12">{{ Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal_agenda)->isoFormat('D MMMM Y') }}</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 text-right s-12 font-weight-bold">Waktu Agenda :</label>
                                                <label class="col-md-8 s-12">{{ $data->waktu }}</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 text-right s-12 font-weight-bold">Tempat :</label>
                                                <label class="col-md-8 s-12">{{ $data->tempat }}</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 text-right s-12 font-weight-bold">Keterangan :</label>
                                                <label class="col-md-8 s-12">{{ $data->keterangan }}</label>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 text-right s-12 font-weight-bold">Status :</label>
                                                <label class="col-md-8 s-12">
                                                    @if ($data->status == 1)
                                                        <span class="badge badge-success">Disetujui</span>
                                                    @elseif($data->status == 2)
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @elseif($data->status == 0)
                                                        <span class="badge badge-warning">Belum Ditinjau</span>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-4 text-right s-12 font-weight-bold">File Notulen :</label>
                                                <label class="col-md-8 s-12">
                                                    <button class="btn btn-sm btn-primary mr-1 py-1 px-2" data-toggle="modal" data-target="#preview-file-notulen"><i class="icon-document-file-pdf2 mr-2"></i>Lihat File</button>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-md-2 text-right s-12 font-weight-bold">Peserta Rapat :</label>
                                                <label class="col-md-8 s-12">
                                                    @foreach ($pesertas as $i)
                                                        <li class="mb-1">{{ $i->nama }}</li>
                                                    @endforeach
                                                </label>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-2 text-right s-12 font-weight-bold">Foto Rapat :</label>
                                                <label class="col-md-8 s-12">
                                                    @foreach ($foto_rapats as $i)
                                                        <li class="mb-1">
                                                            <a href="{{ config('app.sftp_src').'foto-rapat/'.$i->foto }}">{{ $i->foto }}</a>
                                                        </li>
                                                    @endforeach
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($role == 'verifikator')
                        <div class="card mt-2">
                            <h6 class="card-header font-weight-bold">Form Peninjauan</h6>
                            <div class="card-body">
                                <form class="needs-validation" action="{{ route('notulen.updateStatus', $data->id) }}" method="POST" novalidate>
                                    @csrf
                                    @include('layouts.alerts')
                                    <div class="row mb-2">
                                        <label class="col-form-label s-12 col-sm-2 text-right">Status<span class="text-danger ml-1">*</span></label>
                                        <div class="col-md-4">
                                            <select class="select2 form-control r-0 s-12" id="status" name="status" autocomplete="off" required>
                                                <option value="">Pilih</option>
                                                <option value="1">Disetujui</option>
                                                <option value="2">Tolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <label for="pesan" class="col-form-label s-12 col-sm-2 text-right">Alasan</label>
                                        <div class="col-md-4">
                                            <textarea type="text" rows="3" name="pesan" id="pesan" placeholder="Berikan Alasan" class="form-control r-0 s-12" autocomplete="off" >{{ $data->pesan }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-sm-2"></label>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="icon-save mr-2"></i>Perbarui Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Preview File -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="preview-file-notulen" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <iframe src="{{ config('app.sftp_src').'file-notulen/'.$data->file_notulen }}" style="margin-left: -160px !important" width="850px" height="940px"></iframe>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="preview-file-acuan" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <iframe src="{{ config('app.sftp_src').'file-acuan/'.$data->file_acuan }}" style="margin-left: -160px !important" width="850px" height="940px"></iframe>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('#status').val("{{ $data->status }}");
    $('#status').trigger('change.select2');
</script>
@endsection
