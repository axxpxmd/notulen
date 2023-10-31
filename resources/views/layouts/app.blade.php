<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <link rel="icon" href="{{ asset('images/template/logo_title.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} @yield('title')</title>

    <!-- CSS -->
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/myStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
</head>
<body class="light">
@include('layouts.preloader')
<div id="app">
    <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
        <section class="sidebar">
            <div class="d-block img-fluid mt-3 mb-3">
                <img src="{{ asset('images/template/logo.png')}}" class="mx-auto d-block" width="100" alt="Logo Top">
            </div>
            <div class="relative">
                <a data-toggle="collapse" href="#userSettingsCollapse" role="button" class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                    <i class="icon icon-cogs"></i>
                </a>
                <div class="user-panel p-3 light mb-2">
                    <div class="float-left image pl-1">
                        <img width="60" height="60" class="rounded-circle img-circular mr-2" src="{{ config('app.sftp_src').'foto-user/'.Auth::user()->foto }}" alt="User Image">
                    </div>
                    <div class="float-left info mt-2 pl-2">
                        <h6 class="font-weight-light mb-1">{{ Auth::user()->username }}</h6>
                        <a class="text-primary"><i class="icon-circle text-primary blink mr-1"></i>Online</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="collapse multi-collapse" id="userSettingsCollapse">
                        <div class="list-group mt-3 shadow">
                            <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action ">
                                <i class="mr-2 icon-user text-blue"></i>Profile
                            </a>
                            <a href="{{ route('profile.editPassword', Auth::user()->id) }}" class="list-group-item list-group-item-action">
                                <i class="mr-2 icon-key4 orange-text"></i>Ganti Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.navigation')
        </section>
    </aside>
    @include('layouts.topbar')
    <main>
    @yield('content')
    </main>
</div>
</body>
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/').'/') !!}
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/myScript.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/_datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/_datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/_datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/_datatables/vfs_fonts.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>

    @yield('script')
    @stack('script')
</html>
