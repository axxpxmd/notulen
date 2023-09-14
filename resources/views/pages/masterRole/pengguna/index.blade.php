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
                                            <th width="10%">Nama</th>
                                            <th width="70%">OPD</th>
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
                                    <div class="form-row form-inline">
                                        <div class="col-md-8">
                                            <div class="form-group mb-1">
                                                <label for="role_id" class="form-control label-input-custom col-md-2">Role<span class="text-danger ml-1">*</span></label>
                                                <div class="col-md-6">
                                                    <select class="select2 form-control r-0 s-12" name="role_id" id="role_id" autocomplete="off">
                                                        <option value="">Pilih</option>
                                                        @foreach ($roles as $i)
                                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mb-1">
                                                <label for="id_opd" class="form-control label-input-custom col-md-2">Instansi / Dinas<span class="text-danger ml-1">*</span></label>
                                                <div class="col-md-6 p-0 bg-light">
                                                    <select class="select2 form-control r-0 light s-12" name="id_opd" id="id_opd" autocomplete="off">
                                                        <option value="">Pilih</option>
                                                        @foreach ($opds as $i)
                                                            <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="full_name" class="form-control label-input-custom col-md-2">Nama Lengkap<span class="text-danger ml-1">*</span></label>
                                                <input type="text" name="full_name" id="full_name" class="form-control r-0 light s-12 col-md-6" autocomplete="off" required/>
                                            </div>
                                            <div class="form-group">
                                                <label for="username" class="form-control label-input-custom col-md-2">Username<span class="text-danger ml-1">*</span></label>
                                                <input type="text" name="username" id="username" class="form-control r-0 light s-12 col-md-6" autocomplete="off" required/>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="form-control label-input-custom col-md-2">Password<span class="text-danger ml-1">*</span></label>
                                                <input type="password" name="password" id="password" class="form-control r-0 light s-12 col-md-6" autocomplete="off" required/>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                <button type="submit" class="btn btn-primary btn-sm"><i class="icon-save mr-2"></i>Simpan</button>
                                                <a class="btn btn-sm" onclick="add()" id="reset">Reset</a>
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
</script>
@endsection
