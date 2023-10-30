<!DOCTYPE html>
<html lang="en">

<head>
    <title>File Notulen</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>

    <style>
        html {
            margin: 30px
        }

        table.d {
            border-collapse: collapse;
            width: 100%
        }

        table.d tr.d,
        th.d,
        td.d {
            table-layout: fixed;
            border: 1px solid black;
            font-size: 12px;
            height: 100;
        }

        table.a tr.a,
        th.a,
        td.a {
            table-layout: fixed;
            border: 1px solid black;
            font-size: 12px;
        }

        table.c {
            font-size: 15px
        }

        table.z {
            font-size: 14px
        }

        .t-bold {
            font-weight: bold
        }

        .m-b-0 {
            margin-bottom: 0px;
        }

        .m-r-10 {
            margin-right: 10px;
        }

        .m-t-0 {
            margin-top: 0px;
        }

        .m-l-5 {
            margin-left: 5px;
        }

        .m-l-15 {
            margin-left: 15px;
        }

        .m-l-25 {
            margin-left: 25px;
        }

        .text-right {
            text-align: right
        }

        .text-center {
            text-align: center
        }

        .m-t-100 {
            margin-top: 100px
        }

        .text-left {
            text-align: left
        }

        .m-l-14 {
            margin-left: 25px
        }

        .m-r-20 {
            margin-right: 20px
        }

        .f-w-n {
            font-weight: normal
        }

        .m-t-1 {
            margin-top: 1px
        }

        .m-l-50 {
            margin-left: 50px;
        }

        .m-t-15 {
            margin-top: 15px
        }

        .m-b-5 {
            margin-bottom: 5px
        }

        .f-normal {
            font-weight: normal
        }

        .mt-n40 {
            margin-top: -30px !important
        }

        .mt-n40 {
            margin-top: -30px !important
        }

        .mt-n15 {
            margin-top: -15px !important
        }

        .fs-10 {
            font-size: 10px
        }

        .t-blue {
            color: blue
        }

        .bgtext {
            position: relative;
        }

        .bgtext:after {
            margin-left: -950px !important;
            margin-top: -1600px !important;
            content: "L U N A S";
            font-size: 60px;
            transform: rotate(310deg);
            -webkit-transform: rotate(310deg);
            color: rgb(226, 136, 136);
            z-index: -1;
        }
    </style>

</head>

<body style="padding: 20px !important">
    <div class="text-center">
        <p style="text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 100px !important">FILE ACUAN</p>
        <embed src="http://dataawan.tangerangselatankota.go.id/sidimas/file-acuan/{{ $notulen->file_acuan }}" type="application/pdf"   height="700px" width="500">
        {{-- <embed src="http://dataawan.tangerangselatankota.go.id/sidimas/file-acuan/{{ $notulen->file_acuan }}" type=""> --}}
        <img style="margin-bottom: 20px !important" src="{{'data:pdf;base64,' . base64_encode(file_get_contents('http://dataawan.tangerangselatankota.go.id/sidimas/file-acuan/'.$notulen->file_acuan)) }}" width="50%" alt="">
    </div>
    {{-- <div class="text-center">
        <p style="text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 100px !important">FOTO RAPAT</p>
        <div>
            @foreach ($foto_rapats as $fr)
                <img style="margin-bottom: 20px !important" src="{{'data:image/png;base64,' . base64_encode(file_get_contents('http://dataawan.tangerangselatankota.go.id/sidimas/foto-rapat/'.$fr->foto)) }}" width="50%" alt="">
                <br>
            @endforeach
        </div>
    </div> --}}
</body>
</html>
