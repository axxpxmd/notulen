<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;
use Spatie\PdfToImage\Pdf;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\OPD;
use App\Models\Notulen;
use App\Models\Peserta;
use App\Models\FotoRapat;

class NotulenController extends Controller
{
    protected $route = 'notulen.';
    protected $title = 'Notulen';

    public function index(Request $request)
    {
        $route = $this->route;
        $title = $this->title;

        $id_opd = Auth::user()->id_opd ? Auth::user()->id_opd : $request->id_opd_filter;
        $today = Carbon::now()->format('Y-m-d');
        $role  = Auth::user()->modelHasRole->role->name;

        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;
        $status_filter = $request->status_filter;

        $opds = OPD::getOpd($id_opd, $role);

        if ($request->ajax()) {
            return $this->dataTable($id_opd, $tanggal_mulai, $tanggal_akhir, $status_filter);
        }

        return view('pages.notulen.index', compact(
            'route',
            'title',
            'opds',
            'id_opd',
            'today',
            'role'
        ));
    }

    public function dataTable($id_opd, $tanggal_mulai, $tanggal_akhir, $status_filter)
    {
        $data = Notulen::queryTable($id_opd, $tanggal_mulai, $tanggal_akhir, $status_filter);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='" . route('notulen.edit', $p->id) . "' class='text-success mr-2' title='Edit Data'><i class='icon icon-edit'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('judul_agenda', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->judul_agenda . "</a>";
            })
            ->editColumn('tanggal_agenda', function ($p) {
                return Carbon::createFromFormat('Y-m-d', $p->tanggal_agenda)->format('d M Y') . ' | ' . $p->waktu;
            })
            ->addColumn('jumlah_peserta', function ($p) {
                return count($p->peserta);
            })
            ->editColumn('status', function ($p) {
                if ($p->status == 0) {
                    return "<span class='badge badge-warning'>Belum Ditinjau</span>";
                } elseif ($p->status == 1) {
                    return "<span class='badge badge-success'>Sudah Ditinjau</span>";
                } else {
                    return "<span class='badge badge-danger'>Ditolak</span>";
                }
            })
            ->editColumn('tempat', function ($p) {
                return $p->tempat;
            })
            ->editColumn('file_notulen', function ($p) {
                return "<a href='" . config('app.sftp_src') . 'file-notulen/' . $p->file_notulen  . "' target='_blank' class='cyan-text' title='File TTD'><i class='icon-document-file-pdf2'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'tanggal_agenda', 'status', 'judul_agenda', 'file_notulen'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'acuan' => 'required',
            'judul_agenda' => 'required',
            'tanggal_agenda' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'file_notulen' => 'required'
        ]);

        //* Get Params
        $acuan = $request->acuan;
        $judul_agenda = $request->judul_agenda;
        $tanggal_agenda = $request->tanggal_agenda;
        $waktu = $request->waktu;
        $tempat = $request->tempat;
        $keterangan = $request->keterangan;
        $peserta = $request->peserta;

        $file_acuan = $request->file('file_acuan');
        $file_notulen = $request->file('file_notulen');
        $foto_rapat = $request->file('foto_rapat');

        if ($file_acuan) {
            $ext = $request->file('file_acuan')->extension();
            if (!in_array($ext, ['pdf', 'png', 'jpeg', 'jpg']))
                return response()->json([
                    'message' => 'Format file tidak diperbolehkan'
                ], 500);

            //TODO: Saved to storage
            $fileNameAcuan = time() . "-" . mt_rand(0, 999) . "." . $ext;
            $file_acuan->storeAs('file-acuan/', $fileNameAcuan, 'sftp', 'public');
        }

        if ($file_notulen) {
            $ext = $request->file('file_notulen')->extension();
            if (!in_array($ext, ['pdf', 'png', 'jpeg', 'jpg']))
                return response()->json([
                    'message' => 'Format file tidak diperbolehkan'
                ], 500);

            //TODO: Saved to storage
            $fileNameNotulan = time() . "-" . mt_rand(0, 999) . "." . $ext;
            $file_notulen->storeAs('file-notulen/', $fileNameNotulan, 'sftp', 'public');
        }

        if ($foto_rapat) {
            foreach ($foto_rapat as $key => $i) {
                $ext = $foto_rapat[$key]->extension();
                if (!in_array($ext, ['pdf', 'png', 'jpeg', 'jpg']))
                    return response()->json([
                        'message' => 'Format file tidak diperbolehkan'
                    ], 500);

                //TODO: Saved to storage
                $fileName = time() . "-" . mt_rand(0, 999) . "." . $ext;
                $foto_rapat[$key]->storeAs('foto-rapat/', $fileName, 'sftp', 'public');

                $fileNameFotoRapat[$key] = $fileName;
            }
        }

        //* Save Notulen
        $notulen = Notulen::create([
            'id_opd' => Auth::user()->id_opd,
            'id_bidang' => Auth::user()->id_bidang,
            'id_sub_bidang' => Auth::user()->id_sub_bidang,
            'judul_agenda' => $judul_agenda,
            'tanggal_agenda' => $tanggal_agenda,
            'waktu' => $waktu,
            'tempat' => $tempat,
            'acuan' => $acuan,
            'file_acuan' => $fileNameAcuan,
            'keterangan' => $keterangan,
            'file_notulen' => $fileNameNotulan,
            'status' => 0
        ]);

        //* Save Peserta Notulen
        foreach ($peserta as $key => $p) {
            Peserta::create([
                'id_notulen' => $notulen->id,
                'nama' => $peserta[$key]
            ]);
        }

        //* Save Foto Rapat
        foreach ($fileNameFotoRapat as $key => $fr) {
            FotoRapat::create([
                'id_notulen' => $notulen->id,
                'foto' => $fileNameFotoRapat[$key]
            ]);
        }

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;

        $role  = Auth::user()->modelHasRole->role->name;

        $data = Notulen::find($id);
        $pesertas = Peserta::where('id_notulen', $id)->get();
        $foto_rapats = FotoRapat::where('id_notulen', $id)->get();

        return view('pages.notulen.show', compact(
            'route',
            'title',
            'data',
            'pesertas',
            'foto_rapats',
            'role'
        ));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $id = $request->id;
        $status = $request->status;
        $pesan  = $request->pesan;

        $data = Notulen::find($id);
        $data->update([
            'status' => $status,
            'pesan'  => $pesan
        ]);

        return redirect()
            ->route('notulen.show', $id)
            ->withSuccess('Selamat! Status notulen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $notulen = Notulen::where('id', $id)->first();

        FotoRapat::where('id_notulen', $id)->delete();
        Peserta::where('id_notulen', $id)->delete();

        $notulen->delete();

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dibatalkan.'
        ]);
    }

    public function generateNotulen($id)
    {
        $notulen = Notulen::find($id);
        $foto_rapats = FotoRapat::where('id_notulen', $id)->get();
        $pesertas = Peserta::where('id_notulen', $id)->get();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('legal', 'portrait');
        $pdf->loadView('pages.notulen.notulen', compact(
            'notulen',
            'foto_rapats',
            'pesertas'
        ));

        return $pdf->stream("test.pdf");
    }

    public function edit($id)
    {
        $route = $this->route;
        $title = $this->title;

        $role  = Auth::user()->modelHasRole->role->name;

        $data = Notulen::find($id);
        $pesertas = Peserta::where('id_notulen', $id)->get();
        $foto_rapats = FotoRapat::where('id_notulen', $id)->get();

        return view('pages.notulen.edit', compact(
            'route',
            'title',
            'data',
            'pesertas',
            'foto_rapats',
            'role'
        ));
    }
}
