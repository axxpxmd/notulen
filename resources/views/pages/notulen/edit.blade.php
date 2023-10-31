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
                        Edit {{ $title }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route('notulen') }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-document-list"></i>Edit Data</a>
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
                        @include('layouts.alerts')
                        <div id="alert"></div>
                        <div class="card mt-2">
                            <h6 class="card-header font-weight-bold">Data Notulen</h6>
                            <div class="card-body">
                                <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                                    {{ method_field('POST') }}
                                    <input type="hidden" id="id" name="id" value="{{ $data->id }}"/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row mb-2">
                                                <label for="acuan" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Dasar Acuan <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" name="acuan" id="acuan" rows="3" class="form-control s-12" autocomplete="off" placeholder="No Surat / Undangan" required>{{ $data->acuan }}</textarea>
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
                                                    <input type="text" name="judul_agenda" id="judul_agenda"  class="form-control s-12" autocomplete="off" value="{{ $data->judul_agenda }}" placeholder="Judul Agenda / Rapat" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="tanggal_agenda" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Tanggal <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="date" name="tanggal_agenda" id="tanggal_agenda" onchange="getDayName()" value="{{ $data->tanggal_agenda }}" class="form-control s-12" autocomplete="off" required/>
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly id="dayName" class="form-control s-12" autocomplete="off" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="waktu" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Waktu <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="time" name="waktu" id="waktu" value="{{ $data->waktu }}" class="form-control s-12" autocomplete="off" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="tempat" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Tempat <span class="text-danger ml-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="tempat" id="tempat" value="{{ $data->tempat }}" class="form-control s-12" autocomplete="off" placeholder="Tempat Rapat" required/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="keterangan" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Keterangan</label>
                                                <div class="col-sm-9">
                                                    <textarea name="keterangan" id="keterangan" class="form-control s-12" rows="4">{{ $data->keterangan }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-2">
                                                <label for="file_notulen" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Notulen </label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="file_notulen" id="file_notulen" class="form-control s-12"/>
                                                    <span class="text-danger fs-10">Format : PDF, JPG, PNG, JPEG | Max : 2MB</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="foto_rapat" class="col-form-label s-12 col-sm-3 text-right font-weight-bold">Foto Rapat</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="foto_rapat[]" id="foto_rapat" multiple class="form-control s-12"/>
                                                    <span class="text-danger fs-10">Format : PDF, JPG, PNG, JPEG | Max : 2MB</span>
                                                    @foreach ($foto_rapats as $fr)
                                                    <div class="s-12 my-3">
                                                        <li class="mb-2">
                                                            <a target="blank" href="{{ config('app.sftp_src').'foto-rapat/'.$fr->foto }}">{{ $fr->foto }}</a>
                                                            <a href="{{ route('notulen.hapusFoto', $fr->id) }}" onclick="return confirm('Apakah anda yakin ?')"><i title="Hapus Foto" class="icon-times ml-2 text-danger"></i></a>
                                                        </li>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                            <div id="peserta">
                                                @foreach ($pesertas as $key => $p)
                                                <div class="row {{ $key != 0 ? 'tambahan' : '-' }} mb-2">
                                                    @if ($key == 0)
                                                    <label for="peserta" class="col-form-label s-12 col-sm-3 text-right font-weight-bold"> Peserta <span class="text-danger">*</span></label>
                                                    @else
                                                    <label for="peserta" class="col-form-label s-12 col-sm-3 text-right font-weight-bold"></label>
                                                    @endif
                                                    <div class="col-sm-8">
                                                        <input type="text" name="peserta[]" id="peserta" value="{{ $p->nama }}" placeholder="Masukan nama peserta" class="form-control s-12">
                                                    </div>
                                                    @if ($key == 0)
                                                    <div class="col-sm-1">
                                                        <a href="#"><i class="icon icon-plus text-success" id="add-pengajuan"></i></a>
                                                    </div>
                                                    @else
                                                    <div class="col-sm-1">
                                                        <a href="#"><i class="icon icon-minus text-danger remove-input-field" id="add-pengajuan"></i></a>
                                                    </div>
                                                    @endif
                                                </div>
                                                @endforeach
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
@endsection
@section('script')
<script type="text/javascript">
    $('#status').val("{{ $data->status }}");
    $('#status').trigger('change.select2');

    getDayName();
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

    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('.tambahan').remove();
    });

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            url = "{{ route($route.'update', ':id') }}".replace(':id', $('#id').val());
            $.ajax({
                url : url,
                type : 'POST',
                data: new FormData(($(this)[0])),
                contentType: false,
                processData: false,
                success : function(data) {
                    $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                    location.reload();
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
