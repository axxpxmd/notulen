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
                        <a class="nav-link active show" id="tab1" onclick="pressOnChange()" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-home2"></i>Semua Data</a>
                    </li>
                    @if ($role == 'operator')
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#tambah-data" role="tab"><i class="icon icon-plus"></i>Tambah Data</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content my-3" id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="card no-b mb-2">
                    <div class="card-body">
                        <div class="col-md-8 container">
                            <div class="row mb-2">
                                <label for="id_opd_filter" class="col-form-label s-12 col-md-2 text-right font-weight-bolder">OPD</label>
                                <div class="col-sm-8">
                                    <select id="id_opd_filter" class="select2 form-control r-0 s-12">
                                        <option value="">Semua</option>
                                        @foreach ($opds as $i)
                                            <option value="{{ $i->id }}" {{ $id_opd == $i->id ? 'selected' : '' }}>{{ $i->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-form-label s-12 col-md-2 text-right font-weight-bolder">Tanggal Agenda</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" placeholder="MM/DD/YYYY" value="{{ $today }}" name="tanggal_mulai" id="tanggal_mulai" class="form-control r-0 light s-12 mb-5-m" autocomplete="off"/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date" placeholder="MM/DD/YYYY" value="{{ $today }}" name="tanggal_akhir" id="tanggal_akhir" class="form-control r-0 light s-12" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row mb-2">
                                <label for="status_filter" class="col-form-label s-12 col-md-2 text-right font-weight-bolder">Status</label>
                                <div class="col-sm-8">
                                    <select id="status_filter" class="select2 form-control r-0 s-12">
                                        <option value="">Semua</option>
                                        <option value="0">Belum Ditinjau</option>
                                        <option value="1">Sudah Ditinjau</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <button class="btn btn-success btn-sm" onclick="pressOnChange()"><i class="icon-filter mr-2"></i>Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th width="30%">Judul Agenda</th>
                                            <th width="20%">Tempat</th>
                                            <th width="10%">Tanggal</th>
                                            <th width="10%">Jumlah Peserta</th>
                                            <th width="10%">File Notulen</th>
                                            <th width="10%">Status</th>
                                            <th width="5%"></th>
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
                                                    <textarea type="text" name="acuan" id="acuan" rows="3" class="form-control s-12" autocomplete="off" placeholder="No Surat / Undangan" required></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="file_acuan" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">File Acuan</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="file_acuan" id="file_acuan" class="form-control s-12"/>
                                                    <span class="text-danger fs-10">Format : PDF, JPG, PNG, JPEG | Max : 2MB</span>
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
                                                <div class="col-sm-4">
                                                    <input type="date" name="tanggal_agenda" id="tanggal_agenda" onchange="getDayName()" class="form-control s-12" autocomplete="off" required/>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly id="dayName" class="form-control s-12" autocomplete="off" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="waktu" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Waktu <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="time" name="waktu" id="waktu"  class="form-control s-12" autocomplete="off" required/>
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
                                                    <input type="file" name="file_notulen" id="file_notulen" class="form-control s-12" required/>
                                                    <span class="text-danger fs-10">Format : PDF, JPG, PNG, JPEG | Max : 2MB</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="foto_rapat" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Foto Rapat</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="foto_rapat[]" id="foto_rapat" multiple class="form-control s-12"/>
                                                    <span class="text-danger fs-10">Format : PDF, JPG, PNG, JPEG | Max : 2MB</span>
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
@include('layouts.loading')
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
                data.id_opd_filter = $('#id_opd_filter').val();
                data.tanggal_mulai = $('#tanggal_mulai').val();
                data.tanggal_akhir = $('#tanggal_akhir').val();
                data.status_filter = $('#status_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'judul_agenda', name: 'judul_agenda'},
            {data: 'tempat', name: 'tempat'},
            {data: 'tanggal_agenda', name: 'tanggal_agenda', className: 'text-center'},
            {data: 'jumlah_peserta', name: 'jumlah_peserta', className: 'text-center'},
            {data: 'file_notulen', name: 'file_notulen', className: 'text-center'},
            {data: 'status', name: 'status', className: 'text-center'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
        ]
    });

    function getDayName(){
        date = $('#tanggal_agenda').val();
        const d = new Date(date);
        const weekday = ["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"];

        $('#dayName').val(weekday[d.getDay()])
    }

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

    function pressOnChange(){
        table.api().ajax.reload();
    }

    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('.tambahan').remove();
    });

    function reset(){
        $('#form').trigger('reset');
    }

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action').attr('disabled', true);
            $('#loading').modal('show');
            url = "{{ route($route.'store') }}",
            $.ajax({
                url : url,
                type : 'POST',
                data: new FormData(($(this)[0])),
                contentType: false,
                processData: false,
                success : function(data) {
                    $('#loading').modal('toggle');
                    $.confirm({
                        title: 'Success',
                        content: data.message,
                        icon: 'icon icon-check',
                        theme: 'modern',
                        animation: 'scale',
                        autoClose: 'ok|3000',
                        type: 'green',
                        buttons: {
                            ok: {
                                text: "ok!",
                                btnClass: 'btn-primary',
                                keys: ['enter'],
                                action: function () {
                                    window.location.href = "{{ route('notulen')}}";
                                }
                            }
                        }
                    });
                },
                error : function(data){
                    $('#loading').modal('toggle');
                    err = '';
                    respon = data.responseJSON;
                    if(respon.errors){
                        $.each(respon.errors, function( index, value ) {
                            err = err + "<li>" + value +"</li>";
                        });
                    }
                    $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                    $('#action').removeAttr('disabled');
                }
            });
            return false;
        }
        $(this).addClass('was-validated');
    });

    function remove(id){
        $.confirm({
            title: '',
            content: 'Apakah Anda yakin akan menghapus data ini ?',
            icon: 'icon icon-question amber-text',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        $.post("{{ route($route.'destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
                            $('#dataTable').DataTable().ajax.reload();
                            $.confirm({
                                title: 'Sukses',
                                content: data.message,
                                icon: 'icon icon-check',
                                theme: 'modern',
                                closeIcon: true,
                                animation: 'scale',
                                autoClose: 'ok|3000',
                                type: 'green',
                                buttons: {
                                    ok: {
                                        text: "ok!",
                                        btnClass: 'btn-primary',
                                        keys: ['enter']
                                    }
                                }
                            });
                        }, "JSON").fail(function(){
                            reload();
                        });
                    }
                },
                cancel: function(){}
            }
        });
    }
</script>
@endsection
