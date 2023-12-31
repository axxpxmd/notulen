@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-user-circle-o mr-2"></i>
                        {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#profile" role="tab"><i class="icon icon-home2"></i>My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.editPassword', Auth::user()->id) }}"><i class="icon-key4 mr-2"></i>Ganti Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content pb-3" id="v-pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="profile">
                <div class="row">
                    <div class="col-md-6 container">
                        <div class="card mt-3">
                            <h6 class="card-header font-weight-bold">Data Pengguna</h6>
                            <div class="card-body">
                                <img class="mx-auto d-block rounded-circle img-circular" src="{{ config('app.sftp_src').'foto-user/'.Auth::user()->foto }}" width="100" height="100" alt="Foto Profil">
                                <p class="text-center mt-2 font-weight-bold text-uppercase text-black-50">{{ $data->nama }} <i class="icon-verified_user text-primary"></i> </p>
                                <p class="text-center" style="margin-top: -25px !important">{{ $data->modelHasRole->role->name }}</p>
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 font-weight-bold text-right s-12"><strong>Username</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->username }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 font-weight-bold text-right s-12"><strong>Role</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->modelHasRole->role->name }}</label>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <label class="col-md-2 font-weight-bold text-right s-12"><strong>Nama</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->nama }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 font-weight-bold text-right s-12"><strong>OPD</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->opd ? $data->opd->nama : '-' }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 font-weight-bold text-right s-12"><strong>Bidang</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->bidang ? $data->bidang->nama : '-' }}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-2 font-weight-bold text-right s-12"><strong>Sub Bidang</strong></label>
                                        <label class="col-md-10 s-12">{{ $data->sub_bidang ? $data->sub_bidang->nama : '-' }}</label>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-sm btn-danger"><i class="mr-2 icon-power-off"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </div>
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
    //
</script>
@endsection
