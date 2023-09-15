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
                                            <th width="5%">No</th>
                                            <th width="20%">Nama</th>
                                            <th width="60%">OPD</th>
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
                                                <select class="select2 form-control r-0 s-12" id="id_opd" name="id_opd" autocomplete="off" required>
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
            url: "{{ route('master-role.pengguna.index') }}",
            method: 'GET',
            data: function (data) {
                // 
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'nama', name: 'nama'},
            {data: 'opd', name: 'opd', orderable: false, searchable: false},
            {data: 'username', name: 'role',  orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
        ]
    });

    $('#id_opd').on('change', function(){
        val = $(this).val();
        option = "<option value=''>&nbsp;</option>";
        if(val == ""){
            $('#id_bidang').html(option);
        }else{
            $('#id_bidang').html("<option value=''>Loading...</option>");
            url = "{{ route('master-role.getBidangByOpd', ':id') }}".replace(':id', val);
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
            url = "{{ route('master-role.getSubBidangByBidang', ':id') }}".replace(':id', val);
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
            if(role_id == 13) {
                $('#bidang_display').hide(); 
                $('#sub_bidang_display').hide(); 
            } else {
                $('#bidang_display').show(); 
                $('#sub_bidang_display').show(); 
            } 
        });
    });

    function add(){
        save_method = "add";
        $('#form').trigger('reset');
        $('input[name=_method]').val('POST');
        $('#reset').show();
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
                    $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                    table.api().ajax.reload();
                    add();    
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
</script>
@endsection
