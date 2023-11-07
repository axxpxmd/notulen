@extends('layouts.app')
@section('title', '| Dashboard  ')
@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-dashboard mr-2"></i>
                        Dashboard
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3 col-md-12 relative animatedParent animateOnce">
        <div class="mx-2 row justify-content-center">
            <div class="col-md-2 px-2 mb-5-m">
                <div class="card no-b r-15">
                    <h6 class="card-header font-weight-bold text-white bg-success" style="border-top-right-radius: 15px; border-top-left-radius: 15px">Total Notulen</h6>
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="icon-notebook-text fs-24 text-success mr-2"></i>
                            <span class="m-0 font-weight-bold fs-16">{{ $totalNotulen }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 px-2 mb-5-m">
                <div class="card no-b r-15">
                    <h6 class="card-header font-weight-bold text-white" style="background: #FFCE3B; border-top-right-radius: 15px; border-top-left-radius: 15px">Notulen Belum Ditinjau</h6>
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="icon-notebook-text fs-24 amber-text mr-2"></i>
                            <span class="m-0 font-weight-bold fs-16">{{ $notulenBelumDitinjau }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 px-2 mb-5-m">
                <div class="card no-b r-15">
                    <h6 class="card-header font-weight-bold text-white bg-primary" style="border-top-right-radius: 15px; border-top-left-radius: 15px">Notulen Disetujui</h6>
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="icon-notebook-text fs-24 text-primary mr-2"></i>
                            <span class="m-0 font-weight-bold fs-16">{{ $notulenDisetujui }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 px-2 mb-5-m">
                <div class="card no-b r-15">
                    <h6 class="card-header font-weight-bold text-white bg-danger" style="border-top-right-radius: 15px; border-top-left-radius: 15px">Notulen Ditolak</h6>
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="icon-notebook-text fs-24 text-danger mr-2"></i>
                            <span class="m-0 font-weight-bold fs-16">{{ $notulenDitolak }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 px-2 mb-5-m">
                <div class="card r-15 no-b" style="height: 280px !important">
                    <h6 class="card-header bg-success text-white font-weight-bold" style="border-top-right-radius: 15px; border-top-left-radius: 15px">Chart Status Notulen <i class="icon-payment ml-2"></i></h6>
                    <div class="card-body py-0 px-1">
                        @include('chartMetodePembayaran')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
@stack('scriptDashboard')
<script type="text/javascript">
    $(document).ready(function () {
        $('#dtHorizontalVerticalExample').DataTable({
            "scrollX": true,
            "scrollY": 300,
            "bPaginate": false,
            "bInfo": false,
            "searching": false
        });
        $('.dataTables_length').addClass('bs-select');
    });

    $(document).ready(function () {
        $('#tableChannelBayar').DataTable({
            "scrollX": true,
            "scrollY": 180,
            "bPaginate": false,
            "bInfo": false,
            "searching": false,
            "order": [[1, 'desc']],
        });
        $('.dataTables_length').addClass('bs-select');
    });

    $(document).ready(function () {
        $('#tablePembayaran').DataTable({
            "scrollX": true,
            "scrollY": 300,
            "bPaginate": false,
            "bInfo": false,
            "searching": false
        });
        $('.dataTables_length').addClass('bs-select');
    });

    $('.select2').select2({
        dropdownParent: $('#modalFilter')
    });

    $('#tahun_filter').on('change', function(){
        getParamFilter()
    });

    $('#opd_filter').on('change', function(){
        getParamFilter()
    });

    function getParamFilter()
    {
        tahun =  $("#tahun_filter").val();
        opd_id = $("#opd_filter").val();

        url = "{{ route('home') }}?tahun=" + tahun + "&opd_id=" + opd_id;

        $('#filterData').attr('href', url);
    }
</script>
@endsection
