@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-user-o mr-2"></i>
                        {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" onclick="pressOnChange()" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-home2"></i>Semua Data</a>
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
                <div class="card no-b mb-2">
                    <div class="card-body">
                        <div class="col-md-8 container">
                            <div class="row mb-2">
                                <label for="opd" class="col-form-label s-12 col-md-2 text-right font-weight-bolder">OPD</label>
                                <div class="col-sm-8">
                                    <select id="opd_id_filter" class="select2 form-control r-0 s-12">
                                        <option value="0">Semua</option>
                                        @foreach ($opds as $i)
                                            <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="opd" class="col-form-label s-12 col-md-2 text-right font-weight-bolder">Role</label>
                                <div class="col-sm-8">
                                    <select id="role_id_filter" class="select2 form-control r-0 s-12">
                                        <option value="0">Semua</option>
                                        @foreach ($roles as $i)
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
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
                                    <table id="dataTable" class="table display nowrap table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th width="20%">Nama</th>
                                            <th width="50%">OPD</th>
                                            <th width="10%">Role</th>
                                            <th width="10%">Nama Login</th>
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
                                    <div class="col-md-6">
                                        <div class="row mb-2">
                                            <label class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Role <span class="text-danger ml-1">*</span></label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control r-0 s-12" id="role_id" name="role_id" autocomplete="off">
                                                    <option value="">Pilih</option>
                                                    @foreach ($roles as $i)
                                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="username" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Username <span class="text-danger ml-1">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="username" id="username"  class="form-control s-12" autocomplete="off" required/>
                                            </div>
                                        </div>
                                         <div class="row mb-2">
                                            <label for="password" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Password <span class="text-danger ml-1">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" id="password" class="form-control s-12" autocomplete="off" required/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mb-2">
                                            <label for="nama" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Nama <span class="text-danger ml-1">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nama" id="nama"  class="form-control s-12" autocomplete="off" required/>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-form-label s-12 col-sm-3 text-right font-weight-bold">OPD / Instansi <span class="text-danger ml-1">*</span></label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control r-0 s-12" id="id_opd" name="id_opd" autocomplete="off">
                                                    <option value="">Pilih</option>
                                                    @foreach ($opds as $i)
                                                        <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="bidang_display" class="row mb-2">
                                            <label class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Bidang</label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control r-0 s-12" id="id_bidang" name="id_bidang" autocomplete="off">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="sub_bidang_display" class="row mb-2">
                                            <label class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Sub Bidang</label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control r-0 s-12" id="id_sub_bidang" name="id_sub_bidang" autocomplete="off">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="foto" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Foto</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="foto" id="foto" class="form-control s-12"/>
                                                <span class="text-danger fs-10">Format : JPG, PNG, JPEG | Max : 2MB</span>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label class="col-sm-3"></label>
                                            <div class="col-md-9">
                                                <button type="submit" id="action" class="btn btn-block btn-primary btn-sm"><i class="icon-save mr-2"></i>Simpan Data</button>
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
            url: "{{ route('master-role.pengguna.index') }}",
            method: 'GET',
            data: function (data) {
                data.opd_id_filter  = $('#opd_id_filter').val();
                data.role_id_filter = $('#role_id_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'nama', name: 'nama'},
            {data: 'opd', name: 'opd'},
            {data: 'role', name: 'role'},
            {data: 'username', name: 'username'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
        ]
    });

    function pressOnChange(){
        table.api().ajax.reload();
    }

    $('#id_opd').on('change', function(){
        val = $(this).val();
        option = "<option value=''>&nbsp;</option>";
        if(val == ""){
            $('#id_bidang').html(option);
        }else{
            $('#id_bidang').html("<option value=''>Loading...</option>");
            url = "{{ route('getBidangByOpd', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.nama +"</li>";
                    });
                    $('#id_bidang').empty().html(option);
                    $('#id_sub_bidang').empty().html(option);

                    $("#id_bidang").val($("#id_bidang option:first").val()).trigger("change.select2");
                }else{
                    $('#id_bidang').html(option);
                }
            }, 'JSON');
        }
    });

    $('#id_bidang').on('change', function(){
        val = $(this).val();
        option = "<option value=''>&nbsp;</option>";
        if(val == ""){
            $('#id_sub_bidang').html(option);
        }else{
            $('#id_sub_bidang').html("<option value=''>Loading...</option>");
            url = "{{ route('getSubBidangByBidang', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.nama +"</li>";
                    });
                    $('#id_sub_bidang').empty().html(option);

                    $("#id_sub_bidang").val($("#id_sub_bidang option:first").val()).trigger("change.select2");
                }else{
                    $('#id_sub_bidang').html(option);
                }
            }, 'JSON');
        }
    });

    $(function() {
        $('#role_id').change(function(){
            var role_id = $('#role_id').val();
            if(role_id == 15) {
                $('#bidang_display').hide();
                $('#sub_bidang_display').hide();
            } else {
                $('#bidang_display').show();
                $('#sub_bidang_display').show();
            }
        });
    });

    function reset(){
        $('#form').trigger('reset');
        $('#id_opd').val(0);
        $('#id_opd').trigger('change.select2');
        $('#id_bidang').val(0);
        $('#id_bidang').trigger('change.select2');
        $('#id_sub_bidang').val(0);
        $('#id_sub_bidang').trigger('change.select2');
        $('#role_id').val(0);
        $('#role_id').trigger('change.select2');
    }

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            url = "{{ route($route.'store') }}",
            $.ajax({
                url : url,
                type : 'POST',
                data: new FormData(($(this)[0])),
                contentType: false,
                processData: false,
                success : function(data) {
                    reset();
                    $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                    table.api().ajax.reload();
                },
                error : function(data){
                    err = '';
                    respon = data.responseJSON;
                    if(respon.errors){
                        $.each(respon.errors, function( index, value ) {
                            err = err + "<li>" + value +"</li>";
                        });
                    }
                    $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
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
                            table.api().ajax.reload();
                            $.confirm({
                                title: 'Success',
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
