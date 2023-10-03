@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-clipboard-list mr-2"></i>
                        {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-home2"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#tambah-data" role="tab"><i class="icon icon-plus"></i>Tambah Data</a>
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
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th>No</th>
                                            <th>Judul Agenda</th>
                                            <th>Tanggal</th>
                                            <th></th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane animated fadeInUpShort" id="tambah-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert"></div>
                        <div class="card">
                            <h6 class="card-header"><strong>Tambah Data</strong></h6>
                            <div class="card-body">
                                <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                                    {{ method_field('POST') }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row mb-2">
                                                <label for="acuan" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Dasar Acuan <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="acuan" id="acuan"  class="form-control s-12" autocomplete="off" placeholder="No Surat / Undangan" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="file_acuan" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">File Acuan</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="file_acuan" id="file_acuan" class="form-control s-12"/>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row mb-2">
                                                <label for="judul_agenda" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Agenda <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="judul_agenda" id="judul_agenda"  class="form-control s-12" autocomplete="off" placeholder="Judul Agenda / Rapat" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="tanggal_agenda" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Tanggal <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="tanggal_agenda" id="tanggal_agenda"  class="form-control s-12" autocomplete="off" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="waktu" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Waktu</label>
                                                <div class="col-sm-9">
                                                    <input type="time" name="waktu" id="waktu"  class="form-control s-12" autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="tempat" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Tempat <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="tempat" id="tempat"  class="form-control s-12" autocomplete="off" placeholder="Tempat Rapat" required/>
                                                </div>
                                            </div>
                                              <div class="row mb-2">
                                                <label for="keterangan" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Keterangan</label>
                                                <div class="col-sm-9">
                                                    <textarea name="keterangan" id="keterangan"  class="form-control s-12" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-2">
                                                <label for="file_notulen" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Notulen <span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="file_notulen" id="file_notulen" class="form-control s-12"/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="foto_rapat" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Foto Rapat</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="foto_rapat" id="foto_rapat" multiple class="form-control s-12"/>
                                                </div>
                                            </div>
                                            <div id="peserta">
                                                <div class="row mb-2">
                                                    <label for="peserta" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Peserta <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="peserta[]" id="peserta" placeholder="Masukan nama peserta" class="form-control s-12">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <a href="#"><i class="icon icon-plus text-success" id="add-pengajuan"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <label class="col-sm-3"></label>
                                                <div class="col-md-9">
                                                    <button type="submit" id="action" class="btn btn-block btn-primary btn-sm"><i class="icon-save mr-2"></i>Simpan Data</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.masterRole.pengguna.show')
@endsection
@section('script')
<script type="text/javascript">
    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route('notulen') }}",
            method: 'GET',
            data: function (data) {
                // 
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'judul_agenda', name: 'judul_agenda'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
        ]
    });

    $("#add-pengajuan").click(function () {
        $("#peserta").append(
            `
            <div class="tambahan row mb-2">
                <label for="peserta" class="col-form-label s-12 col-sm-3 text-right font-weight-bold"></label>
                <div class="col-sm-8">
                    <input type="text" name="peserta[]" id="peserta" placeholder="Masukan nama peserta" class="form-control s-12">
                </div>
                <div class="col-sm-1">
                    <a href="#"><i class="icon icon-minus text-danger remove-input-field" id="add-pengajuan"></i></a>
                </div>
            </div>
            `
        );
    });

    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('.tambahan').remove();
    });
</script>
@endsection
